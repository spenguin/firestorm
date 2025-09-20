<?php
/**
 * Simple content wrapper
 */

function fs_text( $atts = [], $content = null, $tag = '' )
{
    ob_start(); ?>
        <section class="content">
            <div class="content__wrapper max-wrapper__narrow">
                <?php echo $content; ?>
                <?php echo do_shortcode('[ninja_form id=1]' ); ?>
            </div>
        </section>
    <?php
    return ob_get_clean();
}