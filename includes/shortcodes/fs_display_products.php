<?php
/**
 * Render Products on Products Page
 */

function fs_display_products( $atts = [], $content = null, $tag = '' )
{

    $collection_children = get_children_by_parent('collections');
    $products_children   = get_children_by_parent('products'); 

    $products   = get_products(); ?>

    <div id="ProductPage"></div>

    <script>
        var collection_children = <?php echo json_encode($collection_children); ?>;
        var products_children   = <?php echo json_encode($products_children); ?>;
        var products            = <?php echo json_encode(array_values($products)); ?>;
    </script>
    <script type="text/javascript" src="<?php echo CORE_DIST; ?>productpage.js"></script>

    <?php
}

function get_children_by_parent($parent_slug)
{ 
    $term_slug      = $parent_slug; // Replace with the actual slug of your term
    $taxonomy_name  = 'product_cat'; // Replace with the name of your custom taxonomy

    $parent_term    = get_term_by( 'slug', $term_slug, $taxonomy_name ); 

    $children_terms = get_terms([
        'taxonomy'  => $taxonomy_name,
        'hide_empty'=> 1,
        'parent'    => $parent_term->term_id
    ]);

    $o  = [];
    foreach( $children_terms as $child )
    {
        $o[$child->term_id] = $child->name;
    }

    return $o;
}