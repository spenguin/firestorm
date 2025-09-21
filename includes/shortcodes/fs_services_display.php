<?php
/**
 * Render Services on Home Page
 */

function fs_services_display( $atts = [], $content = null, $tag = '' )
{
    // extract(shortcode_atts(array(
    //     'name' => '',
    //  ), $atts));
    // if( empty($name)) return '';


    $args = [
        'post_type'         => 'service',
        'posts_per_page'    => -1
    ];

    $query = new WP_Query( $args );
    ob_start();
        if( $query->have_posts() ): ?>
            <section class="services">
                <!-- <h2>Services</h2> -->
                <!-- <h4>Healthy, Delicious Recipes</h4> -->
                <div class="services__wrapper tiles">
                        <?php while( $query->have_posts()): $query->the_post(); ?>
                        <div class="services__tile tile">
                            <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                the_post_thumbnail();
                            } ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_content(); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; wp_reset_postdata();
    return ob_get_clean();
}