CSS Class Reference
======================

The CSS is organized using [Harry Roberts’](https://csswizardry.com) [Inverted Triangle CSS][itcss] (ITCSS) organizational approach. This method is mixed with [Block Element Modifier][bem] (BEM) naming convention for class names throughout the Sass files.

Partials
--------

We will use partials (a.k.a. components) via the Wordpress convention of a `template-parts` directory for all partials on the site. When creating a new partial keep these in mind:

1. Partials should be broken down into the smallest manageable and reusable size.
1. Partials should be styled with custom BEM classes or a collection of utility classes.
1. Layout styles should not be done in the partial, but instead on the referencing page or partial.

CSS Classes
-----------

When creating new CSS classes, be sure to reference the [Sparkbox standard][sb-standard-sass] for best practices.

| Class and System References             |
|-----------------------------------------|
| [Spacing System](css/spacing-system.md) |
| [Grid System](css/grid-system.md)       |
| [Text and Fonts](css/utility-text.md)   |

<!-- Links: -->
[itcss]:https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/
[bem]:http://getbem.com
[sb-standard-sass]:https://github.com/sparkbox/standard/tree/main/code-style/scss
