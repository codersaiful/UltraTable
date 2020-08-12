<?php
defined( 'ABSPATH' ) || exit;

//include ULTRATABLE_TABLE_DIR . '/classes/class_shortcode.php';
include ULTRATABLE_TABLE_DIR . '/classes/class_ultratable_table.php';
include ULTRATABLE_TABLE_DIR . '/classes/ultratable_arg_manager.php';

add_shortcode('UltraTable', 'ultratable_table_generate');

function ultratable_table_generate( $atts ){
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

    
    /**
     * Arranging Args
     */
    /**
     * Initialize Page Number
     */
    $page_number = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : apply_filters( 'ultratable_default_page_number', 1, $POST_ID );
    $args['paged'] =( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : $page_number;

    $product_loop = new WP_Query( $args );
    //var_dump($product_loop);
    
    
    ?>
<div class="ultratable_main_wrapper device-<?php echo esc_attr( $device_name ); ?> <?php echo esc_attr( $wrapper_class ); ?>"  
     data-post_id='<?php echo esc_attr( $POST_ID ); ?>'
     data-atts='<?php echo esc_attr( wp_json_encode( $atts ) ); ?>'
     data-args='<?php echo esc_attr( wp_json_encode( $args ) ); ?>'
     data-args-backup='<?php echo esc_attr( wp_json_encode( $args ) ); ?>'
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
        class="ultratable_table_div <?php echo esc_attr( $wrapper_div_class ); ?>"
        
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
        
        
        <?php
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

if( !function_exists( 'ultratable_table_full' ) ){
    //do_action( 'ultratable_footer', $args, $datas, $atts, $POST_ID );
    /**
     * 
     * @global type $current_screen
     * @param string $class
     * @return string
     */
    function ultratable_table_full( $product_loop, $args, $datas, $atts, $POST_ID ){
        //Before Table
        do_action( 'ultratable_before_table', $args, $datas, $atts, $POST_ID, $product_loop );
        
        
        //WPT_ARGS_Manager::sanitize($datas);
        WPT_TABLE::init( $datas );

        $class = isset( $datas['class'] ) && is_array( $datas['class'] ) ? $datas['class'] : array( 'ultratable_product_table' );
        $wrapper_table_class = implode(" table_", $class);
        $name = isset( $datas['name'] ) ? $datas['name'] : false;
        $title = isset( $datas['title'] ) ? $datas['title'] : false;
        $device_name = WPT_TABLE::getDevice();
        $device_style_str = isset( $datas['device'][$device_name]['style_str'] ) ? $datas['device'][$device_name]['style_str'] : '';
        
        ?>
        <table 
            class="ultratable_table <?php echo esc_attr( $wrapper_table_class ); ?>"
            style="<?php echo esc_attr( $device_style_str ); ?>"   
               >
            <?php
            //Include and Generate Table Head Tr here.
            if( WPT_TABLE::is_table_head() && WPT_TABLE::get_head() ){
            include ULTRATABLE_TABLE_DIR . '/includes/table-head.php';
            } ?>
            
            
            <tbody>
                <?php
                $product_loop = new WP_Query($args);
                
                //Getting Columns Info Based on Defice, Currently getting Desktop Column Only
                $table_row = WPT_TABLE::getCollumns();
                $fullwidth = WPT_TABLE::getFullwidth();
                $collcount = WPT_TABLE::columnCount();
                if ($product_loop->have_posts()) : while ($product_loop->have_posts()): $product_loop->the_post();
                global $product;

                    $product_id = $product->get_id();
                    $product_type = $product->get_type();

                    $wc_product = wc_get_product( $product_id );
                    $wc_product_data = $product->get_data();
                    $tr_title = get_the_title();


                    $current_tr = $table_row;
                    $rowtype = 'normal-row';
                    $collspan = 1;
                    include ULTRATABLE_TABLE_DIR . '/includes/table-row.php';

                    if( $fullwidth ){
                       $rowtype = 'fullwidth'; 
                       $collspan = $collcount;
                       $current_tr = array( 'fullwidth' => $fullwidth );
                       include ULTRATABLE_TABLE_DIR . '/includes/table-row.php';
                    }
                
                endwhile;
                else:
                //$notfound = __( 'Not founded', 'wpt' );    
                endif;
                //wp_reset_query(); //Added reset query before end Table just at Version 1.0.0
                //wp_reset_postdata();
                ?>
            </tbody>
            
        </table>
        <?php 
        //After Table And Speciall for Not founded Message
        do_action( 'ultratable_product_notfound', $args, $datas, $atts, $POST_ID, $product_loop );
        
        //After Table
        do_action( 'ultratable_after_table', $args, $datas, $atts, $POST_ID, $product_loop );
        
    }
}
add_action( 'ultratable_full_table', 'ultratable_table_full', 10, 5 );