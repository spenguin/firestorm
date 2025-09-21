<?php
/**
 * Images
 */

function wpdocs_setup_theme() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 350, 350 );
}
add_action( 'after_setup_theme', 'wpdocs_setup_theme' );

function cc_mime_types($mimes) 
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');