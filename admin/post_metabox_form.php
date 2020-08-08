<?php
/**
 * Getting Global $post from WordPress
 */
global $post;
$post_id    = $post->ID;
$data       = get_post_meta( $post_id, 'data', true);
//echo '<pre>'; print_r($data);echo '</pre>';exit;
include_once __DIR__ . '/default-data.php';
$tabs       = array(
    'column'    => esc_html( 'Column', 'ultratable' ),
    'query'     => esc_html( 'Query', 'ultratable' ),
    'settings'  => esc_html( 'Settings', 'ultratable' ),
    'design'    => esc_html( 'Design', 'ultratable' ),
);

/**
 * filterrize Data and tabs
 */

$data = apply_filters( 'ultratable_post_data', $data, $post, $tabs );
$data = apply_filters( 'ultratable_post_data_' . $post_id, $data, $post, $tabs );

$tabs = apply_filters( 'ultratable_post_tabs_arr', $tabs, $data, $post );
$tabs = apply_filters( 'ultratable_post_tabs_arr_' . $post_id, $tabs, $data, $post );

do_action( 'ultratable_post_form_top',$data, $post, $tabs );


//Now start for Tab Content
$active_tab_content = 'tab-content-active';
foreach ( $tabs as $tab => $title ) {
    echo '<div class="wpt_tab_content tab-content ' . esc_attr( $active_tab_content ) . '" id="' . esc_attr( $tab ) . '">';
    echo '<div class="fieldwrap">';

    /**
     * @Hook Action: ultratable_form_tab_top_{$tab}
     * 
     * To add content at the top of Specific TAB for any field to the specific Tab.
     * such TAB: Column, Basic, Configuration ETC
     * @since 1.0.0.4
     * @date 8 July, 2020
     */
    do_action( 'ultratable_form_tab_top_' . $tab, $post );

    $tab_validation = apply_filters( 'ultratable_form_tab_validation_' . $tab, true, $post, $tabs, $data  );

    $tab_dir_loc = ULTRATABLE_BASE_DIR . '/admin/tabs/';
    $tab_dir_loc = apply_filters( 'ultratable_admin_tab_folder_dir', $tab_dir_loc, $tab, $post, $tabs, $data );

    $tab_file = $tab_dir_loc . $tab . '.php';
    $tab_file_admin = apply_filters( 'ultratable_admin_tab_file_loc', $tab_file, $tab, $post, $tabs, $data );
    $tab_file_of_admin = apply_filters( 'ultratable_admin_tab_file_loc_' . $tab, $tab_file_admin, $post, $tabs, $data );
    if ( $tab_validation && is_file( $tab_file_of_admin ) ) {

        /**
         * Adding content to Any admin Tab of Form
         */
        do_action( 'ultratable_admin_tab_' . $tab, $post, $tabs, $data );
        include $tab_file_of_admin; 
    }elseif( $tab_validation ){
        echo '<h2>' . $tab . '.php ' . esc_html__( 'file is not found in tabs folder','wpt_pro' ) . '</h2>';
    }

    /**
     * @Hook Action: ultratable_form_tab_bottom_{$tab}
     * 
     * To add content at the Bottom of Specific TAB for any field to the specific Tab.
     * such TAB: Column, Basic, Configuration ETC
     * @since 6.1.0.5
     * @date 8 July, 2020
     */
    do_action( 'ultratable_form_tab_bottom_' . $tab, $post );

    echo '</div>'; //End of .fieldwrap
    echo '</div>'; //End of Tab content div
    $active_tab_content = false; //Active tab content only for First
}
var_dump($data);
do_action( 'ultratable_post_form_bottom',$data, $post, $tabs );