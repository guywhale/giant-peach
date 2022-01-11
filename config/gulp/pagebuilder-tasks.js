import { writeFile, readFileSync, openSync, closeSync, mkdirSync, existsSync } from 'fs';
import { src, dest } from 'gulp';
import lec from 'gulp-line-ending-corrector';

import config from '../config';

function pageBuilder(cb) {
    const layouts = getLayouts();
    generateContentPageBuilder(layouts);
    cb();
}

function getLayouts() {
    const fileName = config.acf.base + config.acf.key;
    let acfJson = readFileSync(fileName, 'utf8');
    acfJson = JSON.parse(acfJson);
    acfJson = acfJson.fields;
    const layouts = [];
    for (const k of acfJson) {
        if (k.name === config.acf.name) {
            for (const layout in k.layouts) {
                if (Object.prototype.hasOwnProperty.call(k.layouts, layout)) {
                    layouts.push(k.layouts[layout].name);
                }
            }
        }
    }
    return layouts;
}

function correctFile() {
    return src('./template-parts/content-pagebuilder.php')
        .pipe(lec({
            verbose: true
        }))
        .pipe(dest('./template-parts/'));
}

function generateContentPageBuilder(layouts) {
    let content = '';
    const n = '\r\n';
    const eol = '\r';
    const php = '<?php';
    const cStart = '/**';
    const c = ' *';
    const cEnd = ' */';
    const t = '    ';
    const haveRows = `(have_rows('${config.acf.name}')) {`;

    content += php + n + n + cStart + n;
    content += `${c} Template part for displaying page content in pagebuilder.php${n}`;
    content += c + n;
    content += `${c} SoBold${n}`;
    content += cEnd + n + n;
    content += `$layouts = [${n}`;

    for (const layout of layouts) {
        content += `${t}'${layout}',${n}`;
    }

    content += `];${n}${n}`;
    content += `if ${haveRows}${n}`;
    content += `${t}while ${haveRows}${n}`;
    content += `${t + t}the_row();${n}`;
    content += `${t + t}$layout = get_row_layout();${n}`;
    content += `${t + t}if (in_array($layout, $layouts)) {${n}`;
    content += `${t + t + t}echo \\Light\\render('build/components/pagebuilder/'`;
    content += ` . $layout);${n}`;
    content += `${t + t}}${n}`;
    content += `${t}}${n}`;
    content += `}${eol}`;

    writeFile(
        './template-parts/content-pagebuilder.php',
        content, {},
        err => {
            if (err) {
                throw err;
            }
        }
    );
}

function generateFiles(cb) {
    const layouts = getLayouts();
    const base = `${config.paths.base.src}${config.paths.components.src}pagebuilder/`;
    for (const layout of layouts) {
        if (!existsSync(base + layout)) {
            mkdirSync(base + layout);
            closeSync(openSync(`${base + layout}/${layout}.php`, 'w'));
        }
    }
    cb();
}

export {
    pageBuilder,
    correctFile,
    generateFiles
};
