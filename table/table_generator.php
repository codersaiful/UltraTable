<?php
defined( 'ABSPATH' ) || exit;

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
        $device_style_str = '';//isset( $datas['device'][$device_name]['style_str'] ) ? $datas['device'][$device_name]['style_str'] : '';
        ?>
        <div class="ultratable-table-wrapper ultratable-table-wrapper-<?php echo esc_attr( $POST_ID ); ?>">
            <table 
                class="ultratable_table <?php echo esc_attr( $wrapper_table_class ); ?>"
                style="<?php echo esc_attr( $device_style_str ); ?>"   
                   >
                <?php
                $thead_show = apply_filters( 'ultratable_table_head_show', true, $args, $datas, $atts, $POST_ID, $product_loop  );
                //Include and Generate Table Head Tr here.
                if( $thead_show ){
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
        </div>
        
        <?php 
        //After Table And Speciall for Not founded Message
        do_action( 'ultratable_product_notfound', $args, $datas, $atts, $POST_ID, $product_loop );
        
        //After Table
        do_action( 'ultratable_after_table', $args, $datas, $atts, $POST_ID, $product_loop );
        
    }
}
add_action( 'ultratable_full_table', 'ultratable_table_full', 10, 5 );

function sssssssaiful(){
    //var_dump( $_POST['data'],$_POST['data']['args'],$_POST['data']['POST_ID'],isset( $_POST['data'],$_POST['data']['args'],$_POST['data']['POST_ID'] ) );
    if( !isset( $_POST['data'],$_POST['data']['args'],$_POST['data']['POST_ID'] ) ){
        die('');
    }
    $data = $_POST['data'];
    $args = $data['args'];
    $atts = $data['atts'];
    $POST_ID = $data['POST_ID'];
    
    if( isset( $data['paged'] ) && !empty( $data['paged'] ) && is_numeric( $data['paged'] ) ){
        $args['paged'] = $data['paged'];
    }
    
    $datas = get_post_meta( $POST_ID,'data',true);
    
    $product_loop = new WP_Query( $args );
    
    ultratable_table_full( $product_loop, $args, $datas, $atts, $POST_ID );
    
    die('');
}
add_action( 'wp_ajax_ultratable_ajax_table_load', 'sssssssaiful' );
add_action( 'wp_ajax_nopriv_ultratable_ajax_table_load', 'sssssssaiful' );