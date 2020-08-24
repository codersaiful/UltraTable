<?php
wc_get_template( 'single-product/price.php' );
$extra_txt = apply_filters( 'ultratable_price_item_extra_text', '', $POST_ID, $args, $datas, $product );
echo wp_kses_post( $extra_txt );