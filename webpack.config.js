const NODE_ENV = process.env.NODE_ENV || 'development';
const webpack = require('webpack');
const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
    entry: './dev/app/main',

    output: {
        filename: './dist/app.js'
    },

    plugins: NODE_ENV === 'production' ? [
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false,
                drop_console: true,
                unsafe: true
            }
        })
    ] : [
        new CopyWebpackPlugin([{
            from: './dev/index.html', to: './dist/index.html'
        }
        ])
    ],

    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: "babel?presets[]=es2015"
            },
            {
                test: /\.scss$/,
                loader: "style!css!sass"
            }
        ]
    },

    watch: NODE_ENV === 'development',

    watchOptions: {
        aggregateTimeout: 100
    },

    devtool: NODE_ENV === 'development' ? 'eval' : null
};