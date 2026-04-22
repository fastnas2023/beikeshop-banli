<?php
/**
 * FileManagerService.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2022-07-12 15:12:48
 * @modified   2022-07-12 15:12:48
 */

namespace Beike\Admin\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerService
{
    protected $fileBasePath = '';

    protected $basePath = '';

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->fileBasePath = catalog_path() . $this->basePath;
    }

    /**
     * 获取某个目录下所有文件夹
     */
    public function getDirectories($baseFolder = '/'): array
    {
        $currentBasePath = rtrim($this->fileBasePath . $baseFolder, '/');

        $directories = glob("{$currentBasePath}/*", GLOB_ONLYDIR);

        $result = [];
        foreach ($directories as $directory) {
            $baseName = basename($directory);
            $dirName  = str_replace($this->fileBasePath, '', $directory);
            if (is_dir($directory)) {
                $item           = $this->handleFolder($dirName, $baseName);
                $subDirectories = $this->getDirectories($dirName);
                if ($subDirectories) {
                    $item['children'] = $subDirectories;
                }
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * 获取某个目录下的文件和文件夹
     *
     * @param     $baseFolder
     * @param     $keyword
     * @param     $sort
     * @param     $order
     * @param int $page
     * @param int $perPage
     * @return array
     * @throws \Exception
     */
    public function getFiles($baseFolder, $keyword, $sort, $order, int $page = 1, int $perPage = 20): array
    {
        $currentBasePath = rtrim($this->fileBasePath . $baseFolder, '/');
        $files = array_filter(glob($currentBasePath . '/*'), function ($file) {
            return is_file($file) && preg_match('/\.(jpg|jpeg|png|JPG|JPEG|mp4|MP4|gif|webp)$/', $file);
        });

        // 过滤文件
        if ($keyword) {
            $files = array_filter($files, function ($file) use ($keyword) {
                return str_contains(basename($file), $keyword);
            });
        }

        // 获取文件信息
        $fileData = array_map(function ($file) {
            return [
                'path' => $file,
                'basename' => basename($file),
                'mtime' => filemtime($file),
            ];
        }, $files);

        // 排序文件
        if ($sort == 'created') {
            usort($fileData, function ($a, $b) use ($order) {
                return $order == 'desc' ? $b['mtime'] <=> $a['mtime'] : $a['mtime'] <=> $b['mtime'];
            });
        } else {
            usort($fileData, function ($a, $b) use ($order) {
                return $order == 'desc' ? strcmp($b['basename'], $a['basename']) : strcmp($a['basename'], $b['basename']);
            });
        }

        // 分页
        $totalFiles = count($fileData);
        $start = ($page - 1) * $perPage;
        $fileData = array_slice($fileData, $start, $perPage);

        // 处理文件
        $images = array_map(function ($file) {
            return $this->handleImage(str_replace(catalog_path(), '', $file['path']), $file['basename']);
        }, $fileData);

        return [
            'images'      => $images,
            'image_total' => $totalFiles,
            'image_page'  => $page,
        ];
    }


    /**
     * 创建目录
     * @param             $folderName
     * @throws \Exception
     */
    public function createDirectory($folderName)
    {
        $catalogFolderPath = "image/catalog{$this->basePath}/{$folderName}";

        $folderPath        = public_path($catalogFolderPath);
        if (is_dir($folderPath)) {
            throw new \Exception(trans('admin/file_manager.directory_already_exist'));
        }

        create_directories($catalogFolderPath);
    }

    /**
     * 移动文件夹
     *
     * @param             $sourcePath
     * @param             $destPath
     * @throws \Exception
     */
    public function moveDirectory($sourcePath, $destPath)
    {
        if (empty($sourcePath)) {
            throw new \Exception(trans('admin/file_manager.empty_source_path'));
        }
        if (empty($destPath)) {
            throw new \Exception(trans('admin/file_manager.empty_dest_path'));
        }

        $folderName    = basename($sourcePath);
        $sourceDirPath = catalog_path("{$this->basePath}{$sourcePath}/");

        if ($destPath != '/') {
            $destDirPath = catalog_path("{$this->basePath}{$destPath}/");
        } else {
            $destDirPath = catalog_path("{$this->basePath}{$destPath}");
        }

        $destFullPath = catalog_path("{$this->basePath}{$destPath}/{$folderName}");
        if (! File::exists($destFullPath)) {
            move_dir($sourceDirPath, $destDirPath);
        } else {
            throw new \Exception(trans('admin/file_manager.target_dir_exist'));
        }
    }

    /**
     * 批量移动图片文件
     *
     * @param $images
     * @param $destPath
     */
    public function moveFiles($images, $destPath)
    {
        if ($destPath != '/') {
            $destDirPath = catalog_path("{$this->basePath}{$destPath}/");
        } else {
            $destDirPath = catalog_path("{$this->basePath}{$destPath}");
        }

        foreach ($images as $image) {
            $sourceDirPath = public_path($image);
            File::move($sourceDirPath, $destDirPath . basename($sourceDirPath));
        }
    }

    /**
     * @param $imagePath
     * @return string
     */
    /**
     * 验证路径，防止路径遍历攻击
     *
     * @param string $path 需要验证的路径
     * @return string 安全的路径
     * @throws \Exception 如果路径不安全则抛出异常
     */
    private function validatePath(string $path): string
    {
        // 移除所有可能导致路径遍历的模式
        $path = str_replace(['../', '..\\', './', '.\\', '../', '..\\'], '', $path);

        // 确保路径以 / 开头
        if (!empty($path) && $path[0] !== '/') {
            $path = '/' . $path;
        }

        // 确保路径不包含任何危险字符
        if (preg_match('#[<>:"|?*]#', $path)) {
            throw new \Exception(trans('admin/file_manager.invalid_path'));
        }

        return $path;
    }

    public function zipFolder($imagePath): string
    {
        // 验证并清理路径
        $imagePath = $this->validatePath($imagePath);

        $realPath = $this->fileBasePath . $imagePath;

        // 确保路径在允许的目录内（只有当路径存在时才进行realpath检查）
        $baseRealPath = realpath($this->fileBasePath);
        if ($baseRealPath && file_exists($realPath)) {
            $targetRealPath = realpath($realPath);
            if ($targetRealPath && !str_starts_with($targetRealPath, $baseRealPath)) {
                throw new \Exception(trans('admin/file_manager.invalid_path'));
            }
        }

        // 检查目录是否存在
        if (!is_dir($realPath)) {
            throw new \Exception(trans('admin/file_manager.target_not_exist'));
        }

        $dirName  = basename($realPath);
        $zipName  = $dirName . '-' . date('Ymd') . '.zip';
        $zipPath  = public_path("{$zipName}");
        zip_folder($realPath, $zipPath);

        return $zipPath;
    }

    /**
     * 删除文件或文件夹
     *
     * @param             $filePath
     * @throws \Exception
     */
    public function deleteDirectoryOrFile($filePath)
    {
        // 验证并清理路径
        $filePath = $this->validatePath($filePath);

        $fullPath = catalog_path("{$this->basePath}{$filePath}");

        // 确保路径在允许的目录内
        $allowedBasePath = catalog_path("{$this->basePath}");
        if (!str_starts_with(realpath($fullPath), realpath($allowedBasePath))) {
            throw new \Exception(trans('admin/file_manager.invalid_path'));
        }

        if (is_dir($fullPath)) {
            $files = glob($fullPath . '/*');
            if ($files) {
                throw new \Exception(trans('admin/file_manager.directory_not_empty'));
            }
            @rmdir($fullPath);
        } elseif (file_exists($fullPath)) {
            @unlink($fullPath);
        }
    }

    /**
     * 批量删除文件
     *
     * @param $basePath
     * @param $files
     * @throws \Exception
     */
    public function deleteFiles($basePath, $files)
    {
        if (empty($files)) {
            return;
        }

        // 验证并清理基础路径
        $basePath = $this->validatePath($basePath);

        $allowedBasePath = catalog_path("{$this->basePath}");

        foreach ($files as $file) {
            // 验证文件名
            if (!$this->isValidFileName($file)) {
                throw new \Exception(trans('admin/file_manager.invalid_filename'));
            }

            // 构建完整文件路径
            $filePath = catalog_path("{$this->basePath}{$basePath}/$file");

            // 确保文件路径在允许的目录内
            if (file_exists($filePath)) {
                $realFilePath = realpath($filePath);
                $realBasePath = realpath($allowedBasePath);
                if ($realFilePath && $realBasePath && !str_starts_with($realFilePath, $realBasePath)) {
                    throw new \Exception(trans('admin/file_manager.invalid_path'));
                }

                // 只删除文件，不删除目录
                if (is_file($filePath)) {
                    @unlink($filePath);
                }
            }
        }
    }

    /**
     * 修改文件夹或者文件名称
     *
     * @param             $originPath
     * @param             $newPath
     * @throws \Exception
     */
    public function updateName($originPath, $newPath)
    {
        // 验证并清理原始路径
        $originPath = $this->validatePath($originPath);

        // 验证新文件名的安全性
        if (!$this->isValidFileName($newPath)) {
            throw new \Exception(trans('admin/file_manager.invalid_filename'));
        }

        // 验证新文件名（不允许路径分隔符）
        if (str_contains($newPath, '/') || str_contains($newPath, '\\') || str_contains($newPath, '..')) {
            throw new \Exception(trans('admin/file_manager.invalid_path'));
        }

        $fullOriginPath = catalog_path("{$this->basePath}{$originPath}");

        // 确保原始路径在允许的目录内
        $allowedBasePath = catalog_path("{$this->basePath}");
        if (file_exists($fullOriginPath)) {
            $realOriginPath = realpath($fullOriginPath);
            $realBasePath = realpath($allowedBasePath);
            if ($realOriginPath && $realBasePath && !str_starts_with($realOriginPath, $realBasePath)) {
                throw new \Exception(trans('admin/file_manager.invalid_path'));
            }
        }

        if (! is_dir($fullOriginPath) && ! file_exists($fullOriginPath)) {
            throw new \Exception(trans('admin/file_manager.target_not_exist'));
        }

        $originBase = dirname($fullOriginPath);
        $newFullPath = $originBase . '/' . $newPath;

        // 确保新路径也在允许的目录内
        $realNewPath = realpath($originBase) . '/' . $newPath;
        if (!str_starts_with($realNewPath, realpath($allowedBasePath))) {
            throw new \Exception(trans('admin/file_manager.invalid_path'));
        }

        if ($fullOriginPath == $newFullPath) {
            return;
        }

        if (file_exists($newFullPath)) {
            throw new \Exception(trans('admin/file_manager.rename_failed'));
        }

        $result = @rename($fullOriginPath, $newFullPath);
        if (! $result) {
            throw new \Exception(trans('admin/file_manager.rename_failed'));
        }
    }

    /**
     * 上传文件
     *
     * @param $file
     * @param $savePath
     * @param $originName
     * @return mixed
     */
    public function uploadFile(UploadedFile $file, $savePath, $originName): mixed
    {
        // 路径与文件名过滤
       $savePath = $this->sanitizePath($savePath);

        // 校验类型
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4'];
        $allowedMimeTypes = [
            'image/jpeg',
            'image/pjpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'video/mp4',
        ];
        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType = $file->getMimeType();

        if (!in_array($extension, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
            throw new \Exception(trans('admin/file_manager.upload_type_fail'));
        }

        $originName = $this->getUniqueFileName($savePath, $originName);
        $filePath   = $file->storeAs($this->basePath . $savePath, $originName, 'catalog');

        return [
            'url' => asset('image/catalog/' . $filePath),
            'path' => 'image/catalog/' . $filePath,
        ];
    }

    public function sanitizePath($path): string
    {
        // 移除所有可能导致路径遍历的模式
        $path = str_replace(['../', '..\\', './', '.\\', '../', '..\\'], '', $path);

        // 移除空字节和其他危险字符
        $path = str_replace(["\0", "\x00"], '', $path);

        // 确保路径不包含任何危险字符
        $path = preg_replace('#[<>:"|?*]#', '', $path);

        return trim($path);
    }

    /**
     * 验证文件名是否安全
     *
     * @param string $fileName
     * @return bool
     */
    private function isValidFileName(string $fileName): bool
    {
        // 检查文件名长度
        if (strlen($fileName) > 255 || empty(trim($fileName))) {
            return false;
        }

        // 检查危险字符
        if (preg_match('#[<>:"|?*\x00-\x1f]#', $fileName)) {
            return false;
        }

        // 检查路径遍历模式
        if (str_contains($fileName, '..') || str_contains($fileName, '/') || str_contains($fileName, '\\')) {
            return false;
        }

        // 检查保留文件名 (Windows)
        $reservedNames = ['CON', 'PRN', 'AUX', 'NUL', 'COM1', 'COM2', 'COM3', 'COM4', 'COM5', 'COM6', 'COM7', 'COM8', 'COM9', 'LPT1', 'LPT2', 'LPT3', 'LPT4', 'LPT5', 'LPT6', 'LPT7', 'LPT8', 'LPT9'];
        $nameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
        if (in_array(strtoupper($nameWithoutExt), $reservedNames)) {
            return false;
        }

        // 如果是文件（有扩展名），验证扩展名
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!empty($extension)) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'txt', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
            if (!in_array(strtolower($extension), $allowedExtensions)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @throws BindingResolutionException
     */
    public function getUniqueFileName($savePath, $originName): string
    {
        if (is_file(catalog_path($this->basePath . $savePath . '/' . $originName))) {
            $originName     = $this->getNewFileName($originName);
            $originName     = $this->getUniqueFileName($savePath, $originName);
        }

        return $originName;
    }

    public function getNewFileName($originName): string
    {
        $originNameInfo = pathinfo($originName);

        $fileName = $originNameInfo['filename'];
        $index    = 1;

        $hyphenPos    = mb_strrpos($fileName, '-');
        $indexPending = mb_substr($fileName, $hyphenPos + 1);
        if (is_numeric($indexPending)) {
            $fileName = mb_substr($fileName, 0, $hyphenPos);
            $index    = $indexPending + 1;
        }

        $originName     = $fileName . '-' . $index . '.' . $originNameInfo['extension'];

        return $originName;
    }

    /**
     * 处理文件夹
     *
     * @param $folderPath
     * @param $baseName
     * @return array
     */
    private function handleFolder($folderPath, $baseName): array
    {
        return [
            'path' => $folderPath,
            'name' => $baseName,
        ];
    }

    /**
     * 检测是否含有子文件夹
     *
     * @param $folderPath
     * @return bool
     * @throws BindingResolutionException
     */
    private function hasSubFolders($folderPath): bool
    {
        $path     = catalog_path("{$this->basePath}/{$folderPath}");
        $subFiles = glob($path . '/*');
        foreach ($subFiles as $subFile) {
            if (is_dir($subFile)) {
                return true;
            }
        }

        return false;
    }

    /**
     * 处理文件
     *
     * @param $filePath
     * @param $baseName
     * @return array
     * @throws \Exception
     */
    private function handleImage($filePath, $baseName): array
    {
        $path     = "image/catalog{$filePath}";
        $realPath = str_replace($this->fileBasePath . $this->basePath, $this->fileBasePath, $this->fileBasePath . $filePath);

        $mime = '';
        if (file_exists($realPath)) {
            $mime = mime_content_type($realPath);
        }

        return [
            'path'       => '/' . $path,
            'name'       => $baseName,
            'origin_url' => image_origin($path),
            'url'        => image_resize($path),
            'mime'       => $mime,
            'selected'   => false,
        ];
    }
}
