const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const purgecss = require('gulp-purgecss')


function buildStyles() {
    return src('frontend/scss/**/*.scss')
        .pipe(sass())
        .pipe(dest('public/css'))
}

function watchTask() {
    watch(['frontend/scss/**/*.scss'], buildStyles)
}

exports.default = series(buildStyles, watchTask);