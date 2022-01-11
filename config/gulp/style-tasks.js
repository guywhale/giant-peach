import gulp from 'gulp';
import plumber from 'gulp-plumber';
import browsersync from 'browser-sync';
import gulpSass from 'gulp-sass';
import dartSass from 'sass';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import stylelint from 'gulp-stylelint';
import sourcemaps from 'gulp-sourcemaps';
import atImport from 'postcss-import';
import rename from 'gulp-rename';
import gulpif from 'gulp-if';

import config from '../config';

const sass = gulpSass(dartSass);

function style(src, dest, prod = true) {
    const timestamp = Math.floor(Date.now() / 1000);

    return gulp.src(src)
        .pipe(gulpif(prod === true, plumber({
            errorHandler(err) {
                // eslint-disable-next-line no-console
                console.log(err.message);
                this.emit('end');
            }
        }), sourcemaps.init()))
        .pipe(sass({
            includePaths: config.paths.includePaths
        }))
        .pipe(postcss([
            atImport(),
            autoprefixer(),
            cssnano()
        ]))
        .pipe(gulpif(prod === true, rename({
            suffix: `.${timestamp}`
        })))
        .pipe(gulpif(prod !== true, sourcemaps.write('./')))
        .pipe(gulp.dest(dest))
        .pipe(browsersync.stream());
}

function styleLint(src) {
    return gulp.src(src)
        .pipe(plumber())
        .pipe(stylelint(config.plugins.stylelint));
}

function styleFix(src, dest) {
    config.plugins.stylelint.fix = true;

    return gulp.src(src)
        .pipe(plumber())
        .pipe(stylelint(config.plugins.stylelint))
        .pipe(gulp.dest(dest));
}

export {
    style,
    styleLint,
    styleFix
};
