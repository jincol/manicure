const { src, dest, watch, parallel } = require('gulp');

const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const cssnano = require('cssnano');
const autoprefixer = require('autoprefixer');
const terser = require('gulp-terser-js');
const sourcemaps = require('gulp-sourcemaps')


//FUNCIONES PARA CSS
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js'
}


function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/css'));
}

function javascript() {
    return src(paths.js)
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'));
}

function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
}

exports.css = css;
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, javascript, watchArchivos);
exports.build = parallel(css, javascript);





