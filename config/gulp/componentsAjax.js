import glob from 'glob';
import del from 'del';
import { writeFile, existsSync, unlinkSync } from 'fs';
import { series } from 'gulp';

import config from '../config';

export function createAjaxFile(cb) {
    const ajaxSource = config.paths.base.src + config.paths.components.src + config.paths.ajax.recEntryPhp;
    const ajaxSourceFiles = glob.sync(ajaxSource);
    const ajaxDestination = config.paths.base.dest + config.paths.components.dest + config.paths.ajax.recEntryPhp;
    const ajaxDestinationFiles = glob.sync(ajaxDestination);

    const newline = '\n';
    const tab = '    ';
    let content = '';

    if (existsSync(config.paths.phpLogic.main + config.paths.ajax.mainPhp)) {
        unlinkSync(config.paths.phpLogic.main + config.paths.ajax.mainPhp);
    }

    if (ajaxSourceFiles.length > 0) {
        content += `<?php${newline}`;
        content += `${newline}$ajaxFiles = [`;
        const requires = ajaxSourceFiles.map(file => {
            const fileName = file.replace(config.paths.base.src, config.paths.base.dest);
            return `${newline + tab}'${fileName}',`;
        });
        content += requires.reduce((carry, line) => carry + line);
        content += `${newline}];${newline + newline}`;
        content += 'foreach ($ajaxFiles as $ajaxFile) {';
        content += `${newline}${tab}require_once get_template_directory() . '/' . $ajaxFile;`;
        content += `${newline}}`;
        content += newline;

        writeFile(
            config.paths.phpLogic.main + config.paths.ajax.mainPhp,
            content,
            {},
            err => {
                if (err) {
                    throw err;
                }
            }
        );
    }

    if (ajaxDestinationFiles.length > 0) {
        ajaxDestinationFiles.forEach((file, index) => {
            const destinationFile = file.replace(config.paths.base.dest, '');
            const sourceFile = ajaxSourceFiles[index] ? ajaxSourceFiles[index].replace(config.paths.base.src, '') : null;

            if (destinationFile !== sourceFile) {
                unlinkSync(file);
            }
        });
    }

    cb();
}

export function createAjaxScriptFiles(cb) {
    del.sync([
        `${config.paths.base.src + config.paths.scripts.src + config.paths.ajax.scriptsSrc}*.js`
    ]);

    const newline = '\n';
    const source = config.paths.base.src + config.paths.components.src + config.paths.components.entry + config.paths.ajax.recEntryJs;
    const files = glob.sync(source);

    if (files.length > 0) {
        files.forEach(file => {
            const fileName = file.replace('.js', '');
            const content = `import '${fileName.replace(config.paths.base.src, '../../')}';${newline}`;
            let ajaxFile = file.replace(config.paths.base.src + config.paths.components.src, '');
            ajaxFile = ajaxFile.replace(`/${config.paths.ajax.mainJs}`, '.js');

            writeFile(
                config.paths.base.src + config.paths.scripts.src + config.paths.ajax.scriptsSrc + ajaxFile,
                content,
                {},
                err => {
                    if (err) {
                        throw err;
                    }
                }
            );
        });
    }
    cb();
}

export default series(
    createAjaxFile,
    createAjaxScriptFiles
);
