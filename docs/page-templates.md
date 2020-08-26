Page Templates
==============

[Page Templates][templates] allow for us to create re-usable structures for pages. In order to create a page template:

1. Create a PHP file called `<template-name>-page.php` in the `src/php` directory. Note, the "page" is not a WordPress requirement, but a way to keep track of templates.
1. In the File Comment, add `Template Name: My Template Name`. This is what WordPress uses to find templates. e.g.
  ```PHP
  /**
   * Template Name: Home Page
   */
  ```

<!-- Links -->
[templates]:https://developer.wordpress.org/themes/template-files-section/page-template-files/