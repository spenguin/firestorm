<?php
/**
 * Images
 */

function wpdocs_setup_theme() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 350, 350 );
}
add_action( 'after_setup_theme', 'wpdocs_setup_theme' );