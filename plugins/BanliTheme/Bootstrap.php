<?php

namespace Plugin\BanliTheme;

use Illuminate\Support\Facades\View;

class Bootstrap
{
    public function boot()
    {
        // 注册主题专属的 hook 或视图路径
        $pluginViewPath = base_path('plugins/BanliTheme/Views');
        app('view')->getFinder()->prependLocation($pluginViewPath);
        app('view')->prependNamespace('admin', $pluginViewPath . '/admin');
    }
}
