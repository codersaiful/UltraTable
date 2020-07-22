<?php

/**
 * Plugin Name: AA UltraTable - WooCommerce Product Table
 * Plugin URI: #
 * Description: A Woocommerce Product Table for UltraTable
 * Author: Saiful Islam
 * Author URI: https://profiles.wordpress.org/codersaiful/#content-plugins
 * Text Domain: ultratable
 * Domain Path: /languages/
 * 
 * Version: 1.0.0
 * Requires at least:    4.0.0
 * Tested up to:         5.4.2
 * WC requires at least: 3.7
 * WC tested up to:      4.2.2
 */
if ( !defined( 'ABSPATH' ) ) {
    die();
}

if ( !defined( 'ULTRATABLE_VERSION' ) ) {
    define( 'ULTRATABLE_VERSION', '1.0.0');
}
if( !defined( 'ULTRATABLE_CAPABILITY' ) ){
    $wpt_capability = apply_filters( 'wpt_menu_capability', 'manage_woocommerce' );
    define( 'ULTRATABLE_CAPABILITY', $wpt_capability );
}

if ( !defined( 'ULTRATABLE_NAME' ) ) {
    define( 'ULTRATABLE_NAME', 'UltraTable - WooCommerce Product Table');
}

if ( !defined( 'ULTRATABLE_BASE_NAME' ) ) {
    define( 'ULTRATABLE_BASE_NAME', plugin_basename( __FILE__ ) );
}

if ( !defined( 'ULTRATABLE_MENU_SLUG' ) ) {
    define( 'ULTRATABLE_MENU_SLUG', 'ultratable' );
}
if( !defined( 'ULTRATABLE_PLUGIN' ) ){
    define( 'ULTRATABLE_PLUGIN', 'ultratable/ultratable.php' );
}


if ( !defined( 'ULTRATABLE_BASE_URL' ) ) {
    define( "ULTRATABLE_BASE_URL", plugins_url() . '/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
}

if ( !defined( 'ULTRATABLE_BASE_DIR' ) ) {
    define( "ULTRATABLE_BASE_DIR", str_replace( '\\', '/', dirname( __FILE__ ) ) );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
ULTRATABLE::getInstance();
class ULTRATABLE{
    public static $own = array(
        'plugin'  => 'ultratable/ultratable.php',
        'plugin_slug'  => 'ultratable',
        'type'  => 'error',
        'message' => 'Install To working',
        'btn_text' => 'Install Now',
        'name' => 'UltraTable',
        'perpose' => 'install', //install,upgrade,activation
    );
    private static $_instance;
    const MINIMUM_PHP_VERSION = '5.6';
    
    
    public static function getInstance() {
        if (!( self::$_instance instanceof self )) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    public function __construct() {
        
        $installed_plugins = get_plugins();
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }
        
        //Qty Plus/Minus Button Plugin Compulsory for Our Product Table Plugin
        $plugin = 'wc-quantity-plus-minus-button/init.php';
        $link_text = '<strong><a href="' . esc_url( 'https://wordpress.org/plugins/wc-quantity-plus-minus-button/' ) . '" target="_blank">' . esc_html__( 'Quantity Plus/Minus Button for WooCommerce', 'wpt_pro' ) . '</a></strong>';
        //Check Installation of Quantity Plus Minus Button Plugin
        if( !isset( $installed_plugins[$plugin] ) ) {
            self::$own['plugin']        = $plugin;
            self::$own['plugin_slug']   = 'wc-quantity-plus-minus-button';
            self::$own['type']          = 'warning';
            self::$own['btn_text']      = 'Install Now';
            $message = sprintf(
                   esc_html__( '"%1$s" requires "%2$s" to be Installed and Activated.', 'wpt_pro' ),
                   '<strong>' . esc_html__( 'Woo Product Table', 'wpt_pro' ) . '</strong>',
                    $link_text                   
        );
        self::$own['message']           = $message;//'You to activate your Plugin';
        add_action( 'admin_notices', [ $this, 'admin_notice' ] );
        }
       
            
        //Check Activation Of that Plugin
        if( isset( $installed_plugins[$plugin] ) && !is_plugin_active( $plugin ) ) {
            self::$own['type']      = 'warning';
            self::$own['perpose']   = 'activation';
            self::$own['plugin']    = 'wc-quantity-plus-minus-button/init.php';
            self::$own['btn_text']  = 'Activate Now';
            $message = sprintf(
                   /* translators: 1: Plugin name 2: WooPrdouct Table */
                   esc_html__( '"%1$s" recomends "%2$s" to be activated.', 'wpt_pro' ),
                   '<strong>' . esc_html__( 'Woo Product Table', 'wpt_pro' ) . '</strong>',
                    $link_text 
                );
            self::$own['message']   = $message;//'You to activate your Plugin';
            add_action( 'admin_notices', [ $this, 'admin_notice' ] );
        }
        
        
        
        
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }
        
        add_action(
	'plugins_loaded',
	function () {
		load_plugin_textdomain( 'ultratable', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	});
        
        if( is_admin() ){
            include_once ULTRATABLE_BASE_DIR . '/admin/functions.php';
            include_once ULTRATABLE_BASE_DIR . '/admin/admin-menu.php';
            include_once ULTRATABLE_BASE_DIR . '/admin/settings.php';
            
            include_once ULTRATABLE_BASE_DIR . '/admin/ultratable-post.php';
            include_once ULTRATABLE_BASE_DIR . '/admin/post_metabox.php';
        }
        include_once ULTRATABLE_BASE_DIR . '/includes/functions.php';
        include_once ULTRATABLE_BASE_DIR . '/includes/functions.php';
        //include_once ULTRATABLE_BASE_DIR . '/includes/aaaa.php';
        
    }
    public function admin_notice() {
        if ( ! current_user_can( 'activate_plugins' ) ) {
                return;
        }

        $plugin         = isset( self::$own['plugin'] ) ? self::$own['plugin'] : '';
        $type           = isset( self::$own['type'] ) ? self::$own['type'] : false;
        $plugin_slug    = isset( self::$own['plugin_slug'] ) ? self::$own['plugin_slug'] : '';
        $message        = isset( self::$own['message'] ) ? self::$own['message'] : '';
        $btn_text       = isset( self::$own['btn_text'] ) ? self::$own['btn_text'] : '';
        $name           = isset( self::$own['name'] ) ? self::$own['name'] : false; //Mainly providing OUr pLugin Name
        $perpose        = isset( self::$own['perpose'] ) ? self::$own['perpose'] : 'install';
        if( $perpose == 'activation' ){
            $url = $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
        }elseif( $perpose == 'upgrade' ){
            $url = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $plugin, 'upgrade-plugin_' . $plugin );
        }elseif( $perpose == 'install' ){
            //IF PERPOSE install or Upgrade Actually || $perpose == install only supported Here
            $url = wp_nonce_url( self_admin_url( 'update.php?action=' . $perpose . '-plugin&plugin=' . $plugin_slug ), $perpose . '-plugin_' . $plugin_slug ); //$install_url = 
        }else{
            $url = false;
        }
        
        
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = '<p>' . $message . '</p>';
        if( $url ){
            $style = isset( $type ) && $type == 'error' ? 'style="background: #ff584c;border-color: #E91E63;"' : 'style="background: #ffb900;border-color: #c37400;"';
            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary" %s>%s</a>', $url,$style, $btn_text ) . '</p>';
        }
        printf( '<div class="notice notice-' . $type . ' is-dismissible"><p>%1$s</p></div>', $message );

    }
    public function admin_notice_missing_main_plugin() {
        
        if (isset($_GET['activate']))
            unset($_GET['activate']);
        
        $message = sprintf(
                esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'wqpmb'),
                '<strong>' . ULTRATABLE_NAME . '</strong>',
                '<strong><a href="' . esc_url('https://wordpress.org/plugins/woocommerce/') . '" target="_blank">' . esc_html__('WooCommerce', 'wqpmb') . '</a></strong>'
        );

        printf('<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message);
    }
    
    public function admin_notice_minimum_php_version() {

           if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

           $message = sprintf(
                   /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
                   esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wqpmb' ),
                   '<strong>' . ULTRATABLE_NAME . '</strong>',
                   '<strong>' . esc_html__( 'PHP', 'wqpmb' ) . '</strong>',
                    self::MINIMUM_PHP_VERSION
           );

           printf( '<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message );

    }
}

/**
* Plugin Install and Uninstall
*/
register_activation_hook(__FILE__, array( 'ULTRATABLE','install' ) );
register_deactivation_hook( __FILE__, array( 'ULTRATABLE','uninstall' ) );