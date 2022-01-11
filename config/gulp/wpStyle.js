import { writeFile } from 'fs';

import config from '../config';

export default function wpStyle(cb) {
    const newline = '\r\n';

    let content = `/*${newline}`;

    for (const index in config.wordpress) {
        if (Object.prototype.hasOwnProperty.call(config.wordpress, index)) {
            content += `${index}: ${config.wordpress[index]}${newline}`;
        }
    }

    content += '*/';
    content += newline;

    writeFile(
        './style.css',
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
