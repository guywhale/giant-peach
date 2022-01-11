import { writeFile } from 'fs';
import glob from 'glob';

import config from '../config';

import { styleLint, styleFix } from './style-tasks';

const newline = '\r\n';
const source = `${config.paths.base.src + config.paths.components.src}**/*.scss`;
const dest = config.paths.base.src + config.paths.components.dest;

function componentsStyles(cb) {
    const src = `${config.paths.base.src + config.paths.components.src}[^_]**/**/*.scss`;
    const files = glob.sync(src);
    let content = '';

    if (files.length > 0) {
        const reg = /(_)(\w*[-_]?\w*[-_]?[\w]*)(.scss)/gm;
        const sub = '$2';
        const imports = files.map(file => {
            const fileName = file.replace(reg, sub);
            return `@import '${fileName.replace(config.paths.base.src + config.paths.components.src, './')}';${newline}`;
        });

        content = imports.reduce((carry, line) => carry + line);
    }

    writeFile(
        `${config.paths.base.src + config.paths.components.src}_components.scss`,
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

function componentsStylesLint() {
    return styleLint(source);
}

function componentsStylesFix() {
    return styleFix(source, dest);
}

export {
    componentsStyles,
    componentsStylesLint,
    componentsStylesFix
};
