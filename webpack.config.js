// webpack v4

const path = require('path');
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const LiveReloadPlugin = require('webpack-livereload-plugin');

module.exports = (env, argv) => {

  return {
    entry: {
      'modules/ambbb-image-grid/css/frontend': './modules/ambbb-image-grid/scss/frontend.scss'
    },
    output: {
      path: path.resolve( __dirname ),
      filename: '[name].js'
    },
    module: {
      rules: [
        {
          test: /\.jsx?$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader'
          },
        },
        {
          test: /\.scss$/,
          use: [
            'style-loader',
            MiniCssExtractPlugin.loader,
            'css-loader',
            'postcss-loader',
            {
              loader: 'sass-loader',
              options: {
                sassOptions: {
                  outputStyle: ('production' === argv.mode) ? 'compressed' : 'expanded'
                }
              },
            },
          ]
        },
      ],
    },
    plugins: [
      new FixStyleOnlyEntriesPlugin(),
      new MiniCssExtractPlugin({
        filename: '[name].css'
      }),
      new LiveReloadPlugin({
        protocol: 'https'
      }),
    ],
    externals : {},
  }
}