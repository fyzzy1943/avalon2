let mix = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

// mix.sass('resources/assets/sass/avalon.scss', 'public/fantasy')
//     .sass('resources/assets/sass/index.scss', 'public/fantasy');

// 编译 sass 资源
mix.sass('resources/assets/sass/tags.scss', 'public/fantasy')
    .sass('resources/assets/sass/friends.scss', 'public/fantasy')
    .sass('resources/assets/sass/avalon.scss', 'public/fantasy')
    .sass('resources/assets/sass/index.scss', 'public/fantasy')
    .sass('resources/assets/sass/article.scss', 'public/fantasy')
    .version();

// mix.browserSync('my-domain.dev');
