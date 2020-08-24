<?php
$get_data = $product->get_data();

if( isset( $get_data['date_created'] ) ){
    $last_mod = $get_data['date_modified'];
    $timestamp = $last_mod->getTimestamp();
    $current_timestamp = time();
    
    $diff = apply_filters( 'ultratable_diff_day', 5, $get_data, $args, $POST_ID, $product );
    if( !is_numeric( $diff ) ){
        return;
    }
    $diff_day = 60 * 60 * 24 * $diff;
    $total = $timestamp + $diff_day;
    
    if( $current_timestamp < $total ){
        echo apply_filters( 'ultratable_label_text', "New", $get_data, $args, $POST_ID, $product );
    }
}

//var_dump($product->get_data()['date_created']);
//var_dump($product->get_data()['date_modified']);