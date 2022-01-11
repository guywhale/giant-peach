import { src, series } from 'gulp';
import open from 'gulp-open';
import sassdoc from 'sassdoc';

import config from '../config';

const source = config.paths.base.src + config.paths.styles.src + config.paths.styles.recEntry;

function docs() {
    return src(source)
        .pipe(sassdoc());
}

function openDocs(cb) {
    // TODO remove setTimeout and change structure to actually fire function when index.html is created
    // ? maybe use async or promises

    setTimeout(() => src('./sassdoc/index.html')
        .pipe(open()), 100);
    cb();
}

export default series(
    docs,
    openDocs
);
