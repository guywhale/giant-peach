import { src } from 'gulp';
import sizereport from 'gulp-sizereport';

import config from '../config';

export default function report() {
    return src([
        config.paths.base.dest + config.paths.base.rec,
        `!${config.paths.base.dest}timestamp.txt`,
        '!**/*.php',
        '!**/group_*.json'
    ])
        .pipe(sizereport({
            gzip: true
        }));
}
