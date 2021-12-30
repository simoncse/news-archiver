module.exports = {
    entry: {
        burger: './frontend/js/burger.js',
        index: './frontend/js/index.js'
    },
    mode: 'production',
    output: {
        path: `${__dirname}/public/js`,
        filename: '[name].min.js'
    }
}