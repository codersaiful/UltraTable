<?php

if( !function_exists( 'ultratable_args_manager' ) ){
    
    /**
     * Args manage for FrontEnd.
     * Speciall now if for any Archive page
     * 
     * @global type $wpdb
     * @param type $args
     * @param type $datas
     * @param type $atts
     * @param type $POST_ID
     * @return int
     */
    function ultratable_args_manager( $args, $datas, $atts, $POST_ID ){
        global $wpdb;
        //var_dump($args);
        $page_query = isset( $GLOBALS['wp_query'] ) ? $GLOBALS['wp_query']->query_vars : null;
        $args_product_in = false;
        if( isset( $page_query['wc_query'] ) && $page_query['wc_query'] == 'product_query' ){
            $gen_args = array_merge( $args,$GLOBALS['wp_query']->query_vars );
            $gen_args['post_type'] = isset( $args['post_type'] ) && !empty( $args['post_type'] ) ? $args['post_type'] : 'product';
            $args = $gen_args;

            $sql = $GLOBALS['wp_query']->request;
            $results = $wpdb->get_results( $sql, ARRAY_A );
            $args_product_in = array();
            foreach( $results as $result ){
                $args_product_in[] = $result['ID'];
            }
            $args['post__in'] = $args_product_in;
            $args['paged'] = 0;
        }
    
        return $args;
    }
}
add_filter( 'ultratable_table_args', 'ultratable_args_manager', 10, 4 );


if( !function_exists( 'ultratable_pagination' ) ){
    //do_action( 'ultratable_footer', $args, $datas, $atts, $POST_ID );
    /**
     * 
     * @global type $current_screen
     * @param string $class
     * @return string
     */
    function ultratable_pagination( $args, $datas, $atts, $POST_ID, $product_loop ){
        $args['paged'] = isset( $args['paged'] ) ? $args['paged'] : 1;
        $args = apply_filters( 'ultratable_table_args', $args, $datas, $atts, $POST_ID );
        $args = apply_filters( 'ultratable_table_args_paginate', $args, $datas, $atts, $POST_ID );
        
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
add_action( 'ultratable_header', 'ultratable_pagination', 10, 5 );

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

if( !function_exists( 'ultratable_table_head_show_hide' ) ){
    //do_action( 'ultratable_footer', $args, $datas, $atts, $POST_ID );
    /**
     * WPT_TABLE::is_table_head() && WPT_TABLE::get_head()
     * 
     * @global type $current_screen
     * @param string $class
     * @return string
     */
    function ultratable_table_head_show_hide( $bool,$args, $datas, $atts, $POST_ID, $product_loop ){
        $args = apply_filters( 'ultratable_table_args', $args, $datas, $atts, $POST_ID );
        $args = apply_filters( 'ultratable_table_args_header_show_hide', $args, $datas, $atts, $POST_ID );
        $count_on_page = $product_loop->post_count;
        $show_on_notfound = true;
        if( $count_on_page < 1 ){
            $show_on_notfound = false;
        }
        $show_on_notfound = apply_filters( 'ultratable_thead_show_on_notfound', $show_on_notfound, $POST_ID);
        if( WPT_TABLE::is_table_head() && WPT_TABLE::get_head() && $show_on_notfound ){
            return true;
        }
        return;
    }
}
add_filter( 'ultratable_table_head_show', 'ultratable_table_head_show_hide', 10, 6 );

if( !function_exists( 'ultratable_post_count_msg' ) ){

    function ultratable_post_count_msg( $args, $datas, $atts, $POST_ID, $product_loop ){
        $args = apply_filters( 'ultratable_table_args', $args, $datas, $atts, $POST_ID );
        $args = apply_filters( 'ultratable_table_args_count_msg', $args, $datas, $atts, $POST_ID );
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
            <span><?php echo wp_kses_post( $msg ); ?></span>
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
        $args = apply_filters( 'ultratable_table_args', $args, $datas, $atts, $POST_ID );
        $args = apply_filters( 'ultratable_table_args_notfound', $args, $datas, $atts, $POST_ID );
        $validation = apply_filters( 'ultratable_notfound_validation', true, $args, $datas, $atts, $POST_ID );
        if( !$validation ){
            return;
        }
        $count_on_page = $product_loop->post_count;
        if( $count_on_page > 0 ){
            return;
        }
        $msg = __( 'No products were found matching your selection.', 'ultratable' );

        ?>
        <div class="ultratable-notfound">
            <span><?php echo wp_kses_post( $msg ); ?></span>
        </div>
        <?php
    }
}

add_action( 'ultratable_product_notfound', 'ultratable_notfound_msg', 10, 5 );
