const browserify = require('browserify'),
      gulp = require('gulp'),
      sourcemaps = require('gulp-sourcemaps'),
      sass = require('gulp-sass'),
      autoprefixer = require('gulp-autoprefixer'),
      source = require('vinyl-source-stream'),
      buffer = require('vinyl-buffer'),
      uglify = require('gulp-uglify'),
      cleanCSS = require('gulp-clean-css');

const entry = './public/js/app.js',
      sassWatchPath = './public/sass/**/*.scss',
      jsWatchPath = './public/js/app.js';

gulp.task('js', function () {
    return browserify(entry, { debug: true, extensions: ['es6'] })
        .transform("babelify", {presets: ["es2015"]})
        .bundle()
        .pipe(source('app.bundle.js'))
        .pipe(buffer())
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sourcemaps.write())
        .pipe(uglify())
        .pipe(gulp.dest('./public/js/'));
});

gulp.task('sass', function () {
  return gulp.src(sassWatchPath)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
        browsers: ['last 2 versions']
    }))
    .pipe(sourcemaps.write())
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(gulp.dest('./public/css'));
});

gulp.task('watch', function () {
    gulp.watch(jsWatchPath, ['js']);
    gulp.watch(sassWatchPath, ['sass']);
});

gulp.task('default', ['js', 'sass', 'watch']);
