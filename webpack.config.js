import path from 'path';
import glob from 'glob';
// import ESLintPlugin from 'eslint-webpack-plugin';

export default (options) => {

    const eslintOptions = {
        fix: false,
    };

    let filename = '[name]';
    // const outputDir = path.resolve(__dirname, options.dest);

    if (options.production === true) {
        filename = filename + '.[chunkhash]';
    }

    filename += '.js';

    let config = {
        mode: (options.production === true ? 'production' : 'development'),
        // entry: glob.sync(options.src),
        output: {
            // path: outputDir,
            filename: filename
        },
        // plugins: [new ESLintPlugin(eslintOptions)],
        module: {
            rules: [{
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: ['source-map-loader'],
                    enforce: 'pre'
                },
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: ['babel-loader']
                }
            ]
        }
    };

    if (options.production !== true) {
        config.devtool = 'source-map'
    }

    return config;
}
