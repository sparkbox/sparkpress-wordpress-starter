const path = require('path');
require('dotenv').config();

module.exports = {
  entry: {
    scripts: './src/js/index.js',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, './theme/js'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
      },
    ],
  },
};
