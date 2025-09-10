<?php

namespace CustomPosts;

use WP_Query;

\CustomPosts\initialize();

function initialize()
{
    add_action('init', '\CustomPosts\custom_post_type', 0);
    // add_action('init', '\CustomPosts\custom_taxonomy_type', 0);
    add_action('admin_init', '\CustomPosts\admin_init');   
    
    // add_action('save_post_market', '\CustomPosts\save_market_location' );
    // add_action('save_post_market', '\CustomPosts\save_date_time' );
    // add_action('save_post_recipe', '\CustomPosts\save_featured_recipe' );
}

function custom_post_type()
{

    // Set UI labels for Custom Post Type Market
    $labels = array(
        'name'                => _x('Services', 'Post Type General Name', 'firestorm'),
        'singular_name'       => _x('Service', 'Post Type Singular Name', 'firestorm'),
        'menu_name'           => __('Services', 'firestorm'),
        'parent_item_colon'   => __('Parent Service', 'firestorm'),
        'all_items'           => __('All Services', 'firestorm'),
        'view_item'           => __('View Service', 'firestorm'),
        'add_new_item'        => __('Add New Service', 'firestorm'),
        'add_new'             => __('Add New', 'firestorm'),
        'edit_item'           => __('Edit Service', 'firestorm'),
        'update_item'         => __('Update Service', 'firestorm'),
        'search_items'        => __('Search Service', 'firestorm'),
        'not_found'           => __('Not Found', 'firestorm'),
        'not_found_in_trash'  => __('Not found in Trash', 'firestorm'),
    );

    // Set other options for Custom Post Type
    $args = array(
        'label'               => __('service', 'firestorm'),
        'description'         => __('Servicees listings', 'firestorm'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail'],
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'rewrite' => array('slug' => 'service', 'with_front' => false),
        /* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 15,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'show_in_rest'        => TRUE

    );

    // Registering Custom Post Type Blogs
    register_post_type('service', $args);    
}

/**
 * Custom Fields in Posts
 */
function admin_init()
{
    // add_meta_box('market_location_meta', 'Market Web Address and Street Address', '\CustomPosts\market_location', 'market');
    // add_meta_box('market_date_time_meta', 'Market Dates and Times', '\CustomPosts\market_date_time', 'market' );
    // add_meta_box('featured_recipe_meta', 'Feature Recipe on Home Page', '\CustomPosts\featured_recipe', 'recipe', 'side' );
}


/**
 * Market location
 */
function market_location()
{
    global $post;

    $custom = get_post_custom($post->ID);
    $url    = (isset($custom['url'][0])) ? $custom['url'][0] : '';
    $address= (isset($custom['address'][0])) ? $custom['address'][0] : '';

?>
    <label for="url" style="width:100px;display:inline-block;">Web Address:</label>
    <input type="text" name="url" value="<?php echo $url; ?>" style="width:300px"/><br /><br />
    <label for="address" style="width:100px;display:inline-block">Market Address:</label>
    <input type="text" name="address" value="<?php echo $address; ?>" style="width:300px"/>

<?php    
}

function save_market_location()
{
    global $post;
    if( empty($post->ID)) return;

    $custom = get_post_custom($post->ID);
    $url    = $_POST['url'];
    $address= $_POST['address'];
    update_post_meta($post->ID, 'url', $url );
    update_post_meta($post->ID, 'address', $address );
}


/**
 * Market Dates and Times
 */
function market_date_time()
{
    global $post;

    $custom = get_post_custom($post->ID);
    $market_date_time   = isset($custom['market_date_time'] ) ? unserialize($custom['market_date_time'][0]) : []; 
    for( $i=0; $i<5; $i++ )
    {
        
        $date   = isset( $market_date_time[$i] ) ? $market_date_time[$i]["'date'"] : ''; 
        $start  = isset( $market_date_time[$i] ) ? $market_date_time[$i]["'start'"] : '';
        $end    = isset( $market_date_time[$i] ) ? $market_date_time[$i]["'end'"] : '';
        ?>
            <div class="market_date_time--wrapper">
                <label>Date:</label><input type="date" value="<?php echo $date; ?>" name="market_date_time[<?php echo $i; ?>]['date']" /><br />
                <label>Start Time:</label><input type="time" value="<?php echo $start; ?>" name="market_date_time[<?php echo $i; ?>]['start']" /><br />
                <label>End Time:</label><input type="time" value="<?php echo $end; ?>" name="market_date_time[<?php echo $i; ?>]['end']" /><br /><br />
            </div>  
        <?php
    }
}

function save_date_time()
{
    global $post;
    if (empty($post->ID)) return; 
    $market_date_time = $_POST['market_date_time']; 
    update_post_meta($post->ID, 'market_date_time', $market_date_time );

}

function featured_recipe()
{
    global $post;

    $custom = get_post_custom($post->ID);
    $featured_recipe = isset( $custom['featured_recipe'] ) ? $custom['featured_recipe'][0] : "0";
    ?>
    <!-- <label for="featured_recipe">Featured Recipe:</label> -->
    <input type="checkbox" name="featured_recipe" value="1" <?php echo ($featured_recipe == "1" ) ? 'checked' : ''; ?> /> Featured recipe
    <?php
}

function save_featured_recipe()
{
    global $post;
    if( empty($post->ID)) return;
    $featured_recipe = $_POST['featured_recipe'];
    update_post_meta($post->ID, 'featured_recipe', $featured_recipe );
}