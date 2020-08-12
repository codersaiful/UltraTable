<?php

if( !function_exists( 'ultratable_pagination' ) ){
    //do_action( 'ultratable_footer', $args, $datas, $atts, $POST_ID );
    /**
     * 
     * @global type $current_screen
     * @param string $class
     * @return string
     */
    function ultratable_pagination( $args, $datas, $atts, $POST_ID, $product_loop ){
        echo wp_kses_post( '<div class="ultratable-pagination-wrapper" >' );
            $big = 99999999;
            $paginate = paginate_links( array(
                //'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                //'format' => apply_filters( 'wpto_pagination_format', '?paged=%#%', $args ),
                'mid_size'  => apply_filters( 'ultratable_pgn_mid_size', 3, $args, $datas, $atts, $POST_ID, $product_loop ),
                'prev_next' => apply_filters( 'ultratable_next_prev_show', true, $args, $datas, $atts, $POST_ID, $product_loop ),
                'current' => max( 1, $args['paged'] ),
                'total' => $product_loop->max_num_pages,
                'type'  => apply_filters( 'ultratable_pgn_type', 'list', $args, $datas, $atts, $POST_ID, $product_loop ),
                //'before_page_number' => apply_filters( 'ultratable_pgn_type', '', $args, $datas, $atts, $POST_ID, $product_loop ),
		//'after_page_number'  => apply_filters( 'ultratable_pgn_type', '', $args, $datas, $atts, $POST_ID, $product_loop ),
            ));
            echo $paginate;
        echo wp_kses_post( '</div>' );    
        /**
        $total   = isset( $args['total'] ) ? intval( $args['total'] ) : 2;//isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        var_dump(get_query_var( 'paged' ));
        //$product_loop = new WP_Query($args);
            $big = 99999999;
            $paginate = paginate_links( array(
                //'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                //'format' => '?paged=%#%',//apply_filters( 'wpto_pagination_format', '?paged=%#%', $args ),
                'mid_size'  =>  3,
                'prev_next' =>  false,
                'prev_next' =>  false,
                'total'              => $total,
		'current'            => $current,
                'type'  => 'list',
                'before_page_number' => '',
		'after_page_number'  => '',
            ));
         */
    }
}
add_action( 'ultratable_footer', 'ultratable_pagination', 10, 5 );
//add_action( 'ultratable_header', 'ultratable_pagination', 10, 5 );

if( !function_exists( 'ultratable_pagination_sss' ) ){
    //do_action( 'ultratable_footer', $args, $datas, $atts, $POST_ID );
    /**
     * 
     * @global type $current_screen
     * @param string $class
     * @return string
     */
    function ultratable_pagination_sss( $args, $datas, $atts, $POST_ID, $product_loop ){
  

    }
}
add_action( 'ultratable_header', 'ultratable_pagination_sss', 10, 5 );

if( !function_exists( 'ultratable_post_count_msg' ) ){

    function ultratable_post_count_msg( $args, $datas, $atts, $POST_ID, $product_loop ){
        $validation = apply_filters( 'ultratable_post_count_validation', true, $args, $datas, $atts, $POST_ID );
        if( !$validation ){
            return;
        }
        $total = $product_loop->found_posts;
        $count_on_page = $product_loop->post_count;
        if( $count_on_page < 1 ){
            return;
        }
        $msg = sprintf( __( 'There are %s products in %s', 'ultratable' ), $count_on_page, $total );
        ?>
        <div class="ultratable-count-msg">
            <p><?php echo wp_kses_post( $msg ); ?></p>
        </div>
        <?php
    }
}
//add_action( 'ultratable_header', 'ultratable_post_count_msg', 999, 5 );
//add_action( 'ultratable_footer', 'ultratable_post_count_msg', 0, 5 );
add_action( 'ultratable_before_table', 'ultratable_post_count_msg', 999, 5 );
add_action( 'ultratable_after_table', 'ultratable_post_count_msg', 0, 5 );

if( !function_exists( 'ultratable_notfound_msg' ) ){

    function ultratable_notfound_msg( $args, $datas, $atts, $POST_ID, $product_loop ){
        $validation = apply_filters( 'ultratable_notfound_validation', true, $args, $datas, $atts, $POST_ID );
        if( !$validation ){
            return;
        }
        $count_on_page = $product_loop->post_count;
        if( $count_on_page > 0 ){
            return;
        }
        $msg = __( 'There is not founded products.', 'ultratable' );

        ?>
        <div class="ultratable-notfound">
            <p><?php echo wp_kses_post( $msg ); ?></p>
        </div>
        <?php
    }
}

add_action( 'ultratable_product_notfound', 'ultratable_notfound_msg', 10, 5 );
