Grid System
======================

The grid system we are using for page layouts is based on a 12 column grid with `20px` gutters between each column. Grid classes can be nested if needed for more complex layouts.

| Grid Sections                       |
|-------------------------------------|
| [Simple Grid](#simple-grid)         |
| [Responsive Grid](#responsive-grid) |
| [Extended Grid](#extended-grid)     |
| [Grid Gap](#grid-gap)               |
| [Grid Column Gap](#grid-column-gap) |
| [Grid Row Gap](#grid-row-gap)       |

## Simple Grid
Most grid layouts are going to use either a two, three, or four column layout. The basic grid system includes all of the classes needed to create a simple layout with class names that are spelled out and easy to read.

```
<div class="obj-grid">
  <div class="obj-grid__full"></div>

  <div class="obj-grid__half"></div>
  <div class="obj-grid__half"></div>

  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>

  <div class="obj-grid__quarter"></div>
  <div class="obj-grid__quarter"></div>
  <div class="obj-grid__quarter"></div>
  <div class="obj-grid__quarter"></div>

  <div class="obj-grid__third"></div>
  <div class="obj-grid__two-third"></div>

  <div class="obj-grid__quarter"></div>
  <div class="obj-grid__three-quarter"></div>
</div>
```

| Class                       | Description                                                            |
|-----------------------------|------------------------------------------------------------------------|
| `.obj-grid`                 | This is the class on the container that wraps around the grid columns. |
| `.obj-grid__full`           | For columns that span the entire width of the grid (12 columns).       |
| `.obj-grid__three-quarter`  | For columns that three quarter width of the grid (9 columns).          |
| `.obj-grid__two-third`	    | For columns that span two third width of the grid (8 columns).         |
| `.obj-grid__half`	          | For columns that span half of the width of the grid (6 columns).       |
| `.obj-grid__third`	        | For columns that span a third of the width of the grid (4 columns).    |
| `.obj-grid__quarter`	      | For columns that span a quarter of the width of the grid (3 columns).  |

## Responsive Grid

To adjust a the width of a column at different breakpoints you can add `@sm`, `@md`, `@lg`, `@xl` after any of the grid classes:

```
<div class="obj-grid">
  <div class="obj-grid__half obj-grid__third@sm"></div>
  <div class="obj-grid__half obj-grid__third@sm"></div>
  <div class="obj-grid__full obj-grid__third@sm"></div>

  <div class="obj-grid__full obj-grid__quarter@md"></div>
  <div class="obj-grid__full obj-grid__half@md"></div>
  <div class="obj-grid__full obj-grid__quarter@md"></div>
</div>
```

## Extended Grid

In addition to the simple grid system there is an extended grid system that allows for any combination of a 12 column grid system. The extended grid system can also be used responsively in the same way that as the simple grid system.

```
<div class="obj-grid">
  <div class="obj-grid__1-12"></div>
  <div class="obj-grid__11-12"></div>

  <div class="obj-grid__2-12"></div>
  <div class="obj-grid__10-12"></div>

  <div class="obj-grid__3-12"></div>
  <div class="obj-grid__9-12"></div>

  <div class="obj-grid__4-12"></div>
  <div class="obj-grid__8-12"></div>

  <div class="obj-grid__5-12"></div>
  <div class="obj-grid__7-12"></div>

  <div class="obj-grid__6-12"></div>
  <div class="obj-grid__6-12"></div>
</div>
```

| Class              | Description                                                            |
|--------------------|------------------------------------------------------------------------|
| `.obj-grid`        | This is the class on the container that wraps around the grid columns. |
| `.obj-grid__12-12` | For columns that span the entire width of the grid (12 columns).       |
| `.obj-grid__11-12` | For columns that span 11/12ths of the grid (11 columns).               |
| `.obj-grid__10-12` | For columns that span 5/6ths width of the grid (10 columns).           |
| `.obj-grid__9-12`  | For columns that three quarter width of the grid (9 columns).          |
| `.obj-grid__8-12`  | For columns that span two third width of the grid (8 columns).         |
| `.obj-grid__7-12`  | For columns that span 7/12ths width of the grid (7 columns).           |
| `.obj-grid__6-12`  | For columns that span half of the width of the grid (6 columns).       |
| `.obj-grid__5-12`  | For columns that span 5/12ths width of the grid (5 columns).           |
| `.obj-grid__4-12`  | For columns that span a third of the width of the grid (4 columns).    |
| `.obj-grid__3-12`  | For columns that span a quarter of the width of the grid (3 columns).  |
| `.obj-grid__2-12`  | For columns that span one sixth width of the grid (2 columns).         |
| `.obj-grid__1-12`  | For columns that span 1/12th width of the grid (1 columns).            |

## Grid Gap
Grid gap class defines the size of the gap between the columns in a grid layout. To adjust a the width of a gap at different breakpoints you can add `@sm`, `@md`, `@lg`, `@xl` after any of the grid gap classes.

```
<div class="obj-grid obj-grid--gap-xs">
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
</div>

<div class="obj-grid obj-grid--gap-sm">
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
</div>

<div class="obj-grid obj-grid--gap-md">
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
</div>

<div class="obj-grid obj-grid--gap-lg">
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
</div>

<div class="obj-grid obj-grid--gap-xl">
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
</div>

<div class="obj-grid obj-grid--gap-xxl">
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
  <div class="obj-grid__third"></div>
</div>
```

| Class                  | Description                                 |
|------------------------|---------------------------------------------|
| `.obj-grid--gap-none`  | Adds a 0px gap between the elements.        |
| `.obj-grid--gap-xxxs`  | Adds a 4px gap between the elements.        |
| `.obj-grid--gap-xxs`   | Adds a 8px gap between the elements.        |
| `.obj-grid--gap-xs`    | Adds a 24px gap between the elements.       |
| `.obj-grid--gap-sm`    | Adds a 16px gap between the elements.       |
| `.obj-grid--gap-md`    | Adds a 32px gap between the elements.       |
| `.obj-grid--gap-lg`    | Adds a 40px large gap between the elements. |
| `.obj-grid--gap-xl`    | Adds a 64px gap between the elements.       |
| `.obj-grid--gap-xxl`   | Adds a 96px gap between the elements.       |
| `.obj-grid--gap-xxxl`  | Adds a 128px gap between the elements.      |

## Grid Column Gap

Grid column gap class defines the size of the gap between only the columns in a grid layout. To adjust a the width of a gap at different breakpoints you can add `@sm`, `@md`, `@lg`, `@xl` after any of the grid gap classes.

| Class                         | Description                                   |
|-------------------------------|-----------------------------------------------|
| `.obj-grid--column-gap-none`  | Adds a 0px column gap between the elements.   |
| `.obj-grid--column-gap-xxxs`  | Adds a 4px column gap between the elements.   |
| `.obj-grid--column-gap-xxs`   | Adds a 8px column gap between the elements.   |
| `.obj-grid--column-gap-xs`    | Adds a 24px column gap between the elements.  |
| `.obj-grid--column-gap-sm`    | Adds a 16px column gap between the elements.  |
| `.obj-grid--column-gap-md`    | Adds a 32px column gap between the elements.  |
| `.obj-grid--column-gap-lg`    | Adds a 40px column gap between the elements.  |
| `.obj-grid--column-gap-xl`    | Adds a 64px column gap between the elements.  |
| `.obj-grid--column-gap-xxl`   | Adds a 96px column gap between the elements.  |
| `.obj-grid--column-gap-xxxl`  | Adds a 128px column gap between the elements. |

## Grid Row Gap

Grid row gap class defines the size of the gap between only the rows in a grid layout. To adjust a the width of a gap at different breakpoints you can add `@sm`, `@md`, `@lg`, `@xl` after any of the grid gap classes.

| Class                      | Description                                |
|----------------------------|--------------------------------------------|
| `.obj-grid--row-gap-none`  | Adds a 0px row gap between the elements.   |
| `.obj-grid--row-gap-xxxs`  | Adds a 4px row gap between the elements.   |
| `.obj-grid--row-gap-xxs`   | Adds a 8px row gap between the elements.   |
| `.obj-grid--row-gap-xs`    | Adds a 24px row gap between the elements.  |
| `.obj-grid--row-gap-sm`    | Adds a 16px row gap between the elements.  |
| `.obj-grid--row-gap-md`    | Adds a 32px row gap between the elements.  |
| `.obj-grid--row-gap-lg`    | Adds a 40px row gap between the elements.  |
| `.obj-grid--row-gap-xl`    | Adds a 64px row gap between the elements.  |
| `.obj-grid--row-gap-xxl`   | Adds a 96px row gap between the elements.  |
| `.obj-grid--row-gap-xxxl`  | Adds a 128px row gap between the elements. |
