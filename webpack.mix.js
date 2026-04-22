const mix = require('laravel-mix');

mix.disableNotifications();
const fs = require('fs');

// 后台 scss/js
mix.sass('resources/beike/admin/css/bootstrap/bootstrap.scss', 'public/build/beike/admin/css/bootstrap.css');
mix.sass('resources/beike/admin/css/app.scss', 'public/build/beike/admin/css/app.css');
mix.js('resources/beike/admin/js/app.js', 'public/build/beike/admin/js/app.js');

// 安装引导
mix.sass('beike/Installer/assets/scss/app.scss', 'public/install/css/app.css');

// design
mix.sass('resources/beike/admin/css/design/app.scss', 'public/build/beike/admin/css/design.css');

// filemanager
mix.sass('resources/beike/admin/css/filemanager/app.scss', 'public/build/beike/admin/css/filemanager.css');

// 前端 default 模板
mix.sass('resources/beike/shop/default/css/bootstrap/bootstrap.scss', 'public/build/beike/shop/default/css/bootstrap.css');
mix.sass('resources/beike/shop/default/css/app.scss', 'public/build/beike/shop/default/css/app.css');
mix.js('resources/beike/shop/default/js/app.js', 'public/build/beike/shop/default/js/app.js');

// 编译 BanliTheme 模板 (官方技术栈: SCSS + Bootstrap 5)
const themeFileName =  'BanliTheme';
const themeCode = 'banli_theme';

mix.sass(`plugins/${themeFileName}/Resources/beike/shop/${themeCode}/css/bootstrap/bootstrap.scss`, `public/build/beike/shop/${themeCode}/css/bootstrap.css`)
.then(() => {
    if (!fs.existsSync(`plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/`)){
        fs.mkdirSync(`plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/`, { recursive: true });
    }
    fs.copyFileSync(`public/build/beike/shop/${themeCode}/css/bootstrap.css`, `plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/bootstrap.css`);
});

mix.sass(`plugins/${themeFileName}/Resources/beike/shop/${themeCode}/css/app.scss`, `public/build/beike/shop/${themeCode}/css/app.css`)
.then(() => {
    if (!fs.existsSync(`plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/`)){
        fs.mkdirSync(`plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/`, { recursive: true });
    }
    fs.copyFileSync(`public/build/beike/shop/${themeCode}/css/app.css`, `plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/app.css`);
});

mix.js(`plugins/${themeFileName}/Resources/beike/shop/${themeCode}/js/app.js`, `public/build/beike/shop/${themeCode}/js/app.js`)
.then(() => {
    if (!fs.existsSync(`plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/js/`)){
        fs.mkdirSync(`plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/js/`, { recursive: true });
    }
    fs.copyFileSync(`public/build/beike/shop/${themeCode}/js/app.js`, `plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/js/app.js`);
});

// 解决 webpack-cli 版本冲突警告
// mix.webpackConfig({
//     stats: {
//         children: true,
//     },
//     plugins: []
// });

mix.options({
    processCssUrls: false
});

if (mix.inProduction()) {
  mix.version();
}