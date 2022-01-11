import { src, dest } from 'gulp';
import plumber from 'gulp-plumber';

import config from '../config';

export default function general() {
    const source = config.paths.base.src + config.paths.general.src + config.paths.general.entry;
    const destination = config.paths.base.dest + config.paths.general.dest;

    return src(source)
        .pipe(plumber())
        .pipe(dest(destination));
}
