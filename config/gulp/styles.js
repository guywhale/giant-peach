import config from '../config';
import { style, styleLint, styleFix } from './style-tasks';

const src = config.paths.base.src + config.paths.styles.src + config.paths.styles.entry;
const recSrc = config.paths.base.src + config.paths.styles.src + config.paths.styles.recEntry;
const dest = config.paths.base.dest + config.paths.styles.dest;

//* Styles called for production
function styles() {
    return style(src, dest);
}

//* Styles called for development
function devStyles() {
    return style(src, dest, false);
}

function stylesLint() {
    return styleLint(recSrc);
}

function stylesFix() {
    return styleFix(recSrc, dest);
}

export {
    styles,
    devStyles,
    stylesLint,
    stylesFix
};
