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
            $big = 99999999;
            $paginate = paginate_links( array(
                //'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                //'format' => apply_filters( 'wpto_pagination_format', '?paged=%#%', $args ),
                'mid_size'  => apply_filters( 'ultratable_pgn_mid_size', 3, $args, $datas, $atts, $POST_ID, $product_loop ),
                'prev_next' =>  false,
                'current' => max( 1, $args['paged'] ),
                'total' => $product_loop->max_num_pages,
                'type'  => apply_filters( 'ultratable_pgn_type', 'list', $args, $datas, $atts, $POST_ID, $product_loop ),
                //'before_page_number' => apply_filters( 'ultratable_pgn_type', '', $args, $datas, $atts, $POST_ID, $product_loop ),
		//'after_page_number'  => apply_filters( 'ultratable_pgn_type', '', $args, $datas, $atts, $POST_ID, $product_loop ),
            ));
            echo $paginate;
            
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
add_action( 'ultratable_header', 'ultratable_pagination', 10, 5 );