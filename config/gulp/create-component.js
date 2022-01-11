import { openSync, closeSync, existsSync, mkdirSync } from 'fs';

import arg from './arg';
import config from '../config';

export default function createComponent(cb) {
    if (!arg.component) {
        cb(new Error('component is not defined'));
    }
    const { component } = arg;
    const source = `${config.paths.base.src}/${config.paths.components.src}/${component}`;
    if (!existsSync(source)) {
        mkdirSync(source);
    }
    closeSync(openSync(`${source}/${component}.php`, 'w'));
    closeSync(openSync(`${source}/acf.php`, 'w'));
    closeSync(openSync(`${source}/functions.php`, 'w'));
    closeSync(openSync(`${source}/_${component}.scss`, 'w'));
    closeSync(openSync(`${source}/_${component}.js`, 'w'));

    if (arg.ajax) {
        closeSync(openSync(`${source}/ajax.js`, 'w'));
        closeSync(openSync(`${source}/ajax.php`, 'w'));
    }

    cb();
}
