<?php

namespace Shortcodes;

require_once CORE_SHORTCODE . 'fs_services_display.php';
require_once CORE_SHORTCODE . 'fs_products_teaser.php';
require_once CORE_SHORTCODE . 'fs_display_products.php';


\Shortcodes\initialize();

function initialize()
{
    add_shortcode( 'fs_services_display', '\fs_services_display' );
    add_shortcode( 'fs_products_teaser', '\fs_products_teaser' );
    add_shortcode( 'fs_display_products', '\fs_display_products' );
}