var gulp = require('gulp'),
    less = require('gulp-less'), // compiles less to CSS
    sass = require('gulp-sass'), // compiles sass to CSS
    minify = require('gulp-minify-css'), // minifies CSS
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'), // minifies JS

// Paths variables
var paths = {
    'dev': {
        'sass': 'public/assets/sass/',
        'js': 'public/assets/js/'
    },
    'assets': {
        'css': 'public/assets/frontend/css/',
        'js': 'public/assets/frontend/js/'
    }
};

// --- TASKS
// CSS frontend
gulp.task('frontend.css', function() {
  // place code for your default task here
  return gulp.src(paths.dev.sass+'frontend.scss') // get file
    .pipe(sass())
    .pipe(gulp.dest(paths.assets.css)) // output: frontend.css
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.assets.css)); // output: frontend.min.css
});

// CSS backend
gulp.task('backend.css', function() {
  // place code for your default task here
  return gulp.src(paths.dev.sass+'backend.scss') // get file
    .pipe(sass())
    .pipe(gulp.dest(paths.assets.css)) // output: frontend.css
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.assets.css)); // output: frontend.min.css
});