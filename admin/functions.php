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

