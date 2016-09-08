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
    return gulp.src('src/sass/app.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('css/'));
});

// copy library dependencies 
gulp.task('lib', function() {
    gulp.src('node_modules/foundation-sites/js/**/*').pipe(gulp.dest('js/foundation'));
     gulp.src('node_modules/foundation-sites/dist/**/*').pipe(gulp.dest('js/foundation'));
    gulp.src('node_modules/jquery/dist/**/*').pipe(gulp.dest('js/jquery'));
    gulp.src('node_modules/vue/dist/**/*').pipe(gulp.dest('js/vue'));
    // gulp.src('node_modules/angular2/**/*').pipe(gulp.dest('src/app/static/angular2'));
    // gulp.src('node_modules/rxjs/**/*').pipe(gulp.dest('src/app/static/rxjs'));
    // gulp.src('node_modules/systemjs/**/*').pipe(gulp.dest('src/app/static/systemjs'));
    // gulp.src('node_modules/es6-promise/**/*').pipe(gulp.dest('src/app/static/es6-promise'));
    // gulp.src('node_modules/es6-shim/**/*').pipe(gulp.dest('src/app/static/es6-shim'));
    // gulp.src('node_modules/zone.js/**/*').pipe(gulp.dest('src/app/static/zone.js'));
    // gulp.src('node_modules/jquery/dist/**/*').pipe(gulp.dest('src/app/static/jquery'));
    // gulp.src('node_modules/bootstrap-sass/assets/fonts/bootstrap/**/*').pipe(gulp.dest('src/app/static/bootstrap'));
    // gulp.src('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js').pipe(gulp.dest('src/app/static/bootstrap/'));
});

// builds the static files
gulp.task('build',['lib','sass','js']);

// builds the project and runs the application
gulp.task('run',['build'],shell.task(['python src/run.py']));
// runs application with shell
gulp.task('run-shell',['build'],shell.task(['python src/shell.py']));

// watches source directory for changes and updates the associated files
gulp.task('watch',function(){
    gulp.start('build');
    // just run in a separate terminal
    // gulp.start('run');
    
    watch('src/js/**/*.js', batch(function (events, done) {
        gulp.start('js', done);
    }));
    watch('src/sass/**/*.scss', batch(function (events, done) {
        gulp.start('sass', done);
    }));
});