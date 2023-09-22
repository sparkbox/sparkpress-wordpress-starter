# Custom Blocks

We have a plugin for custom blocks called `example-blocks`, which lives in `src/plugins`. For the blocks to be available in WordPress, these steps must be taken:

1. Run `npm run plugins:install` to install the plugin's npm dependencies
1. Run `npm start` for local development (this run's the plugin's `npm start` command)
1. Activate the "Example Blocks" plugin from the WordPress menu

For production builds, running `npm run build:prod` will also work, outputting production bundles for the blocks.

## Creating a New Custom Block

Follow these steps to create a new custom block and wire it up with the normal development/build processes:

1. Create a new folder at `src/plugins/example-blocks/<block-name>`
1. Either copy files from another block or manually create these files:
    - `block.json`: configuration/metadata for the block
    - `src/index.js`: entry point for the JS bundle
    - `src/edit.js`: the component used while editing
    - `src/save.js`: the component rendered on the site
    - `src/editor.scss`: custom styles for the editor view
    - `src/style.scss`: custom styles for the block when rendered on the site
1. Update `src/plugins/example-blocks/package.json` with these new scripts:
    - `build:<block-name>`
    - `start:<block-name>`
1. Configure the custom block by updating `block.json`, namely the `name`, `title`, `icon`, and `description` fields
1. Implement the edit function, which will usually be form controls corresponding to attributes that you define in `index.js`
1. Implement the save function, which will consume the attributes defined in `index.js` and render the block's desired markup

## Useful Resources

- [Create a Block Tutorial](https://developer.wordpress.org/block-editor/getting-started/create-block/)
- [Component Reference](https://developer.wordpress.org/block-editor/reference-guides/components/)
