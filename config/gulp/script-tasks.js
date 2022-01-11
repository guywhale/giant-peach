// TODO CHECK FILE

import gulp from 'gulp';
import gulpif from 'gulp-if';
import plumber from 'gulp-plumber';
import browserSync from 'browser-sync';
import webpack from 'webpack';
import named from 'vinyl-named-with-path';
import webpackStream from 'webpack-stream';

import webpackConfig from '../../webpack.config';

// ? Check for improvements
export default function script(src, dest, prod = true) {
    return gulp.src(src)
        .pipe(gulpif(prod !== true, plumber({
            errorHandler(err) {
                // eslint-disable-next-line no-console
                console.log(err.message);
                this.emit('end');
            }
        })))
        .pipe(named())
        .pipe(webpackStream({
            config: [
                webpackConfig({
                    production: prod,
                })
            ]
        }, webpack))
        .pipe(gulp.dest(dest))
        .pipe(browserSync.stream());
}

// export default function script(src, dest, prod = true) {
//     return new Promise((resolve, reject) => {
//         webpack(webpackConfig({ src, dest, production: prod }), (err, stats) => {
//             if (err) {
//                 return reject(err);
//             }
//             if (stats.hasErrors()) {
//                 return reject(new Error(stats));
//             }
//             resolve();
//         });
//     });
// }

export {
    script
};
