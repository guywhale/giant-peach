import { existsSync, mkdirSync } from 'fs';

import config from '../config';

export default function create(cb) {
    if (!existsSync(config.paths.base.dest)) {
        mkdirSync(config.paths.base.dest);
    }
    cb();
}
