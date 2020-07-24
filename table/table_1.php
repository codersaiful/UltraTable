<?php
defined( 'ABSPATH' ) || exit;
/*
class DP_Shortcode_Discontinued extends WC_Shortcode_Products {

	
	protected function set_discontinued_products_query_args( &$query_args ) {
		$query_args['post__in'] = get_transient( 'dp_hide_from_shop' );
	}
}

*/
function aaaa_abdc_etc(){
    
    //$GLOBALS['woocommerce_loop'] = wp_parse_args( $args, $default_args );
    //var_dump(get_option( 'active_plugins' ));
    $meta_query  = WC()->query->get_meta_query();
    $tax_query   = WC()->query->get_tax_query();
    var_dump($GLOBALS['product'],$GLOBALS['wp_query']);
    var_dump(wp_parse_args(array('post_type'=>'product')));
    
    echo '<pre>';
    //print_r(WC());
    //print_r($tax_query);
    //print_r($meta_query);
    echo '</pre>';
}
//add_filter('init','aaaa_abdc_etc',99999999);


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
        var_dump($datas);
    }else{
        echo esc_html( 'Table ID is not founded!!!', 'ultratable' );
        return ob_get_clean();
    }
    
    $WPT_DIR_LINK = __DIR__;

    
    
    $args = array(
        'posts_per_page' => 8,
        'post_type' => array('product'), //, 'product_variation','product'
        'post_status'   =>  'publish',
    );

    //WPT_ARGS_Manager::sanitize($datas);
    
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