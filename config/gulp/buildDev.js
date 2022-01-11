import { series, parallel } from 'gulp';
import clean from './clean';
import create from './create';
import report from './report';
import fonts from './fonts';
import images from './images';
import general from './general';
import svg from './svg';
import { devStyles } from './styles';
import { devScripts, devAjaxScripts } from './scripts';
import pot from './pot';
import assetManifest from './assetManifest';
import wpStyle from './wpStyle';
import componentsGeneral from './componentsGeneral';
import componentsAjax from './componentsAjax';
import { componentsStyles } from './componentsStyles';
import componentsScripts from './componentsScripts';

export default series(
    clean,
    create,
    parallel(
        componentsGeneral,
        componentsStyles,
        componentsScripts
    ),
    componentsAjax,
    parallel(
        fonts,
        general,
        images,
        svg,
        pot,
        wpStyle,
        devStyles,
        devScripts,
        devAjaxScripts
    ),
    parallel(
        assetManifest,
        report
    )
);
