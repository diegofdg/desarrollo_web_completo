const { src, dest, watch, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
const cache = require('gulp-cache');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');

function css( done ) {
    src('src/scss/**/*.scss')
        .pipe(plumber())
        .pipe(sass ())
        .pipe(dest('build/css'));
    done();
}

function imagenes( done ){
    const opciones = {
        optimizationLevel: 3
    };

    src('src/img/**/*.{png,jpg}')
        .pipe( cache( imagemin(opciones) ) )
        .pipe( dest('./build/img') )
    done();
}

function versionWebp( done ){
    const opciones = {
        quality: 50
    };
    src('src/img/**/*.{png,jpg}')
        .pipe( webp(opciones) )
        .pipe( dest('build/img') )
    done();
}

function dev ( done ) {
    watch('src/scss/**/*.scss', css);
    done();
}

exports.css = css;
exports.versionWebp = versionWebp;
exports.imagenes = imagenes;
exports.dev = parallel(imagenes, versionWebp, dev);