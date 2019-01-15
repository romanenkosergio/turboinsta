// var gulp = require('gulp'),
//     sass = require('gulp-sass'),
//     plumber = require('gulp-plumber'),
//     browserSync = require('browser-sync'),
//     autoprefixer = require('gulp-autoprefixer'),
//     cssmin = require('gulp-cssmin'),
//     rename = require('gulp-rename');


// gulp.task('sass', function () {
//    return gulp.src('sass/*.sass')
//         .pipe(plumber())
//         .pipe(sass())
//         .pipe(autoprefixer(['last 15 versions']))
//         .pipe(cssmin())
//         .pipe(rename({suffix: '.min'}))
//         .pipe(gulp.dest('css'))
//         .pipe(browserSync.reload({stream: true}))
// });

// gulp.task('browser-sync', function() {
//     browserSync.init(["css/*.min.css", "js/*.js", "*.html"], {
//         server: {
//             baseDir: "./"
//         }
//     });
// });

// gulp.task('default', ['sass', 'browser-sync'], function () {
//     gulp.watch("sass/*.sass", ['sass']);
// });



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
    rsync = require('gulp-rsync');

gulp.task('browser-sync', function() {
    browserSync({
        server: {
            baseDir: 'app'
        },
        notify: false,
        // open: false,
        // online: false, // Work Offline Without Internet Connection
        // tunnel: true, tunnel: "projectname", // Demonstration page: http://projectname.localtunnel.me
    })
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

gulp.task('js', function() {
    return gulp.src([
            'app/libs/jquery/dist/jquery.min.js',
            'app/libs/masked/jquery.maskedinput.min.js',
            // 'app/libs/wow/wow.min.js',
            'app/libs/owl/owl.carousel.min.js',
            // 'app/libs/snowfall/snowfall.js',
            'app/js/index.js', // Always at the end
        ])
        .pipe(concat('index.min.js'))
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

gulp.task('watch', ['styles', 'js', 'browser-sync'], function() {
    gulp.watch('app/' + syntax + '/**/*.' + syntax + '', ['styles']);
    gulp.watch(['libs/**/*.js', 'app/js/index.js'], ['js']);
    gulp.watch('app/*.html', browserSync.reload)
});

gulp.task('default', ['watch']);