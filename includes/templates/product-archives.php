<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $wp_queries;
//var_dump($GLOBALS['wp_query']->posts);
//set_query_var($var, $value);
get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//WC_Structured_Data::generate_website_data();
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {
        
	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );
        $option_key = apply_filters( 'ultratable_option_key', 'ultratable_configure_options', array() );
        $config = get_option( $option_key ); 
        $table_id = isset( $config['archive_table_id'] ) ? $config['archive_table_id'] : false;
        $table_id = apply_filters( 'wpto_default_archive_table_id', $table_id );
        $table_id = is_numeric( $table_id ) ? (int) $table_id : false;
        if( $table_id ){
            echo do_shortcode( "[UltraTable id='{$table_id}']" );
        }else{
            $wptMessage = __( 'Product Table ID is not set, or Not founded. Showing default Loop', 'wpt_pro' );
            echo wp_kses_post( '<h3 class="wpt_table_id_not_found">' . $wptMessage . '</h3>' );
            
            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                            the_post();

                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content', 'product' );
                    }
            }

            woocommerce_product_loop_end();
        }

        
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
