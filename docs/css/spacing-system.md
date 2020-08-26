Spacing
=======

Spacing classes can be used to stitch together components. This is useful because if you build the spacing before and after a component into the component itself, it's less likely to be reusable in a different context.

## Spacing Map

The spacing map is used to generate the various spacings needed throughout the size. The base spacing size is `1rem` which is the `xs` size. Each amount size is a multiplier of that base size as seen in the table below.

| Name   | Multiplier of base size | Rem Value | Pixel Value |
|--------|-------------------------|-----------|-------------|
| `xxxs` | 0.25&times;             | 0.25rem   | 4px         |
| `xxs`  | 0.5&times;              | 0.5rem    | 8px         |
| `xs`   | 1&times;                | 1rem      | 16px        |
| `sm`   | 1.5&times;              | 1.5rem    | 24px        |
| `md`   | 2&times;                | 2rem      | 32px        |
| `lg`   | 2.5&times;              | 2.5rem    | 40px        |
| `xl`   | 4&times;                | 4rem      | 64px        |
| `xxl`  | 6&times;                | 6rem      | 96px        |
| `xxxl` | 8&times;                | 8rem      | 128px       |

## Spacing Function

To utilize the spacing system within the Sass files a function has been created called `space()`. Use this in place of any number value you would use in properties such as `margin` or `padding`. The properties passed into the function is the named space from the table above.

**Example**

A class with this propert in the Sass: `margin: space(xxs) space(xl);`

Will output this in the rendered CSS: `margin: 0.5rem 4rem;`

## Spacing Classes

All spacing classes follow a similar format: `.util-[property]-[side]-[amount]`.

| Class Section | Options                                                            | Description |
|---------------|--------------------------------------------------------------------|-------------|
| [property]    | `margin`, `pad`                                                    | This defines which spacing property to utilize, either margin for a margin property or pad for a padding property                                                                                                                                                                                                                                              |
| [side]        | `all`, `y`, `x`, `top` ,`bottom`, `left`, `right`  | The side options are which side of the box to place the spacing amount. For a combined top and bottom value, use `y`, for a combined right and left value use `x`. To apply the same value to all sides use all.                                                                                                                                            |
| [amount]      | `none`, `xxxs`, `xxs`, `xs`, `sm`, `md`, `lg`, `xl`, `xxl`, `xxxl` | The amount of spacing is a lettered value for a multiplier of the base spacer value. By default the base spacer value is `1rem`, this is the amount use on the `xs` amount. To use a zero value spacing use the amount none.     |
| [breakpoint]  | `@sm`, `@md`, `@lg`, `@xl`                                         | An optional section can be added to the end of the class to indicate a breakpoint value (`.util-[property]-[side]-[amount]-@[breakpoint]`). For example, if you want a div to change from having small padding to a large padding at a specific breakpoint, this class section can be used to do just that: `<div class="util-padding-all-sm util-padding-all-md@lg">` |

## Margin
| Class                      | Description                                                             |
|----------------------------|-------------------------------------------------------------------------|
| .`util-margin-bottom-none` | Removes margin from the bottom of an element.                           |
| .`util-margin-bottom-xs`   | Adds an extra small amount of margin to the bottom of an element.       |
| .`util-margin-bottom-sm`   | Adds a small amount of margin to the bottom of an element.              |
| .`util-margin-bottom-md`   | Adds a medium amount of margin to the bottom of an element.             |
| .`util-margin-bottom-lg`   | Adds a large amount of margin to the bottom of an element.              |
| .`util-margin-bottom-xl`   | Adds an extra large amount of margin to the bottom of an element.       |
| .`util-margin-bottom-xxl`  | Adds an extra extra large amount of margin to the bottom of an element. |
| .`util-margin-top-none`    | Removes margin from the top of an element.                              |
| .`util-margin-top-xs`      | Adds an extra small amount of margin to the top of an element.          |
| .`util-margin-top-sm`      | Adds a small amount of margin to the top of an element.                 |
| .`util-margin-top-md`      | Adds a medium amount of margin to the top of an element.                |
| .`util-margin-top-lg`      | Adds a large amount of margin to the top of an element.                 |
| .`util-margin-top-xl`      | Adds an extra large amount of margin to the top of an element.          |
| .`util-margin-top-xxl`     | Adds an extra extra large amount of margin to the top of an element.    |

## Padding
| Class                   | Description                                                              |
|-------------------------|--------------------------------------------------------------------------|
| `.util-padding-bottom-none` | Removes padding from the bottom of an element.                           |
| `.util-padding-bottom-xs`   | Adds an extra small amount of padding to the bottom of an element.       |
| `.util-padding-bottom-sm`   | Adds a small amount of padding to the bottom of an element.              |
| `.util-padding-bottom-md`   | Adds a medium amount of padding to the bottom of an element.             |
| `.util-padding-bottom-lg`   | Adds a large amount of padding to the bottom of an element.              |
| `.util-padding-bottom-xl`   | Adds an extra large amount of padding to the bottom of an element.       |
| `.util-padding-bottom-xxl`  | Adds an extra extra large amount of padding to the bottom of an element. |
| `.util-padding-top-none`    | Removes padding from the top of an element.                              |
| `.util-padding-top-xs`      | Adds an extra small amount of padding to the top of an element.          |
| `.util-padding-top-sm`      | Adds a small amount of padding to the top of an element.                 |
| `.util-padding-top-md`      | Adds a medium amount of padding to the top of an element.                |
| `.util-padding-top-lg`      | Adds a large amount of padding to the top of an element.                 |
| `.util-padding-top-xl`      | Adds an extra large amount of padding to the top of an element.          |
| `.util-padding-top-xxl`     | Adds an extra extra large amount of padding to the top of an element.    |


## Responsive Spacing
To adjust margin and padding at different breakpoints you can add `@sm`, `@md`, `@lg`, `@xl` after any of the spacing classes:

- `<div class="util-margin-bottom-sm util-margin-bottom-md@md util-margin-bottom-lg@lg"></div>`
- `<div class="util-margin-bottom-sm util-margin-bottom-md@md util-margin-bottom-lg@lg"></div>`
- `<div class="util-margin-bottom-sm util-margin-bottom-md@md util-margin-bottom-lg@lg"></div>`

[Read more about responsive classes](https://seesparkbox.com/foundry/responsive_class_suffixes_automating_classes_with_sass_mixins_and_sass_maps)
