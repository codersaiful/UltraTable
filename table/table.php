<?php
defined( 'ABSPATH' ) || exit;

//include ULTRATABLE_TABLE_DIR . '/classes/class_shortcode.php';
include ULTRATABLE_TABLE_DIR . '/classes/class_ultratable_table.php';
include ULTRATABLE_TABLE_DIR . '/classes/ultratable_arg_manager.php';

add_shortcode('UltraTable', 'ultratable_table_generate');

function ultratable_table_generate( $atts ){
    global $wp_taxonomies, $wp_queries, $wp_query;
    //var_dump($wp_taxonomies, $wp_queries);
    ob_start();
    //$ultratable_short = new WPT_Shortcode_Products();
    
    if( isset( $atts['id'] ) && !empty( $atts['id'] ) && is_numeric( $atts['id'] ) && get_post_type( (int) $atts['id'] ) == 'ultratable' ){
        $POST_ID = $atts['id'];//isset( $atts['id'] ) ? $atts['id'] : false;
        $datas = get_post_meta( $POST_ID,'data',true);
        $datasss = get_post_meta( $POST_ID,'datas',true);
        //var_dump($datasss);
    }else{
        echo esc_html( 'Table ID is not founded!!!', 'ultratable' );
        return ob_get_clean();
    }
    
    //wc_setup_product_data($datasss);
    //var_dump(WC()->query->get_meta_query());
    
    /**
     * Initialize Page Number
     */
    $page_number = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : apply_filters( 'ultratable_default_page_number', 1, $POST_ID );
    $args['paged'] =( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : $page_number;
    wc_setup_loop( $args );
    $args = isset( $datas['args'] ) ? $datas['args'] : array( 'post_type' => array('product'), 'post_status' => 'publish' );
    //Add Filter for Args for Table
    $args = apply_filters( 'ultratable_table_args', $args, $datas, $atts, $POST_ID );
    $args = apply_filters( 'ultratable_table_args_' . $POST_ID, $args, $datas, $atts );
    
    //Add Filter for Data Here name is: $datas
    $datas = apply_filters( 'ultratable_table_data', $datas, $args, $atts, $POST_ID );
    $datas = apply_filters( 'ultratable_table_data_' . $POST_ID, $datas, $args, $atts );

    $class = isset( $datas['class'] ) && is_array( $datas['class'] ) ? $datas['class'] : array( 'ultratable_product_table' );
    $notfound = false;
    

    $class[] = 'ultratable_table_' . $POST_ID;
    $wrapper_class = implode(" ", $class);
    $wrapper_header_class = implode(" header_", $class);
    $wrapper_div_class = implode(" div_", $class);
    
    $wrapper_footer_class = implode(" footer_", $class);
    $device_name = WPT_TABLE::getDevice();
    $device_style_str = isset( $datas['device'][$device_name]['style_str'] ) ? $datas['device'][$device_name]['style_str'] : '';
    //$wrapper_style_str = isset( $datas['style_str'] ) ? $datas['style_str'] : '';
    
    /**
     * Arranging Args
     */
    
    //global $wpdb;
    //var_dump( get_queried_object(), wc_query_string_form_fields());
    //$sql = $GLOBALS['wp_query']->request;
    //var_dump($wpdb->get_results( $sql, ARRAY_A ));    
    //var_dump(get_page_statuses(),$GLOBALS['wp_query']->query_vars );
    
    
    
    $product_loop = new WP_Query( $args );// $GLOBALS['wp_query'];//
    //var_dump($args);
    //exit;
    /**
    var_dump($GLOBALS['wp_query']->posts);exit;
    $product_loop = $GLOBALS['wp_query']->posts;exit;
     */
    
    ?>
<div class="ultratable_main_wrapper device-<?php echo esc_attr( $device_name ); ?> <?php echo esc_attr( $wrapper_class ); ?>"  
     data-post_id='<?php echo esc_attr( $POST_ID ); ?>'
     data-atts='<?php echo esc_attr( wp_json_encode( $atts ) ); ?>'
     data-args='<?php echo esc_attr( wp_json_encode( $args ) ); ?>'
     data-args-backup='<?php echo esc_attr( wp_json_encode( $args ) ); ?>'
     style="<?php echo esc_attr( $device_style_str ); ?>"
     data-data='<?php echo esc_attr( wp_json_encode( $datas ) ); ?>'
     <?php 
     /**
      * To Add Something at Wrapper Attribute
      */
     do_action( 'ultratable_wrapper_tag_attribute' ); ?>
     >
    <div class="ultratable_header <?php echo esc_attr( $wrapper_header_class ); ?>">
        <?php
        //Universal Action for 
        do_action( 'ultratable_header', $args, $datas, $atts, $POST_ID, $product_loop );
        //Indivisual Action for Specific Table
        do_action( 'ultratable_header_' . $POST_ID, $args, $datas, $atts, $product_loop );
        ?>
    </div>
    <div 
        class="ultratable_table_div ultratable_table_div_<?php echo esc_attr( $POST_ID ); ?> <?php echo esc_attr( $wrapper_div_class ); ?>"
        
         >
        <?php 
        
        /**
         * Adding Table Content by using following Action Hook
         */
        do_action( 'ultratable_full_table', $product_loop, $args, $datas, $atts, $POST_ID );
        
        /**
         * Adding Table Content by using following Action Hook
         */
        do_action( 'ultratable_full_table' . $POST_ID, $product_loop, $args, $datas, $atts ); 
        
        
        ?>
    </div>
    <div class="ultratable_footer <?php echo esc_attr( $wrapper_footer_class ); ?>">

        <?php
        //Universal Action for 
        do_action( 'ultratable_footer', $args, $datas, $atts, $POST_ID, $product_loop );
        //Indivisual Action for Specific Table
        do_action( 'ultratable_footer_' . $POST_ID, $args, $datas, $atts, $product_loop );
        ?>
    </div>
</div>
    <?php
    wp_reset_query(); //Added reset query before end Table just at Version 1.0.0
    wp_reset_postdata();
    
    if( isset( $_GET['var_dump'] ) ){
        echo '<pre>';
        print_r($datas);
        echo '</pre>'; 
    }
    
    
    return ob_get_clean();;
}

add_action( 'wp_enqueue_scripts', array( 'WC_Frontend_Scripts', 'load_scripts' ) );
add_action( 'wp_print_scripts', array( 'WC_Frontend_Scripts', 'localize_printed_scripts' ), 5 );
add_action( 'wp_print_footer_scripts', array( 'WC_Frontend_Scripts', 'localize_printed_scripts' ), 5 );
include ULTRATABLE_TABLE_DIR . '/table_generator.php';