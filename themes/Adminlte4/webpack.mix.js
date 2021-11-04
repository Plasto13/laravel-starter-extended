const mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');
const themeInfo = require('./theme.json');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.copyDirectory('node_modules/jquery', 'assets/vendor/jquery');
mix.copyDirectory('node_modules/bootstrap', 'assets/vendor/bootstrap');
mix.copyDirectory('node_modules/admin-lte/plugins/fontawesome-free', 'assets/vendor/fontawesome-free');
mix.copyDirectory('node_modules/admin-lte/plugins/overlayScrollbars', 'assets/vendor/overlayScrollbars');
mix.copyDirectory('node_modules/admin-lte/plugins/sweetalert2', 'assets/vendor/sweetalert2');
mix.copyDirectory('node_modules/admin-lte/plugins/sweetalert2-theme-bootstrap-4', 'assets/vendor/sweetalert2-theme-bootstrap-4');
mix.copyDirectory('node_modules/select2/dist/js', 'assets/vendor/select2/js');
mix.copyDirectory('node_modules/admin-lte/dist/', 'assets');
mix.setPublicPath('assets')
mix.setPublicPath('../../public/themes/'+themeInfo.slug)
    .js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css')
    .version()
    
mix.copyDirectory('assets', '../../public/themes/'+themeInfo.slug);
