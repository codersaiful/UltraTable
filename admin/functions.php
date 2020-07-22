<?php

if( !function_exists( 'ultratable_admin_body_class' ) ){
    /**
     * set class for Admin Body tag
     * 
     * @param type $classes
     * @return String
     */
    function ultratable_admin_body_class(){
        global $current_screen;
        $s_id = isset( $current_screen->id ) ? $current_screen->id : '';
        if( strpos( $s_id, 'ultratable') !== false ){
            return ' ultratable ';
        }
        return;
    }
}
add_filter( 'admin_body_class', 'ultratable_admin_body_class' );
