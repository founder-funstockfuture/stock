const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .version()
    .copyDirectory('resources/editor/js', 'public/js')
	.copyDirectory('resources/editor/css', 'public/css')
    .copyDirectory('resources/js/jquery.slicknav.js', 'public/js')
    .copyDirectory('resources/css/slicknav.min.css', 'public/css')
    .copyDirectory('resources/css/themify-icons.css', 'public/css');
