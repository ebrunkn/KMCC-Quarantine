'use strict'
var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var gutil = require('gulp-util');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');


// Static Server + watching scss/html files
gulp.task('start', ['sass'], function () {

    browserSync.init({
        port: 4200,
        server: "./src",
        ghostMode: false,
        notify: false
    });

    gulp.watch('public/admin/scss/**/*.scss', ['sass']);
    gulp.watch('public/admin/**/*.scss').on('change', browserSync.reload);
    // gulp.watch('public/admin/**/*.html').on('change', browserSync.reload);
    gulp.watch('public/admin/**/*.css').on('change', browserSync.reload);

});



gulp.task('sass', function () {
    return gulp.src('public/admin/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(plumber({
            errorHandler: function (err) {
                notify.onError({
                    title: "Gulp error in " + err.plugin,
                    message: err.toString()
                })(err);
            }
        }))
        .pipe(sass())
        .on('error', function (err) {
            console.log(err.toString());
            this.emit('end');
        })
        .pipe(autoprefixer())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('public/admin/css'))
        .pipe(browserSync.stream());
});

gulp.task('sass:watch', function () {
    gulp.watch('public/admin/scss/**/*.scss');
});



// Static Server without watching scss files
gulp.task('serve:lite', function () {

    browserSync.init({
        server: "./",
        ghostMode: false,
        notify: false
    });

    // gulp.watch('public/admin/**/*.html').on('change', browserSync.reload);
    gulp.watch('public/admin/**/*.css').on('change', browserSync.reload);
    gulp.watch('public/admin/**/*.js').on('change', browserSync.reload);

});
