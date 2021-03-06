var syntax = 'sass'; // Syntax: sass or scss;

var gulp = require('gulp'),
    gutil = require('gulp-util'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    cleancss = require('gulp-clean-css'),
    rename = require('gulp-rename'),
    autoprefixer = require('gulp-autoprefixer'),
    notify = require("gulp-notify"),
    imagemin = require('gulp-imagemin'),
    connect = require('gulp-connect-php'),
    rsync = require('gulp-rsync');



gulp.task('browser-sync', function() {
    connect.server({ base: 'app' }, function() {
        browserSync({
            proxy: '127.0.0.1:8000',
            baseDir: 'app',

        });
    });
});

gulp.task('styles', function() {
    return gulp.src('app/' + syntax + '/**/*.' + syntax + '')
        .pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
        .pipe(rename({ suffix: '.min', prefix: '' }))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(cleancss({ level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
        .pipe(gulp.dest('app/css'))
        .pipe(browserSync.stream())
});
gulp.task('form', function() {
    return gulp.src('app/sass/form.sass')
        .pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
        .pipe(rename({ suffix: '.min', prefix: '' }))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(cleancss({ level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
        .pipe(gulp.dest('app/css'))
        .pipe(browserSync.stream())
});

gulp.task('js', function() {
    return gulp.src([
            'app/libs/jquery/dist/jquery.min.js',
            'app/libs/jquery/dist/jquery.cookie.js',
            // 'app/libs/jquery/dist/ajax.min.js',
            'app/libs/masked/jquery.maskedinput.min.js',
            // 'app/libs/wow/wow.min.js',
            'app/libs/owl/owl.carousel.min.js',
            'app/libs/lazy/jquery.lazyload.min.js',
            'app/libs/particles/particles.js',
            'app/libs/range/nouislider.min.js',
            // 'app/libs/snowfall/snowfall.js',
            'app/js/index.js', // Always at the end
        ])
        .pipe(concat('index.min.js'))
        // .pipe(uglify()) // Mifify js (opt.)
        .pipe(gulp.dest('app/js'))
        .pipe(browserSync.reload({ stream: true }))
});
gulp.task('form-js', function() {
    return gulp.src([
            'app/libs/jquery/dist/jquery.min.js',
            'app/libs/masked/jquery.maskedinput.min.js',
            'app/libs/lazy/jquery.lazyload.min.js',
            'app/js/form.js', // Always at the end
        ])
        .pipe(concat('form.min.js'))
        // .pipe(uglify()) // Mifify js (opt.)
        .pipe(gulp.dest('app/js'))
        .pipe(browserSync.reload({ stream: true }))
});

// gulp.task('rsync', function() {
// 	return gulp.src('app/**')
// 	.pipe(rsync({
// 		root: 'app/',
// 		hostname: 'username@yousite.com',
// 		destination: 'yousite/public_html/',
// 		// include: ['*.htaccess'], // Includes files to deploy
// 		exclude: ['**/Thumbs.db', '**/*.DS_Store'], // Excludes files from deploy
// 		recursive: true,
// 		archive: true,
// 		silent: false,
// 		compress: true
// 	}))
// });

gulp.task('watch', ['styles', 'form', 'js', 'form-js', 'browser-sync'], function() {
    gulp.watch('app/' + syntax + '/**/*.' + syntax + '', ['styles']);
    gulp.watch(['libs/**/*.js', 'app/js/index.js'], ['js']);
    gulp.watch('app/*.html', browserSync.reload);
    gulp.watch('app/**/*.php', browserSync.reload);
});

gulp.task('default', ['watch']);