module.exports = {
    entry: {
        burger: './js/burger.js',
        index: './js/index.js'
    },
    mode: 'production',
    output: {
        path: `${__dirname}/static/js`,
        filename: '[name].min.js'
    }
}