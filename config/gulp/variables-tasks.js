import { readFileSync } from 'fs';
import { src, dest } from 'gulp';
import stylelint from 'gulp-stylelint';
import plumber from 'gulp-plumber';

import tasks from './variables/index';

import config from '../config';

function variables(cb) {
    let vars = readFileSync('./variables.json', 'utf8');
    let content = '';

    vars = JSON.parse(vars);

    for (const key in vars) {
        if (Object.prototype.hasOwnProperty.call(vars, key)) {
            switch (key) {
                case 'colors': {
                    content = tasks.colors(vars[key]);
                    break;
                }
                case 'palette': {
                    content += tasks.palette(vars[key]);
                    const fileName = '_colors.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                case 'grid': {
                    content = tasks.grid(vars[key]);
                    break;
                }
                case 'container': {
                    content += tasks.container(vars[key]);
                    break;
                }
                case 'gutters': {
                    content += tasks.gutters(vars[key]);
                    const fileName = '_grid.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                case 'spaces': {
                    content = tasks.spaces(vars[key]);
                    const fileName = '_spaces.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                case 'sizes': {
                    content = tasks.sizes(vars[key]);
                    const fileName = '_sizes.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                case 'fonts': {
                    content = tasks.fonts(vars[key]);
                    break;
                }
                case 'headings': {
                    content += tasks.headings(vars[key]);
                    const fileName = '_typography.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                case 'button': {
                    content = tasks.buttons(vars[key], 'buttons');
                    break;
                }
                case 'button-types': {
                    content += tasks.buttons(vars[key], 'button-types');
                    const fileName = '_button.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                case 'links': {
                    content = tasks.links(vars[key]);
                    const fileName = '_links.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                case 'core': {
                    content = tasks.core(vars[key]);
                    const fileName = '_core.scss';
                    tasks.utils(fileName, content);
                    break;
                }
                default: {
                    break;
                }
            }
        }
    }
    cb();
}

function variablesLint() {
    return src(`${config.paths.base.src + config.paths.styles.src}abstracts/variables/variables.scss`)
        .pipe(plumber())
        .pipe(stylelint(config.plugins.stylelint));
}

function variablesFix() {
    config.plugins.stylelint.fix = true;

    return src(`${config.paths.base.src + config.paths.styles.src}abstracts/variables/*.scss`)
        .pipe(plumber())
        .pipe(stylelint(config.plugins.stylelint))
        .pipe(dest(`${config.paths.base.src + config.paths.styles.src}abstracts/variables`));
}

export {
    variablesLint,
    variablesFix,
    variables
};
