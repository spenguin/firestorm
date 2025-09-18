<?php
/**
 * Render Products Teaser on Home Page
 */

function fs_products_teaser( $atts = [], $content = null, $tag = '' )
{
    $args = [
        'post_type'     => 'product',
        'posts_per_page'=> 3
    ];

    $query  = new WP_Query($args);
    
    ob_start(); ?>
        <section class="products-teaser">
            <h2>Recent Products</h2>
            <div class="products-teaser__wrapper tiles">
                <?php
                    if( $query->have_posts()): while( $query->have_posts()): $query->the_post(); 
                        $thumb = get_the_post_thumbnail_url();
                    ?>
                        <div class="products-teaser__tile tile" style="background-image:url(<?php echo $thumb; ?>);">
                            <h3><?php the_title(); ?></h3>
                        </div>
                    <?php endwhile; endif; wp_reset_postdata();
                ?>
            </div>
            <div class="cta--wrapper">
                <a href="products" class="button button-link" href="products">See all our Products</a>
            </div>
        </section>
    <?php
    return ob_get_clean();
}