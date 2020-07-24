<?php
$supported_terms    = array(
    'product_cat'       =>  esc_html( 'Product Categories', 'ultratable' ),
    'product_tag'       =>  esc_html( 'Product Tags', 'ultratable' ),
);
$supported_terms    = apply_filters( 'ultratable_supported_terms', $supported_terms, $data, $post, $tabs  );
?>
<input type="hidden" name="data[args][post_type]" value="product">
<input type="hidden" name="data[args][post_status]" value="publish">
<div class="ultraaddons-panel">
    <table class="ultraaddons-table">
        <tr>
            <th>Products Per Page</th>
            <td>
                <input type="number" name="data[args][posts_per_page]" value="20" class="ua_input">
                <p>Posts amount in perpage for your table</p>
            </td>
        </tr>
        <?php
        $args = array(
            'hide_empty'    => false, 
            'orderby'       => 'count',
            'order'         => 'DESC',
        );
        foreach( $supported_terms as $key => $each ){
            $term_key = $key;
            $term_name = $each;
            $term_obj = get_terms( $term_key, $args );
            
            $selected_term_ids = isset( $data['terms'][$term_key] ) && !empty( $data['terms'][$term_key] ) ? $data['terms'][$term_key] : false;
            //include 'includes/terms_condition.php';
            var_dump($selected_term_ids);
            ?>
            <tr>
                <th><label for="ultratable_term_<?php echo esc_attr( $term_key ); ?>">Choose a <?php echo esc_html( $term_name ); ?></label></th>
                <td class="">

                    <?php
                    $options_item = esc_html( 'None ', 'ultratable' ) . $term_name;
                    $options_item = "<option value=''>{$options_item}</option>";
                    if( is_array( $term_obj ) && count( $term_obj ) > 0 ){
                        $selected_term_ids = isset( $data['terms'][$term_key] ) ? $data['terms'][$term_key] : false;
                        foreach ( $term_obj as $terms ) {
                            $selected = is_array( $selected_term_ids ) && in_array( $terms->term_id,$selected_term_ids ) ? 'selected' : false;
                            $options_item .= "<option value='{$terms->term_id}' {$selected}>{$terms->name} ({$terms->count})</option>";
                        }
                    }

                    if( !empty( $options_item ) ){
                    ?>
                    <select name="data[terms][<?php echo esc_attr( $term_key ); ?>][]" class="ultratable_query_terms ua_query_terms_<?php echo esc_attr( $term_key ); ?> ua_select" id="ultratable_term_<?php echo esc_attr( $term_key ); ?>" multiple="multiple">
                        <?php echo $options_item; ?>
                    </select>
                    
                    <?php    
                    }else{
                        echo "No item for {$term_name}";
                    }
                    ?>

                </td>
            </tr>    
            <?php
        }
        
        
        //$args['tax_query']['relation'] = 'AND';
        ?>
            <tr>
                <th>
                    <label>Logical Operator</label>
                </th>
                <td>
                    <?php
                    $ut_logi_operators = array(
                        'AND'   => esc_html( 'AND', 'ultratable' ),
                        'OR'    => esc_html( 'OR', 'ultratable' ),
                    );
                    $ut_logi_operators = apply_filters( 'ultratable_locial_operators', $ut_logi_operators, $data, $post, $tabs );
                    $ut_logi_operators = is_array( $ut_logi_operators ) ? $ut_logi_operators : array();
                    $ua_options = '';
                    foreach( $ut_logi_operators as $opKey => $optr ){
                        $selected = isset( $data['args']['tax_query']['relation'] ) && $data['args']['tax_query']['relation'] == $opKey ? 'selected' : '';
                        $ua_options .= "<option value='{$opKey}' {$selected}>{$optr}</option>";
                    }
                    ?>
                    <select name="data[args][tax_query][relation]">
                        <?php echo wp_kses( $ua_options, array('option' => array( 'value' => array(),'selected' => array() ) ) ); ?>
                    </select>
                </td>
            </tr>
    </table>
</div>
<?php
/**
 * This part will go to Setting Page
 */
$term_lists = get_object_taxonomies('product','objects');
$supported_terms = isset( $saved_data['supported_terms'] ) ?$saved_data['supported_terms'] : array( 'product_cat' );
$ourTermList = $select_option = false;
if( is_array( $term_lists ) && count( $term_lists ) > 0 ){
    foreach( $term_lists as $trm_key => $trm_object ){
        $selected =  ( !$supported_terms && $trm_key == 'product_cat' ) || ( is_array( $supported_terms ) && in_array( $trm_key, $supported_terms ) ) ? 'selected' : false;
        //( !$supported_terms && $trm_key == 'product_cat' ) ||
        //var_dump($trm_key,$selected);
        if( $trm_object->labels->singular_name == 'Tag' && $trm_key !== 'product_tag' ){
            $value = $trm_key;
            $select_option .= "<option value='" . esc_attr( $trm_key ) . "' " . esc_attr( $selected ) . ">" . $trm_key . "</option>";
        }else{
            $value = $trm_object->labels->singular_name;
            $select_option .= "<option value='" . esc_attr( $trm_key ) . "' " . esc_attr( $selected ) . ">" . $trm_object->labels->singular_name . "</option>";
        }
        if( $selected ){
           $ourTermList[$trm_key] = $value; 
        }
    }
}
//var_dump($term_lists, $ourTermList);
?>