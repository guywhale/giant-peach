import { writeFile } from 'fs';
import config from '../../config';

const defaultPath = `${config.paths.base.src + config.paths.styles.src}abstracts/variables/`;

export default (fileName, content) => {
    writeFile(
        defaultPath + fileName,
        content.replace(/\r\n/g, '\n'),
        err => {
            if (err) throw err;
        }
    );
};
