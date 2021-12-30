module.exports = {
    entry: {
        burger: './frontend/js/burger.js',
        index: './frontend/js/index.js'
    },
    mode: 'development',
    devtool: 'inline-source-map',
    output: {
        path: `${__dirname}/public/js`,
        filename: '[name].js'
    }
}