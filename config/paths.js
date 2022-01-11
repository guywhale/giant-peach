export default {
    base: {
        src: './dev/',
        dest: 'build/',
        rec: '**/*',
        globstar: '**/'
    },
    manifest: 'manifest.json',
    scripts: {
        src: 'scripts/',
        dest: 'scripts/',
        entry: '*.js'
    },
    styles: {
        src: 'styles/',
        dest: 'styles/',
        entry: '*.scss',
        recEntry: '**/*.scss'
    },
    fonts: {
        src: 'fonts/',
        dest: 'fonts/',
        entry: '**/*.{woff2,woff,otf,ttf,svg}'
    },
    general: {
        src: 'general/',
        dest: 'general/',
        entry: '**/*'
    },
    images: {
        src: 'images/',
        dest: 'images/',
        entry: '**/*'
    },
    svg: {
        src: 'images/',
        dest: 'svgs/',
        entry: '**/*.svg'
    },
    components: {
        src: 'components/',
        dest: 'components/',
        entry: '[^_]',
        noScss: '!**/*.scss',
        noJs: '!**/*.js',
        noAjax: '[!ajax]'
    },
    php: [
        '*.php',
        '**/*.php',
        '!vendor/**/*.*',
        '!node_modules/**/*.*',
    ],
    phpLogic: {
        main: 'app/'
    },
    ajax: {
        mainPhp: 'ajax.php',
        mainJs: 'ajax.js',
        recEntryPhp: '**/ajax.php',
        recEntryJs: '**/ajax.js',
        scriptsSrc: 'ajax/'
    },
    includePaths: [
        'node_modules/',
    ],
    variablesJson: [
        './variables.json'
    ]
};
