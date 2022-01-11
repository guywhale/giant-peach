import { src, dest } from 'gulp';
import plumber from 'gulp-plumber';
import imagemin from 'gulp-imagemin';

import config from '../config';

export default function svg() {
    const source = config.paths.base.src + config.paths.svg.src + config.paths.svg.entry;
    const destination = config.paths.base.dest + config.paths.svg.dest;

    return src(source)
        .pipe(plumber())
        .pipe(imagemin(
            [
                imagemin.svgo(config.plugins.imagemin.svgdeep)
            ],
            {
                verbose: false,
                silent: true
            }
        ))
        .pipe(dest(destination));
}
