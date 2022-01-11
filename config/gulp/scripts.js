import config from '../config';
import { script } from './script-tasks';

const src = config.paths.base.src + config.paths.scripts.src + config.paths.scripts.entry;
const dest = config.paths.base.dest + config.paths.scripts.dest;
const ajaxSrc = config.paths.base.src + config.paths.scripts.src + config.paths.ajax.scriptsSrc + config.paths.scripts.entry;

function scripts() {
    return script(src, dest);
}

function devScripts() {
    return script(src, dest, false);
}

function ajaxScripts() {
    return script(ajaxSrc, dest);
}

function devAjaxScripts() {
    return script(ajaxSrc, dest, false);
}

export {
    scripts,
    devScripts,
    ajaxScripts,
    devAjaxScripts
};
