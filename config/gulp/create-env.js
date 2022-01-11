import { src, dest, series } from 'gulp';
import rename from 'gulp-rename';
import replace from 'gulp-replace';

import arg from './arg';

function createEnv(cb) {
    if (!arg.browsersyncproxy) {
        cb(new Error('browsersyncproxy is not defined'));
    }
    return src('.env.js.sample')
        .pipe(rename('.env.js'))
        .pipe(dest('.'));
}

function replaceEnv() {
    const search = '%BROWSERSYNC_PROXY%';
    const proxy = arg.browsersyncproxy;
    return src('.env.js')
        .pipe(replace(search, proxy))
        .pipe(dest('.'));
}

export default series(
    createEnv,
    replaceEnv
);
