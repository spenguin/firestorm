<?php

namespace Shortcodes;

require_once CORE_SHORTCODE . 'fs_services_display.php';


\Shortcodes\initialize();

function initialize()
{
    add_shortcode( 'fs_services_display', '\fs_services_display' );
}