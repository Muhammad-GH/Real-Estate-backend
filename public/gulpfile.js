var gulp = require('gulp');
var sass = require('gulp-sass');
var gulpIf = require('gulp-if');
var rename = require('gulp-rename');
var cssnano = require('gulp-cssnano');
var runSequence = require('run-sequence');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function() {
  return gulp.src('css/**/*.scss') // Gets all files ending with .scss in app/scss and children dirs
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('css'))
})

gulp.task('stylescompress', ['sass'], function() {
    gulp.src("css/**/style.css")
    .pipe(rename('style.min.css'))
    .pipe(gulpIf('*style.min.css', cssnano()))
    .pipe(gulp.dest('css/'));
});


gulp.task('watch', function(){
  gulp.watch('css/**/*.scss', ['sass','stylescompress']);
})


// Build Sequences
// ---------------

gulp.task('default', function(callback) {
    runSequence(['sass','stylescompress'], 'watch'
    )
})

gulp.task('build', function(callback) {
    runSequence(
        'sass',
        'stylescompress'
    )
})
