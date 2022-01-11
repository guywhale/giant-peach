import gulp from 'gulp';
import browsersync from 'browser-sync';

import general from './general';
import assetManifest from './assetManifest';
import wpStyle from './wpStyle';
import config from '../config';
// import pot from './pot';

import fonts from './fonts';
import images from './images';
import svg from './svg';
import { devStyles, stylesLint } from './styles';
import { devAjaxScripts, devScripts } from './scripts';

import componentsGeneral from './componentsGeneral';
import { createAjaxFile, createAjaxScriptFiles } from './componentsAjax';
import { componentsStyles, componentsStylesLint } from './componentsStyles';
import componentsScripts from './componentsScripts';

import initVariables from './variables';

export default function watch() {
    //* Styles
    gulp.watch(
        config.paths.base.src + config.paths.styles.src + config.paths.styles.recEntry,
        gulp.parallel(
            gulp.series(
                devStyles,
                assetManifest
            ),
            stylesLint,
            componentsStylesLint
        )
    );

    //* Scripts
    gulp.watch(
        [
            `${config.paths.base.src + config.paths.scripts.src}**/*`,
            `!${config.paths.base.src + config.paths.scripts.src + config.paths.ajax.scriptsSrc}*`,
        ],
        gulp.series(
            devScripts,
            assetManifest
        )
    );

    //* General
    gulp.watch(
        `${config.paths.general.src}**/*`,
        { cwd: config.paths.base.src },
        general
    );

    //* PHP Files
    gulp.watch(
        config.paths.php,
        gulp.parallel(wpStyle, () => {
            browsersync.reload();
        })
    );

    //* Components PHP
    gulp.watch(
        [
            `${config.paths.base.src + config.paths.components.src}**/*`,
            config.paths.components.noScss,
            config.paths.components.noJs,
        ],
        gulp.series(
            componentsGeneral,
            assetManifest
        )
    );

    //* Components AJAX
    gulp.watch(
        [
            config.paths.base.src + config.paths.components.src + config.paths.base.globstar + config.paths.ajax.mainPhp
        ],
        createAjaxFile
    );

    //* Components Styles
    gulp.watch(
        [
            `${config.paths.base.src + config.paths.components.src}**/*.scss`,
            `!${config.paths.base.src + config.paths.components.src}*.scss`
        ],
        gulp.parallel(
            gulp.series(
                componentsStyles,
                devStyles,
                assetManifest
            ),
            stylesLint,
            componentsStylesLint
        )
    );

    //* Components Scripts
    gulp.watch(
        [
            `${config.paths.base.src + config.paths.components.src + config.paths.base.globstar + config.paths.components.noAjax}*.js`,
            `!${config.paths.base.src + config.paths.components.src}*.js`
        ],
        gulp.series(
            componentsScripts,
            devScripts,
            assetManifest
        )
    );

    //* Ajax scripts
    gulp.watch(
        [
            config.paths.base.src + config.paths.components.src + config.paths.base.globstar + config.paths.ajax.mainJs,
            `!${config.paths.base.src + config.paths.components.src}*.js`
        ],
        gulp.series(
            createAjaxScriptFiles,
            devAjaxScripts,
            assetManifest
        )
    );

    //* Variables.json
    gulp.watch(
        config.paths.variablesJson,
        initVariables
    );

    //* Images
    gulp.watch(
        `${config.paths.base.src + config.paths.images.src}**/*`,
        gulp.series(
            images,
            assetManifest
        )
    );

    //* Fonts
    gulp.watch(
        `${config.paths.base.src + config.paths.fonts.src}**/*`,
        gulp.series(
            fonts,
            assetManifest
        )
    );

    //* SVGs
    gulp.watch(
        config.paths.base.src + config.paths.images.src + config.paths.svg.entry,
        gulp.series(
            svg,
            assetManifest
        )
    );
}
