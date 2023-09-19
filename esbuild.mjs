import * as esbuild from 'esbuild';
import { config } from 'dotenv';

config();

const isProduction = process.env.NODE_ENV !== 'development';

const options = {
  entryPoints: ['src/js/index.js'],
  format: 'esm',
  bundle: true,
  outfile: 'theme/js/scripts.js',
  // run `npx browserslist` to find updated minimum versions to set here
  target: ['chrome108', 'edge107', 'firefox102', 'safari15.4', 'opera93'],
  sourcemap: isProduction ? false : 'inline',
  minify: isProduction,
  logLevel: 'info',
};

if (!isProduction) {
  let context = await esbuild.context(options);
  await context.watch();
} else {
  await esbuild.build(options);
}
