import { src, dest } from 'gulp';
import imagemin from 'gulp-imagemin';

import config from '../config';

export default function images() {
    const source = config.paths.base.src + config.paths.images.src + config.paths.images.entry;
    const destination = config.paths.base.dest + config.paths.images.dest;

    return src(source)
        .pipe(imagemin([
            imagemin.gifsicle(config.plugins.imagemin.gif),
            imagemin.mozjpeg(config.plugins.imagemin.jpg),
            imagemin.optipng(config.plugins.imagemin.png),
            imagemin.svgo(config.plugins.imagemin.svg)
        ], {
            verbose: false,
            silent: true
        }))
        .pipe(dest(destination));
}
