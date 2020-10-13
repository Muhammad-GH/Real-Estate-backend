

var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var cssnano = require('cssnano');
var sourcemaps = require('gulp-sourcemaps');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');



var paths = {
    styles: {
        src: 'css/**/*.scss',
        dest: 'css'
    },
    scripts: {
        src: 'node_modules/bootstrap/dist/js/**/*.js',
        dest: 'js/'
    }
};

function compressTask(){
    return gulp.src(paths.styles.src)
        .pipe(sass())
        .pipe(rename({ suffix: ".min" }))
        .pipe(postcss([ autoprefixer(), cssnano()]))
        .pipe(gulp.dest(paths.styles.dest));
}

function scssTask(){
    return gulp.src(paths.styles.src)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.styles.dest));
}


function jsTask(){
    return gulp.src(paths.scripts.src)
        //.pipe(concat('all.js'))
        //.pipe(uglify())
        .pipe(gulp.dest(paths.scripts.dest));
}

function watch(){
    gulp.watch(
        [paths.styles.src, paths.scripts.src],
        gulp.parallel(scssTask, compressTask)
    );
}

exports.default = gulp.series(
    gulp.parallel(scssTask, compressTask ,jsTask ), watch);
