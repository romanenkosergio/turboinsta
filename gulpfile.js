var gulp = require('gulp'),
    sass = require('gulp-sass'),
    plumber = require('gulp-plumber'),
    browserSync = require('browser-sync'),
    autoprefixer = require('gulp-autoprefixer'),
    cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename');
imagemin = require('gulp-imagemin');
imageminJpegRecompress = require('imagemin-jpeg-recompress');
pngquant = require('imagemin-pngquant');
cache = require('gulp-cache');
minifyjs = require('gulp-js-minify');

gulp.task('sass', function() {
    return gulp.src('sass/*.sass')
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(cssmin())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('css'))
        .pipe(browserSync.reload({ stream: true }))
});
gulp.task('minify-js', function() {
    gulp.src('js/**/*')
        .pipe(minifyjs())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('js'))
        .pipe(browserSync.reload({ stream: true }))
});
// Clearing the cache
gulp.task('clear', function(done) {
    return cache.clearAll(done);
});
gulp.task('browser-sync', function() {
    browserSync.init(["css/*.min.css", "js/*.js", "*.html"], {
        server: {
            baseDir: "./"
        }
    });
});

gulp.task('default', ['sass', 'minify-js', 'clear', 'browser-sync'], function() {
    gulp.watch("sass/*.sass", ['sass']);
});