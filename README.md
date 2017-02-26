# LittleSis Blog

Theme URI: https://github.com/misfist/littlesis
Tags: Blog, Bootstrap 4
Requires at least: 4.5.0
Tested up to: 4.7.2
Version: 0.0.3
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

Add your own CSS styles to /sass/theme/_child_theme.scss
or import you own files into /sass/theme/littlesis.scss

To overwrite Bootstrap or UnderStraps base variables just add your own value to:
/sass/theme/_child_theme_variables.scss

For example:
the "$brand-primary" variable is used by both, Bootstrap and UnderStrap.
Add your own color like:
$brand-primary: #ff6600;
in /sass/theme/_child_theme_variables.scss to overwrite it.
That will change automatically all elements who use this variable.
It will be outputted into:
/css/littlesis.min.css
and
/css/littlesis.css

So you have one clean CSS file at the end and just one request.

## Developing With NPM, Gulp, SASS and Browser Sync

### Installing Dependencies
- Make sure you have installed Node.js, Bower, and Browser-Sync [1] on your computer globally
- Then open your terminal and browse to the location of your UnderStrap copy
- Run: `$ npm install` then: `$ gulp copy-assets`

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


## Changelog

* 0.0.3 February 25, 2017
   * Updated AJAX filtering
   * To do: add infinite scrolling
* 0.0.2 February 22, 2017
   * General style updates for homepage
   * Removed `uncategorized` from filter-nav list

* 0.0.1 February 12, 2017 [WIP]
  - Initial
