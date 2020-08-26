'use strict';
const shell = require('shelljs');
const colors = require('colors');

const copyPaths = [
  { from: './src/php/*', to: './theme' },
];

console.log('Copying Task Started'.italic.bold.green);

copyPaths.forEach((path) => {
  console.log(`\nCopying ${path.from} ---> ${path.to}`.bold.cyan);
  shell.mkdir('-p', path.to);
  shell.cp('-r', path.from, path.to);
});
