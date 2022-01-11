import { series, parallel } from 'gulp';
import env from 'gulp-env';

import assetManifest from './config/gulp/assetManifest';
import browsersync from './config/gulp/browserSync';
import buildTask from './config/gulp/build';
import buildDevTask from './config/gulp/buildDev';
import watchTask from './config/gulp/watch';
import clean from './config/gulp/clean';
import create from './config/gulp/create';
import general from './config/gulp/general';
import report from './config/gulp/report';
import fonts from './config/gulp/fonts';
import images from './config/gulp/images';
import fix from './config/gulp/fix';
import { php } from './config/gulp/php';
import svg from './config/gulp/svg';
import { styles, devStyles, stylesLint, stylesFix } from './config/gulp/styles';
import { scripts, devScripts } from './config/gulp/scripts';
import pot from './config/gulp/pot';
import wpStyle from './config/gulp/wpStyle';
import { componentsStyles, componentsStylesLint, componentsStylesFix } from './config/gulp/componentsStyles';
import componentsScripts from './config/gulp/componentsScripts';
import initVariables from './config/gulp/variables';
import initEnv from './config/gulp/create-env';
import docs from './config/gulp/scssdocs';
import createComponent from './config/gulp/create-component';

import componentsGeneral from './config/gulp/componentsGeneral';
import { createAjaxFile, createAjaxScriptFiles } from './config/gulp/componentsAjax';
import pageBuilder from './config/gulp/pagebuilder';

const watch = series(buildDevTask, parallel(browsersync, watchTask));
const watchOnly = parallel(browsersync, watchTask);
const build = buildTask;
const buildDev = buildDevTask;

const taskName = process.argv[2];

if (taskName === 'watch' || taskName === 'watchOnly') {
    env('.env.js');
}

export {
    initEnv,
    createComponent,
    browsersync,
    assetManifest,
    pageBuilder,
    componentsGeneral,
    createAjaxFile,
    createAjaxScriptFiles,
    docs,
    build,
    buildDev,
    watch,
    clean,
    create,
    report,
    fonts,
    images,
    general,
    svg,
    styles,
    devStyles,
    stylesLint,
    stylesFix,
    scripts,
    devScripts,
    pot,
    php,
    wpStyle,
    componentsStyles,
    componentsStylesLint,
    componentsStylesFix,
    componentsScripts,
    fix,
    initVariables,
    watchOnly
};

export default build;
