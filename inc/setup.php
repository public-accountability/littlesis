<?php
/**
 * LittleSis Set-up Functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.0
 */

function littlesis_setup() {

    load_theme_textdomain( 'littlesis', get_template_directory() . '/languages' );
    
    set_post_thumbnail_size( 350, 260, true );
}
add_action( 'after_setup_theme', 'littlesis_setup', 20 );
