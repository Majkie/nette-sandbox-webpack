const mix = require('laravel-mix');

/*
 * Mix public path set to www
 * This is crucial for versioning, do not change this
 * unless you have your own solution
 */
mix.setPublicPath('www')

/*
 * Laravel mix - wrapper around Webpack
 * Docs: https://laravel-mix.com/docs/6.0/what-is-mix
 */

mix.js('www/js/main.js', 'www/dist/js')
    .postCss('www/css/style.css', 'www/dist/css', [
        //
    ])

if (mix.inProduction()) {
    mix.version()
}