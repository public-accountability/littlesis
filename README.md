# LittleSis Blog

Theme URI: https://github.com/misfist/littlesis
Tags: Blog, Bootstrap 4
Requires at least: 4.5.0
Tested up to: 4.7.3
Version: 0.1.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description

Child theme based on Understrap theme.


## How it works

It shares with the parent theme all PHP files and adds its own functions.php on top of the UnderStrap parent theme's functions.php.

IT DID NOT LOAD THE PARENT THEMES CSS FILE(S)!
Instead it uses the UnderStrap Parent Theme as dependency via Bower and compiles its own CSS file from it.

Uses the Enqueue method the load and sort the CSS file the right way instead of the old @import method.

## Installation

1. Install the parent theme UnderStrap first: https://github.com/holger1411/understrap
- IMPORTANT: If you download it from GitHub make sure you rename the "understrap-master.zip" file just to "understrap.zip" or you might have problems using this child themes !!

2. Just upload the littlesis folder to your wp-content/themes directory
3. Go into your WP admin backend
4. Go to "Appearance -> Themes"
5. Activate the LittleSis Blog theme

## Editing

WordPress will use the parent theme templates to render pages except when there is an appropriate template in the LittleSis child theme.

Add your own CSS styles to /sass/theme/_{file}.scss

To overwrite Bootstrap or UnderStraps base variables just add your own value to:
/sass/theme/_bootstrap-custom-variables.scss

For example:
the "$brand-primary" variable is used by both, Bootstrap and UnderStrap.
Add your own color like:
$brand-primary: #ff6600;
in /sass/theme/_bootstrap-custom-variables.scss overwrite it.
That will change automatically all elements who use this variable.
It will be outputted into:
/css/style.min.css
and
/css/style.css

So you have one clean CSS file at the end and just one request.

## Developing With NPM, Gulp, SASS and Browser Sync

### Installing Dependencies
- Make sure you have installed Node.js, Bower, and Browser-Sync [1] on your computer globally
- Then open your terminal and browse to the location of your UnderStrap copy
- Run: `npm install` then: `gulp`

### Running
To work and compile your Sass files on the fly start:

- `$ gulp watch`

Or, to run with Browser-Sync:

- First change the browser-sync options to reflect your environment in the file `/gulpfile.js` in the beginning of the file:
```javascript
var browserSyncOptions = {
    proxy: "localhost/theme_test/", // <----- CHANGE HERE
    notify: false
};
```
- then run: `$ gulp watch-bs`

[1] Visit [http://browsersync.io](http://browsersync.io) for more information on Browser Sync

## Structure

Theme functions are in separate files within `/inc/`
Templates



## Changelog

* 0.1.8 April 5, 2017
  * Final styling updates
  * Removed author image from author page

* 0.1.7 March 31, 2017
  * Mobile styling updates

* 0.1.6 March 31, 2017
  * Updated content widths

* 0.1.5 March 30, 2017
  * Create author.php template
  * Changed search to use standard post loop template
  * Added new default thumbnail
  * Added infinite scroll on homepage that works with filtering
  * Updated styles

* 0.1.4.1 March 20, 2017
  * Reduced weight of single post byline

* 0.1.4 March 18, 2017
  * Added `max_pages` var to localized taxonomy-filter object
  * Added series template tag
  * Added SVG images for social icons and search
  * Updated styling

* 0.1.3 March 15, 2017
  * Modified post date to display date published (no update)
  * Removed post navigation from search page
  * Changed LittleSis logo to svg

* 0.1.2 March 14, 2017
  * Fixed JetPack load more button style

* 0.1.1 March 14, 2017
  * Disabled JetPack infinite scroll styling
  * Moved byline below title on archive pages

* 0.1.0 March 14, 2017
  * Style updates
  * Modified search form placeholder text
  * Made text domain consistent
  * Simplified related posts markup
  * Modified jetpack infinite scroll settings

* 0.0.10 March 11, 2017
  * Added custom Related Posts template and styling
  * Removed old related posts filters
  * Removed post navigation from single posts
  * Removed post tags from single posts
  * Added `posts_per_page` property to localized  `littlesis_taxonomy_filters` object, based on `posts_per_page` option selected in admin. Applied to home page
  * General style updates

* 0.0.9 March 6, 2017
  * Implemented search
  * Updated styles
  * Modified featured image function to add class for `no-thumbnail`
  * Removed comments
  * Implemented related articles

* 0.0.8 February 27, 2017
  * Modified filter to select from categories selected from Category Filters menu
  * Updated styles based on updated comps

* 0.0.7 February 27, 2017
   * Styling updates
   * Modified footer to allow for copyright info as widget

* 0.0.4 February 26, 2017
   * Added default thumbnail that appears when there is no featured image
   * Overrode default JetPack OpenGraph image

* 0.0.3 February 25, 2017
   * Updated AJAX filtering
   * To do: add infinite scrolling
* 0.0.2 February 22, 2017
   * General style updates for homepage
   * Removed `uncategorized` from filter-nav list

* 0.0.1 February 12, 2017 [WIP]
  - Initial
