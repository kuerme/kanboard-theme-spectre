const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cssnano = require('gulp-cssnano');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const del = require('del');
const copy = require('copy');

function clean(cb) {
    del.sync(['./dist']);
    cb();
}

function css(cb) {
    return gulp
        .src(['./*.scss', '!./_*.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./dist'));
}

function minCss() {
    return gulp
        .src(['./*.scss', '!./_*.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./dist'));
}

function copyfiles(cb) {
    copy(['./Plugin.php'], './dist', cb);
}

exports.build = gulp.series(clean, gulp.parallel(css, minCss), copyfiles);
