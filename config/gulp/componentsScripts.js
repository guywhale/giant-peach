import { series, src, dest } from 'gulp';
import glob from 'glob';
import { writeFile } from 'fs';
import lec from 'gulp-line-ending-corrector';

import config from '../config';

const newline = '\r\n';

function componentsScript(cb) {
    const source = config.paths.base.src + config.paths.components.src + config.paths.components.entry + config.paths.base.globstar + config.paths.components.noAjax + config.paths.scripts.entry;
    const files = glob.sync(source);
    let content = '';

    if (files.length > 0) {
        const imports = files.map(file => {
            const fileName = file.replace('.js', '');
            return `import '${fileName.replace(config.paths.base.src + config.paths.components.src, './')}';${newline}`;
        });

        content = imports.reduce((carry, line) => carry + line);
    }

    writeFile(
        `${config.paths.base.src + config.paths.components.src}_components.js`,
        content,
        {},
        err => {
            if (err) {
                throw err;
            }
        }
    );

    cb();
}

function correctScript() {
    return src(`${config.paths.base.src}${config.paths.components.src}_components.js`)
        .pipe(lec())
        .pipe(dest(`${config.paths.base.src}${config.paths.components.src}`));
}

export default series(
    componentsScript,
    correctScript
);
