import { src, dest } from 'gulp';
import plumber from 'gulp-plumber';
import rename from 'gulp-rename';
import browsersync from 'browser-sync';
import config from '../config';

export default function componentsGeneral() {
    const destination = config.paths.base.dest + config.paths.components.dest;
    const source = `${config.paths.base.src + config.paths.components.src}**/*`;

    return src([
        source,
        config.paths.components.noScss,
        config.paths.components.noJs
    ])
        .pipe(plumber())
        .pipe(rename(path => {
            if (path.dirname !== '.' && path.extname === '.php') {
                const names = ['functions', 'acf', 'ajax'];
                if (!names.includes(path.basename)) {
                    path.basename = 'index';
                }
            }
            return path;
        }))
        .pipe(dest(destination))
        .pipe(browsersync.stream());
}
