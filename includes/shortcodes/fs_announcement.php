<?php
/**
 * Generate an announcement
 */

function fs_announcement( $atts = [], $content = null, $tag = '' )
{
    ob_start(); ?>
        <section class="announcement">
            <div class="announcement__wrapper max-wrapper__narrow">
                <?php echo $content; ?>
            </div>
        </section>
    <?php
    return ob_get_clean();
}