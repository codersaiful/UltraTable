<?php
/**
 * All metabox will control from here
 * This page added at 4.1.1 date: 19.1.2019
 * 
 * @since 4.1.1
 * @author Saiful Islam<codersaiful@gmail.com>
 */

if( !function_exists( 'ultratable_shortcode_metabox' ) ){
    /**
     * Our total metabox or register_meta_box_cb will controll from here. 
     * 
     * @since 4.1.1
     */
    function ultratable_shortcode_metabox(){
//        add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args);
        add_meta_box( 'ultratable_shortcode_metabox_id', 'Shortcode', 'ultratable_shortcode_metabox_render', 'ultratable', 'normal' );
        add_meta_box( 'ultratable_shortcode_configuration_metabox_id', 'Table Configuration', 'ultratable_shortcode_configuration_metabox_render', 'ultratable', 'normal' ); //Added at 4.1.4

    }
}

if( !function_exists( 'ultratable_shortcode_metabox_render' ) ){
    function ultratable_shortcode_metabox_render(){
        global $post;
        $curent_post_id = $post->ID;
        $post_title = preg_replace( '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/',"$1", $post->post_title );
        echo '<input type="text" value="[Product_Table id=\'' . $curent_post_id . '\' name=\'' . $post_title . '\']" class="ultratable_auto_select_n_copy ultratable_meta_box_shortcode mb-text-input mb-field" id="ultratable_metabox_copy_content" readonly>'; // class='ultratable_auto_select_n_copy'
        echo '<a style=""  class="button button-primary ultratable_copy_button_metabox" data-target_id="ultratable_metabox_copy_content">Copy</a>';
        echo '<p style="color: #007692;font-weight:bold;display:none; padding-left: 12px;" class="ultratable_metabox_copy_content"></p>';

    }
}

if( !function_exists( 'ultratable_shortcode_configuration_metabox_render' ) ){
    //Now start metabox for shortcode Generator
    function ultratable_shortcode_configuration_metabox_render(){
        global $post;
 echo '<input type="hidden" name="ultratable_shortcode_nonce_value" value="' . wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />'; //We have to remove it later
        //include __DIR__ . '/post_metabox_form.php';
        ?>

<h1>Hello World</h1>
        <br style="clear: both;">
        <?php
    }
}

if( !function_exists( 'ultratable_metabox_save_meta' ) ){
    function ultratable_metabox_save_meta( $post_id, $post ) { // save the data
        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        if ( ! isset( $_POST['ultratable_shortcode_nonce_value'] ) ) { // Check if our nonce is set.
                return;
        }

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if( !wp_verify_nonce( $_POST['ultratable_shortcode_nonce_value'], plugin_basename(__FILE__) ) ) {
                return;
        }
        
        if( !isset( $_POST['data'] ) ){
            return;
        }
        $data = $_POST['data'];
        $data['POST_ID'] = $post_id;
        /**
         * @Hook Filter: ultratable_post_data_on_save
         */
        $_POST_DATA = apply_filters( 'ultratable_post_data_on_save', $data, $post_id, $post );
        
        
        
        //update_post_meta( $post_id, 'data', $_POST_DATA );

        /**
         * @Hook Action: ultratable_on_save_post
         * To change data when Form will save.
         * @since 6.1.0.5
         * @Hook_Version: 6.1.0.5
         */
        add_action( 'ultratable_on_post_save', $post_id, $post );

    }
}
add_action( 'save_post', 'ultratable_metabox_save_meta', 10, 2 ); // 