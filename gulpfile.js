var gulp = require('gulp'); 
var minifycss = require('gulp-minify-css');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var autoprefixer = require('gulp-autoprefixer');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');

var onError = function(err) {
    console.log(err);
};

gulp.task('css', function () {
    gulp.src('style.css')
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(autoprefixer('last 2 versions', 'ie8', 'ie9'))
        .pipe(minifycss())
        .pipe(gulp.dest('css/dist'))
        .pipe(notify({ message: "css done"} ));
});

gulp.task('sass', function () {
    gulp.src('sass/**/*.scss')
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(sass())
        .pipe(gulp.dest('.'));
});

gulp.task('js', function () {
    gulp.src('js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(jshint.reporter('fail'))
        .on('error', notify.onError({ message: 'JS hint fail'}))
        .pipe(uglify())
        .pipe(gulp.dest('js/dist'));
});

gulp.task('browser-sync', function() {
    browserSync.init(["style.css", "js/*.js", "./**/*.php"], {
        proxy: "http://gravityapple.dev"
    });
});

gulp.task('default', function () {
    gulp.run("browser-sync");
    gulp.run("sass");
    gulp.run("css");
    gulp.run("js");
    gulp.watch("sass/**/*.scss", ['sass']);
    gulp.watch("style.css", ['css']);
    gulp.watch("js/*.js", ['js']);
});