const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
const { VueLoaderPlugin } = require('vue-loader');
require('laravel-mix-merge-manifest');

require('laravel-vue-i18n/mix');


mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/projects.js').i18n('resources/lang').vue().webpackConfig({
    plugins: [
        // new VueLoaderPlugin()
    ]
});
    mix.sass( __dirname + '/Resources/assets/sass/app.scss', 'css/projects.css');

if (mix.inProduction()) {
    mix.version();
}



