import { series, parallel } from 'gulp';

import { pageBuilder, correctFile, generateFiles } from './pagebuilder-tasks';

export default parallel(
    series(
        pageBuilder,
        correctFile
    ),
    generateFiles
);
