const path = require('path');
module.exports = {
    entry: {
        burger: path.resolve(__dirname, 'js/burger.js'),
        index: path.resolve(__dirname, 'js/index.js')
    },
    mode: 'development',
    devtool: 'inline-source-map',
    output: {
        path: path.resolve(__dirname, './../public/js'),
        filename: '[name].min.js'
    }
}

