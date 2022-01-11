import { src, dest } from 'gulp';
import plumber from 'gulp-plumber';
import wpPot from 'gulp-wp-pot';

import config from '../config';

export default function pot() {
    const source = config.paths.php;
    const destination = `./${config.wordpress['Text Domain']}.pot`;

    return src(source, { cwd: './' })
        .pipe(plumber())
        .pipe(wpPot({
            domain: config.wordpress['Text Domain'],
            package: config.wordpress['Text Domain']
        }))
        .pipe(dest(destination));
}
