<?php

if( !function_exists( 'ultratable_plugin_actions' ) ){
    /**
     * For showing configure or add new link on plugin page
     * It was actually an individual file, now combine at 4.1.1
     * @param type $links
     * @return type
     */
    function ultratable_plugin_actions( $actions ) {
        $links[] = '<a href="' . admin_url( 'post-new.php?post_type=ultratable' ) . '" title="' . esc_attr__( 'Create New', 'ultratable' ) . '">' . esc_html__( 'Add New', 'ultratable' ).'</a>';
        $links[] = '<a href="' . admin_url( 'admin.php?page=ultratable-settings' ) . '" title="' . esc_attr__( 'Settings', 'ultratable' ) . '">' . esc_html__( 'Settings', 'ultratable' ).'</a>';
        //$links[] = '<a href="https://wcquantity.com/wc-quantity-plus-minus-button/" title="' . esc_attr__( 'Plugin Features', 'ultratable' ) . '" target="_blank">' . esc_html__( 'Features', 'ultratable' ) . '</a>';
        //$links[] = '<a href="https://wcquantity.com/product/head-phone/" title="' . esc_attr__( 'Plugin Demo', 'ultratable' ) . '" target="_blank">'.esc_html__( 'Demo','ultratable' ).'</a>';
        $links[] = '<a href="https://codeastrology.com/support/" title="' . esc_attr__( 'Support', 'ultratable' ) . '" target="_blank">'.esc_html__( 'Support','ultratable' ).'</a>';
        return array_merge( $links, $actions );
    }
    add_filter('plugin_action_links_' . ULTRATABLE_BASE_NAME, 'ultratable_plugin_actions' );
}

if( !function_exists( 'ultratable_plugin_meta' ) ){
    /**
     * For showing configure or add new link on plugin page
     * It was actually an individual file, now combine at 4.1.1
     * @param type $links
     * @return type
     */
    function ultratable_plugin_meta( $plugin_meta, $plugin_file ) {
        
        if( $plugin_file == ULTRATABLE_BASE_NAME ){
            //$plugin_meta[] = '<a href="https://wcquantity.com/wc-quantity-plus-minus-button/" title="' . esc_attr__( 'Plugin Features', 'ultratable' ) . '">' . esc_html__( 'Features', 'ultratable' ) . '</a>';
            //$plugin_meta[] = '<a href="https://wcquantity.com/product/head-phone/" title="' . esc_attr__( 'Plugin Demo', 'ultratable' ) . '" target="_blank">'.esc_html__( 'Demo','ultratable' ).'</a>';
            $plugin_meta[] = '<a href="mailto:codersaiful@gmail.com" title="' . esc_attr__( 'Mail to Developer', 'ultratable' ) . '" target="_blank">'.esc_html__( 'Contact to Developer','ultratable' ).'</a>';

        }
        return $plugin_meta;
    }
    add_filter('plugin_row_meta', 'ultratable_plugin_meta',10, 2 );
}

if( !function_exists( 'ultratable_admin_menu' ) ){
    /**
     * Set Menu for WPT
     * 
     * @since 1.0
     * 
     * @package UltraTables
     */
    function ultratable_admin_menu() {
        add_submenu_page( 'edit.php?post_type=ultratable', esc_html__( 'Settings', 'ultratable' ),  esc_html__( 'Settings', 'ultratable' ), ULTRATABLE_CAPABILITY, 'ultratable-settings', 'ultratable_settings_page' );
    }
}
add_action( 'admin_menu', 'ultratable_admin_menu' );