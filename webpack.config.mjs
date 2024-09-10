import path from 'path';
import { fileURLToPath } from 'url';
import MiniCssExtractPlugin from "mini-css-extract-plugin";
import TerserPlugin from 'terser-webpack-plugin';

import { scssf } from 'cssf/peer/sass.mjs';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default {
  mode: process.env.NODE_ENV || 'development',
  entry: [
    path.resolve(__dirname, 'assets/scss/index.scss'),
    path.resolve(__dirname, 'assets/js/index.js'),
  ],
  output: {
    path: path.join(__dirname, 'public'),
  },
  module: {
    rules: [{
      test: /\.scss$/,
      use: [
        MiniCssExtractPlugin.loader,
        'css-loader',
        {
          loader: 'sass-loader',
          options: {
            sassOptions: {
              functions: scssf.env,
              verbose: true,
              quietDeps: true,
              includePaths: [
                path.resolve(__dirname, 'node_modules'),
              ],
            },
            sourceMap: true
          }
        }
      ]
    }]
  },
  optimization: {
    minimize: true,
    // minimizer: [new TerserPlugin()],
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /node_modules/,
          chunks: 'initial',
          name: 'vendor',
          enforce: true
        },
      },
    } 
  },
  plugins: [
    new MiniCssExtractPlugin(),
    // new CssMinimizerPlugin(),
  ]
};
