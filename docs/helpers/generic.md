Generic Helpers
===============

### `get_custom_template`

Function to include a template part. Returns raw markup.

| Parameter  | Definition                                                                                       |
|------------|--------------------------------------------------------------------------------------------------|
| $slug      | The location of template part, e.g. `"template-parts/content-none.php"`                          |
| $variables | An array of variables to pass to the scope of the template file. Default is `[]`                 |

### `get_attribute_string`

Given an array of attributes, return a string of key="value" pairs separated by spaces. This is particularly helpful when creating a template that has optional parameters. It prevents having a long list of conditional attributes. Returns a `string`

| Parameter | Definition                                                                |
|-----------|---------------------------------------------------------------------------|
| $atts     | An array of HTML attributes                                               |
| $exclude  | An array of attributes to exclude from the output string. Default is `[]` |


### `get_kses_svg_ruleset`

WordPress requires you escape anything echoed onto the page. This returns an `array` of allowed html so that an SVG can be displayed. You would use by running: `<?php echo wp_kes( $my_svg, get_kses_svg_ruleset() ); ?>`

### `get_filenames_from_dir`

Useful if you need to know filenames in a directory. Return an array of strings.

| Parameter   | Definition                                                                  |
|-------------|-----------------------------------------------------------------------------|
| $path       | String path from the WordPress theme directory                              |
| $extension  | String name of the file extension you want to search for. Default is '.php' |

### `custom_hide_editor`

If you want to hide the default editor for a certain page template, add the page template to the `hidden_pages` array in `php/inc/theme-setup.php`

### `get_image_url`

Get Image URL from Image ID.

| Parameter  | Definition                                                                                          |
|------------|-----------------------------------------------------------------------------------------------------|
| $thumb_id  |  The ID of the image.                                                                               |
| $extension | The size. Either from [default sizes][sizes] or a custom size. |

### `get_featured_image_url`

Get the featured image URL from from within the [WordPress loop][loop]

| Parameter  | Definition                                                                                          |
|------------|-----------------------------------------------------------------------------------------------------|
| $extension | The size. Either from [default sizes][sizes] or a custom size. |

<!-- Links -->
[loop]:https://codex.wordpress.org/The_Loop
[sizes]:https://codex.wordpress.org/Post_Thumbnails#Thumbnail_Sizes