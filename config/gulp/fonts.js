import { src, dest } from 'gulp';
import plumber from 'gulp-plumber';
import config from '../config';

export default function fonts() {
    const source = config.paths.base.src + config.paths.fonts.src + config.paths.fonts.entry;
    const destination = config.paths.base.dest + config.paths.fonts.dest;

    return src(source)
        .pipe(plumber())
        .pipe(dest(destination));
}
