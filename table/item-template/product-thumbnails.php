<?php
/**
 * For woocommerce_thumbnail
 * User able to use Array of size, such: array(200,200),
 */
$thumbs_args = apply_filters( 'ultratable_thumbs_arr', 'woocommerce_thumbnail', $POST_ID );
echo woocommerce_get_product_thumbnail( $thumbs_args );