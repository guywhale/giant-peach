import { src, dest } from 'gulp';
import phpcs from 'gulp-phpcs';
import phpcbf from 'gulp-phpcbf';
import gutil from 'gutil';

import config from '../config';

const source = config.paths.php;

function php() {
    return src(source)
        .pipe(phpcs({
            bin: 'vendor/bin/phpcs',
            standard: 'PSR12',
            severity: 5,
            warningSeverity: 1
        }))
        .pipe(phpcs.reporter('log'));
}

// todo TEST function
function phpFix() {
    // return src(config.paths.php)
    return src('bad.php')
        .pipe(phpcbf({
            bin: '../vendor/bin/phpcbf',
            standard: 'PSR2',
            warningSeverity: 1
        }))
        // Outputs all files
        .on('error', gutil.log)
        .pipe(dest('bad2.php'));
}

export {
    php,
    phpFix
};
