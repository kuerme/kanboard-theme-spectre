const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cssnano = require('gulp-cssnano');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const del = require('del');
const copy = require('copy');
const zip = require('gulp-zip');
const fs = require('fs-extra');
const replace = require('gulp-replace');

// vars
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
};
var config = JSON.parse(fs.readFileSync('./package.json'));
var projectVersion = config.version;
var projectName = config.name.capitalize();

// generate css
function css() {
    return gulp
        .src(['./*.scss', '!./_*.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./dist'));
}

// generate comporessed css
function minCss() {
    return gulp
        .src(['./*.scss', '!./_*.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./dist'));
}

// update plugin version
function updateVersion() {
    return gulp
        .src('./Plugin.php')
        .pipe(replace("/return '.*?'/g", "return '" + projectVersion + "'"))
        .pipe(gulp.dest('./'));
}

//  dev task
exports.dev = gulp.series(
    function(cb) {
        del.sync(['../../dist/wwwroot/kanban.me/plugins/' + projectName], {force: true});
        cb();
    },
    gulp.parallel(css, minCss, updateVersion),
    function(cb) {
        copy(['./Plugin.php'], '../../dist/wwwroot/kanban.me/plugins/' + projectName, cb);
    }
);

// build task
exports.build = gulp.series(
    function(cb) {
        del.sync(['./dist']);
        cb();
    },
    gulp.parallel(css, minCss, updateVersion),
    function(cb) {
        copy(['./Plugin.php'], './dist', cb);
    }
);

// publish task
exports.publish = gulp.series(
    function(cb) {
        // fs.ensureDirSync(spectreFolderPath);
        del.sync('./dist/*.zip');
        fs.copy('./dist', './publish/' + projectName, {overwrite: true}, cb);
    },
    function() {
        return gulp
            .src(['./publish/**'])
            .pipe(zip(projectName + '-' + projectVersion + '.zip'))
            .pipe(gulp.dest('./dist'));
    },
    function(cb) {
        del.sync('./publish');
        cb();
    }
);
