<?php

if( !function_exists( 'ultratable_admin_body_class' ) ){
    /**
     * set class for Admin Body tag
     * 
     * @param type $classes
     * @return String
     */
    function ultratable_admin_body_class( $class ){
        global $current_screen;
        $s_id = isset( $current_screen->id ) ? $current_screen->id : '';
        if( strpos( $s_id, 'ultratable') !== false ){
            $class .= ' ultratable ultraaddons ';
        }
        return $class;
    }
}
add_filter( 'admin_body_class', 'ultratable_admin_body_class', 888 );


if( !function_exists( 'ultratable_modify_datas' ) ){
    /**
     * 
     * Using Following Filter: 
     * $_POST_DATA = apply_filters( 'ultratable_post_data_on_save', $data, $post_id, $post, $_POST );
     * 
     * @global type $current_screen
     * @param type $data
     * @param type $post_id
     * @return Array Return Data Arg for UtraTable type post
     */
    function ultratable_modify_datas( $data, $post_id ){
        $terms_string = 'terms';
        $terms = isset( $data[$terms_string] ) ? $data[$terms_string] : false;
        if( is_array( $terms ) ){
           foreach( $terms as $term_key => $term_ids ){
               $term_key_IN = $term_key . '_IN';
               $data['args']['tax_query'][$term_key_IN] = array(
                        'taxonomy'      => $term_key,
                        'field'         => 'id',
                        'terms'         => $term_ids, //Array of Term's IDs
                        'operator'      => 'IN'
               );
           } 
        }
        return $data;
    }
}
add_filter( 'ultratable_post_data_on_save', 'ultratable_modify_datas', 10, 2 );

if( !function_exists( 'ultratable_css_property_adding' ) ){
    /**
     * 
     * Using Following Filter: 
     * do_action( 'ultratable_admin_style_area', $item_name_prefix, $supported_css_property, $itemKey, $item, $colKey, $columnArr, $device_key );
     * 
     * @global type $current_screen
     * @param type $data
     * @param type $post_id
     * @return Array Return Data Arg for UtraTable type post
     */
    function ultratable_css_property_adding( $item_name_prefix, $supported_css_property, $itemKey, $item ){
        
        //var_dump($itemKey, $item, $colKey, $columnArr, $device_key, $supported_items,$supported_css_property);
        //var_dump($item_name_prefix,$supported_css_property);
        $style                = isset( $item['style'] ) ? $item['style'] : false;
        var_dump($supported_css_property);
        foreach( $supported_css_property as $style_key => $label ){
            $value = isset( $style[ $style_key ] ) ? $style[ $style_key ] : false;
            ?>
            <p class="each-style each-style-<?php echo esc_attr( $itemKey ); ?>">
                <lable><?php echo esc_html($label); ?></lable>
                <input name="<?php echo esc_attr($item_name_prefix); ?>[style][<?php echo esc_attr($style_key); ?>]" 
                       value="<?php echo esc_attr( $value ); ?>" 
                       placeholder="<?php echo esc_attr($label); ?>">   
            </p> 
            <?php
        }
        
    }
}
add_action( 'ultratable_admin_style_area', 'ultratable_css_property_adding', 10, 4 );

//add_action( 'admin_init', 'wpse_80112',99999 );

function wpse_80112() {

    // If we're on an admin page with the referer passed in the QS, prevent it nesting and becoming too long.
    global $pagenow;
    if( isset( $_GET['_wp_http_referer'] ) ){
        var_dump(isset( $_GET['_wp_http_referer'] ));
        exit;
    }
        if( 'admin.php' === $pagenow && isset( $_GET['_wp_http_referer'] ) && preg_match( '/_wp_http_referer/', $_GET['_wp_http_referer'] ) ) :
            //wp_redirect( remove_query_arg( array( '_wp_http_referer', '_wpnonce' ), wp_unslash( $_SERVER['REQUEST_URI'] ) ) );
            exit;
        endif;

}