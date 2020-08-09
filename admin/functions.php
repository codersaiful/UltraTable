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
        $h3_extra = isset( $item['location'] ) && !empty( $item['location'] ) ? __( ' Specially for ', 'ultratable' ) . $item['location'] : '';
        ?>
        <div class="style-wrapper<?php echo esc_attr( $itemKey ); ?>">
            <h3><?php echo esc_html(  'Style Area', 'ultratable' ) . $h3_extra; ?></h3>
        <table class="ultraaddons-table">    
        <?php
        $style                = isset( $item['style'] ) ? $item['style'] : false;
        foreach( $supported_css_property as $style_key => $label ){
            $value = isset( $style[ $style_key ] ) ? $style[ $style_key ] : false;
            ?>

            <tr class="each-style each-style-<?php echo esc_attr( $itemKey ); ?>">
                <th><label><?php echo esc_html($label); ?></label></th>
                <td>
                    <input 
                        class="ua_input"
                        name="<?php echo esc_attr($item_name_prefix); ?>[style][<?php echo esc_attr($style_key); ?>]" 
                        value="<?php echo esc_attr( $value ); ?>" 
                        placeholder="<?php echo esc_attr($label); ?>">   
                </td>
            </tr>
            <?php
        }
        ?>
        </table>    
        </div>    
        <?php
    }
}
add_action( 'ultratable_admin_style_area', 'ultratable_css_property_adding', 10, 4 );



if( !function_exists( 'ultratable_convert_style_from_arr' ) ){
    function ultratable_convert_style_from_arr( $style_arr = false ){
        $style_string = '';
        if( !empty( $style_arr ) && is_array( $style_arr ) ){
            $style_arr = array_filter( $style_arr );
            if( !is_array( $style_arr ) ){
                return '';
            }
            foreach($style_arr as $key => $stl){
                $style_string .= $key . ': ' . $stl . ';';
            }
        }
        
        return $style_string;
    }
}
if( !function_exists( 'ultratable_data_manipulation_on_save' ) ){
    
    /**
     * Ussing following Filter: apply_filters( 'ultratable_post_data_on_save', $data, $post_id, $post, $_POST );
     * from post_metabox.php file
     * 
     * @param type $data
     */
    function ultratable_data_manipulation_on_save( $data ){
        
        //Style Manipulation Here Start
        $devices = isset( $data['device'] ) ? $data['device'] : false;
        if( !is_array( $devices ) ){
            return $data;
        }
        
        foreach( $devices as $devc_key => $device ){
            $data['device'][$devc_key]['style_str'] = isset( $device['style'] ) && !empty( $device['style'] ) ? ultratable_convert_style_from_arr( $device['style'] ) : '';
            //var_dump($devc_key,);
            $columns = isset( $device['columns'] ) && is_array( $device['columns'] ) ? $device['columns'] : array();
            foreach( $columns as $col_key => $col ){       
                var_dump($col);
                $data['device'][$devc_key]['columns'][$col_key]['style_str'] = isset( $col['style'] ) && !empty( $col['style'] ) ? ultratable_convert_style_from_arr( $col['style'] ) : '';
                $data['device'][$devc_key]['columns'][$col_key]['head']['style_str'] = isset( $col['head']['style'] ) && !empty( $col['head']['style'] ) ? ultratable_convert_style_from_arr( $col['head']['style'] ) : '';
                $items = isset( $col['items'] ) && is_array( $col['items'] ) ? $col['items'] : array();
                foreach( $items as $item_key=>$item ){
                    //var_dump($data['device'][$devc_key]['columns'][$col_key]['items'][$item_key]);
                $data['device'][$devc_key]['columns'][$col_key]['items'][$item_key]['style_str'] = isset( $item['style'] ) && !empty( $item['style'] ) ? ultratable_convert_style_from_arr( $item['style'] ) : '';
                }
                
            }
        }
        //Style Manipulation Here End
        
        //exit;
        return $data;
    }
}
add_filter( 'ultratable_post_data_on_save', 'ultratable_data_manipulation_on_save' );



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