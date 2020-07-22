<?php

if ( ! function_exists('ultratable_post') ) {

/**
 * Create Custom post type for Ultra Table. From now, we will store our shortcode or shortcode's value in this post as meta value
 * 
 * @since 4.1
 * @link https://codex.wordpress.org/Post_Types See details at WordPress.org about Custom Post Type
 */
function ultratable_post() {
        $icon = ULTRATABLE_BASE_URL . 'assets/images/table_icon.png';
	$labels = array(
		'name'                  => _x( 'Ultra Table', 'Ultra Table', 'ultratable' ),
		'singular_name'         => _x( 'ULTRA TABLE', 'PRODUCT TABLE', 'ultratable' ),
		'menu_name'             => __( 'ULTRA TABLE', 'ultratable' ),
		'name_admin_bar'        => __( 'Ultra Table', 'ultratable' ),
		'archives'              => __( 'Ultra Table Archives', 'ultratable' ),
		'attributes'            => __( 'Ultra Table Attributes', 'ultratable' ),
		'parent_item_colon'     => __( 'Parent Shortcode:', 'ultratable' ),
		'all_items'             => __( 'Ultra Table', 'ultratable' ),
		'add_new_item'          => __( 'Add New', 'ultratable' ),
		'add_new'               => __( 'Add New', 'ultratable' ),
		'new_item'              => __( 'New Ultra Table', 'ultratable' ),
		'edit_item'             => __( 'Edit Ultra Table', 'ultratable' ),
		'update_item'           => __( 'Update Ultra Table', 'ultratable' ),
		'view_item'             => __( 'View Ultra Table', 'ultratable' ),
		'view_items'            => __( 'View Ultra Tables', 'ultratable' ),
		'search_items'          => __( 'Search Ultra Table', 'ultratable' ),
		'not_found'             => __( 'Not found', 'ultratable' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'ultratable' ),
		'featured_image'        => __( 'Featured Image', 'ultratable' ),
		'set_featured_image'    => __( 'Set featured image', 'ultratable' ),
		'remove_featured_image' => __( 'Remove featured image', 'ultratable' ),
		'use_featured_image'    => __( 'Use as featured image', 'ultratable' ),
		'insert_into_item'      => __( 'Insert into Ultra Table', 'ultratable' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Ultra Table', 'ultratable' ),
		'items_list'            => __( 'Ultra Table list', 'ultratable' ),
		'items_list_navigation' => __( 'Ultra Table list navigation', 'ultratable' ),
		'filter_items_list'     => __( 'Filter Ultra Table list', 'ultratable' ),
	);
	$args = array(
		'label'                 => __( 'PRODUCT TABLE', 'ultratable' ),
		'description'           => __( 'Generate your shortcode for Ultra Table.', 'ultratable' ),
		'labels'                => $labels,
		'supports'              => array('title'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 40,
                'menu_icon'             => $icon,//'dashicons-list-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
                'register_meta_box_cb'  => 'ultratable_shortcode_metabox',
	);
	register_post_type( 'ultratable', $args );

}
add_action( 'init', 'ultratable_post', 0 );

}

if( !function_exists( 'ultratable_shortcode_column_head' ) ){
    //Showing shortcode in All Shortcode page
    function ultratable_shortcode_column_head($default){
        if ( 'ultratable_' == get_post_type() ){
        $default['ultratable_shortcode'] = "Shortcode";
        }
        return $default;
    }
}
add_filter('manage_posts_columns', 'ultratable_shortcode_column_head');

if( !function_exists( 'ultratable_shortcode_column_content' ) ){
    function ultratable_shortcode_column_content($column_name, $post_id){
        if ($column_name == 'ultratable_shortcode') {
            $post_title = get_the_title( $post_id );
            $post_title = preg_replace( '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/',"$1", $post_title );
            echo "<input style='display: inline-block;width:300px;' class='ultratable_auto_select_n_copy' type='text' value=\"[Ultra_Table id='{$post_id}' name='{$post_title}']\" id='ultratable_shotcode_content_{$post_id}' readonly>";
            echo '<a style="font-size: 12px !important;padding: 4px 13px !important" class="button button-primary ultratable_copy_button_metabox" data-target_id="ultratable_shotcode_content_' . $post_id . '">'. esc_html__( 'Copy','ultratable' ).'</a>';
            echo '<p style="color: green;font-weight:bold;display:none; padding-left: 12px;" class="ultratable_shotcode_content_' . $post_id . '"></p>';
        }  
    }
}
add_action('manage_posts_custom_column', 'ultratable_shortcode_column_content', 2, 2);


//Permalink Hiding Option
add_filter( 'get_sample_permalink_html', 'ultratable_permalink_hiding' );
if( !function_exists( 'ultratable_permalink_hiding' ) ){
    function ultratable_permalink_hiding( $return ) {
        if ( 'ultratable_' == get_post_type() ){
            $return = '';
        }
        return $return;
    }
}


//Hiding Preview Button from all shortcode page
add_filter( 'page_row_actions', 'ultratable_preview_button_hiding', 10, 2 );
add_filter( 'post_row_actions', 'ultratable_preview_button_hiding', 10, 2 );
if( !function_exists( 'ultratable_preview_button_hiding' ) ){
    function ultratable_preview_button_hiding( $actions, $post ) {

        if ( 'ultratable_' == get_post_type() ){
            unset( $actions['inline hide-if-no-js'] );
            unset( $actions['view'] );
        }
        return $actions;
    }
}