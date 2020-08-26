Metabox.io Helpers
==================

### `should_show_meta_box_for`

Wrapper function that checks whether the current page is using the template. This keeps from having meta boxes on every page. Returns a `boolean`

| Parameter  | Definition                                                                       |
|------------|----------------------------------------------------------------------------------|
| $file      | The name of the file (including .php) e.g `home-page.php` or an array filenames. |


### `get_checkbox_value`

Returns true/false as to whether a checkbox was selected.

| Parameter  | Definition                                |
|------------|-------------------------------------------|
| $checkbox  | String returned from `rwmb_meta` function |
