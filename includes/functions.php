<?php

if( !function_exists( 'ultratable_pagination' ) ){
    //do_action( 'ultratable_footer', $args, $datas, $atts, $POST_ID );
    /**
     * 
     * @global type $current_screen
     * @param string $class
     * @return string
     */
    function ultratable_pagination( $args, $datas, $atts, $POST_ID ){
        var_dump($args, $datas, $atts, $POST_ID);
    }
}
add_action( 'ultratable_footer', 'ultratable_pagination', 10, 4 );