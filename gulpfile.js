var gulp = require('gulp');
var ts = require('gulp-typescript');
var shell = require('gulp-shell');
var  watch = require('gulp-watch');
var batch = require('gulp-batch');
var sass = require('gulp-sass');
var uglify = require('gulp-uglifyjs');



//build typescript
gulp.task('js', function () {
    return gulp.src('src/js/**/*.js')
    .pipe(uglify('app.min.js'))
    .pipe(gulp.dest('js'))
});

// move templates from resource to the output directory
gulp.task('templates', function() {
    return gulp.src('resource/templates/**/*.html')
        .pipe(gulp.dest('src/app/static/templates'))
});

//builds the sass for the project
gulp.task('sass', function () {
    return gulp.src('src/sass/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./'));
});

// copy library dependencies 
gulp.task('lib', function() {
    gulp.src('node_modules/foundation-sites/js/**/*').pipe(gulp.dest('js/foundation'));
    gulp.src('node_modules/foundation-sites/dist/**/*').pipe(gulp.dest('js/foundation'));
    gulp.src('node_modules/jquery/dist/**/*').pipe(gulp.dest('js/jquery'));
    gulp.src('node_modules/vue/dist/**/*').pipe(gulp.dest('js/vue'));
});

// builds the static files
gulp.task('build',['lib','sass','js']);

// watches source directory for changes and updates the associated files
gulp.task('watch',function(){
    gulp.start('build');

    watch('src/js/**/*.js', batch(function (events, done) {
        gulp.start('js', done);
    }));
    watch('src/sass/**/*.scss', batch(function (events, done) {
        gulp.start('sass', done);
    }));
});