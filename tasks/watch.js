'use strict';

const chokidar = require('chokidar');
const shell = require('shelljs');

// PHP Watch Task
chokidar.watch('src/php/**/*').on('change', () => {
  shell.exec('npm run copy');
});

// CSS Watch Task
chokidar.watch('src/scss/**/*').on('change', () => {
  shell.exec('npm run sass');
});
