<?php

/**
 * JS and Style file add for FrontEnd Section. 
 * 
 * @since 1.0.0
 */
function ultratable_enqueue_scripts(){
    wp_enqueue_style( 'ultratable-style', ULTRATABLE_BASE_URL . 'assets/css/style.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'ultratable-script', ULTRATABLE_BASE_URL . 'assets/js/scripts.js', array( 'jquery' ), '1.0.0', true );
    
    $ajax_url = admin_url( 'admin-ajax.php' );
    $ULTRATABLE_DATA = array( 
        'ajaxurl'   => $ajax_url,
        'ajax_url'  => $ajax_url,
        'site_url'  => site_url(),
        'checkout_url' => wc_get_checkout_url(),
        'cart_url' => wc_get_cart_url(),
        );
    $ULTRATABLE_DATA = apply_filters( 'wpto_localize_data', $ULTRATABLE_DATA );
    wp_localize_script( 'ultratable-script', 'ULTRATABLE_DATA', $ULTRATABLE_DATA );
}
add_action( 'wp_enqueue_scripts', 'ultratable_enqueue_scripts' );


function ultratable_admin_enqueue_scripts( $hook_suffix ) {
    wp_enqueue_style( 'ultraaddons-css', ULTRATABLE_BASE_URL . 'assets/css/admin-common.css', array(), '1.0.0', 'all' );
    wp_enqueue_style('ultraaddons-css');
    
    wp_enqueue_style( 'ultratable-admin', ULTRATABLE_BASE_URL . 'assets/css/admin-style.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'ultratable-admin', ULTRATABLE_BASE_URL . 'assets/js/admin-script.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'ultratable_admin_enqueue_scripts' );