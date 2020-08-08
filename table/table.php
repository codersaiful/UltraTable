<?php
defined( 'ABSPATH' ) || exit;

//include __DIR__ . '/classes/class_shortcode.php';
include __DIR__ . '/classes/class_wpt_table.php';
include __DIR__ . '/classes/wpt_arg_manager.php';

add_shortcode('UltraTable', 'wpt_table_generate');

function wpt_table_generate( $atts ){
    ob_start();
    //$wpt_short = new WPT_Shortcode_Products();
    
    if( isset( $atts['id'] ) && !empty( $atts['id'] ) && is_numeric( $atts['id'] ) && get_post_type( (int) $atts['id'] ) == 'ultratable' ){
        $POST_ID = $atts['id'];//isset( $atts['id'] ) ? $atts['id'] : false;
        $datas = get_post_meta( $POST_ID,'data',true);
        $datasss = get_post_meta( $POST_ID,'datas',true);
        //var_dump($datasss);
    }else{
        echo esc_html( 'Table ID is not founded!!!', 'ultratable' );
        return ob_get_clean();
    }
    
    $WPT_DIR_LINK = __DIR__;

    
    $args = isset( $datas['args'] ) ? $datas['args'] : array( 'post_type' => array('product'), 'post_status' => 'publish' );
    /*        
            array(
        'posts_per_page' => 8,
        'post_type' => array('product'), //, 'product_variation','product'
        'post_status'   =>  'publish',
    );
     * 
     */

    //WPT_ARGS_Manager::sanitize($datas);
    var_dump($datas);
    WPT_TABLE::init( $datas );
    
    
    $name = isset( $datas['name'] ) ? $datas['name'] : false;
    $title = isset( $datas['title'] ) ? $datas['title'] : false;
    $class = isset( $datas['class'] ) && is_array( $datas['class'] ) ? $datas['class'] : array( 'wpt_product_table' );
    $notfound = false;
    

    $class[] = 'wpt_table_' . $POST_ID;
    $wrapper_class = implode(" ", $class);
    $wrapper_header_class = implode(" header_", $class);
    $wrapper_div_class = implode(" div_", $class);
    $wrapper_table_class = implode(" table_", $class);
    $wrapper_footer_class = implode(" footer_", $class);
    ?>
<div class="wpt_main_wrapper <?php echo esc_attr( $wrapper_class ); ?>">
    <div class="wpt_header <?php echo esc_attr( $wrapper_header_class ); ?>">
        <?php
        //Universal Action for 
        do_action( 'wtp_header', $POST_ID );
        //Indivisual Action for Specific Table
        do_action( 'wtp_header_' . $POST_ID );
        ?>
    </div>
    <div class="wpt_table_div <?php echo esc_attr( $wrapper_div_class ); ?>">
        <table class="wpt_table <?php echo esc_attr( $wrapper_table_class ); ?>">
            <?php
            //Include and Generate Table Head Tr here.
            if( WPT_TABLE::is_table_head() && WPT_TABLE::get_head() ){
            include 'includes/table-head.php';
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
                    include 'includes/table-row.php';

                    if( $fullwidth ){
                       $rowtype = 'fullwidth'; 
                       $collspan = $collcount;
                       $current_tr = array( 'fullwidth' => $fullwidth );
                       include 'includes/table-row.php';
                    }
                
                endwhile;
                else:
                $notfound = __( 'Not founded', 'wpt' );    
                endif;
                wp_reset_query(); //Added reset query before end Table just at Version 1.0.0
                wp_reset_postdata();
                ?>
            </tbody>
            
        </table>
    </div>
    <div class="wpt_footer <?php echo esc_attr( $wrapper_footer_class ); ?>">
        <?php
        $notfound = apply_filters( 'wpt_notfound_msg', $notfound );
        if( $notfound ){
            include_once 'includes/notfound.php';
        }
        ?>
        
        <?php
        //Universal Action for 
        do_action( 'wtp_footer', $POST_ID );
        //Indivisual Action for Specific Table
        do_action( 'wtp_footer_' . $POST_ID );
        ?>
    </div>
</div>
    <?php
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