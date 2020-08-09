<?php
/**
 * Available:
 * $post_id
 * $data - Saved Data, Which Already saved at POST decleared at admin/post_metabox_form.php
 * $tabs - Supported Tabs decleared at admin/post_metabox_form.php
 */

//Supported Device Also Included in WPT_ARGS_Manager::sanitize()
$suppoeted_device   = array('desktop','tablet','mobile');
$suppoeted_device   = apply_filters( 'ultratable_supported_device_arr', $suppoeted_device, $data );
$suppoeted_device   = is_array( $suppoeted_device ) ? $suppoeted_device : false;
$devices = isset( $data['device'] ) && is_array( $data['device'] ) ? $data['device'] : false;
//var_dump($devices);
if( !$devices || !$suppoeted_device ){
    return;
}

foreach( $suppoeted_device as $device_key ){
    $device_arr = isset( $devices[$device_key] ) && is_array( $devices[$device_key] ) ? $devices[$device_key] : false;
    if( $device_arr ){
        $device_name_prefix = "data[device][{$device_key}]";
        $label              = isset( $device_arr['label'] ) && !empty( $device_arr['label'] ) ? $device_arr['label'] : $device_key;
        $status             = isset( $device_arr['status'] ) && !empty( $device_arr['status'] ) && $device_arr['status'] == 'on' ? 'on' : 'off';
        $checkbox           = $status == 'on' ? 'checked' : '';
        
        $target = $device_key;
    ?>
<div class="ultraaddons-panel ultratable-device ultratable-device-<?php echo esc_attr( $device_key ); ?>" data-device-key="<?php echo esc_attr( $device_key ); ?>">
    <div class="ultratable-device-inside">
        <div class="ultratable-device-head">
            <h1><?php echo esc_html( $label ); ?></h1>
            <input type="hidden" name="<?php echo esc_attr( $device_name_prefix );?>[label]" value="<?php echo esc_attr( $label ); ?>" class="<?php echo esc_attr( $device_key ); ?>-label">
            <input type="hidden" name="<?php echo esc_attr( $device_name_prefix );?>[status]" value="<?php echo esc_attr( $status ); ?>" class="<?php echo esc_attr( $device_key ); ?>-status">
            
            <label class="switch">
                <input class="ultratable-placeholder-onoff" data-target="<?php echo esc_attr( $device_key ); ?>-status" type="checkbox" <?php echo esc_attr( $checkbox ); ?>>
                <div class="slider round"><!--ADDED HTML -->
                    <span class="on">ON</span><span class="off">OFF</span><!--END-->
                </div>
            </label>
        </div>
        <div class="ultratable-device-body">
            <?php 
            //var_dump($device_arr);
            $columns_arr = isset( $device_arr['columns'] ) ? $device_arr['columns'] : false;
            $columns_arr = is_array( $columns_arr ) && count( $columns_arr ) > 0 ? $columns_arr : false; 
            $html_col_head = $html_col_body = '';
            $serial = $maxNumber = 1;
            if( $columns_arr ){
                foreach( $columns_arr as $colKey => $columnArr ){
                    //var_dump($columnArr);
                    if($colKey >= $maxNumber ){
                        $maxNumber = $colKey;
                    }
                    $name_prefix        = $device_name_prefix . "[columns][{$colKey}]";
                    $head_label         = isset( $columnArr['head']['content'] ) ? $columnArr['head']['content'] : false;
                    $head_class         = isset( $columnArr['head']['class'] ) ? $columnArr['head']['class'] : false;
                    $col_status         = isset( $columnArr['status'] ) && !empty( $columnArr['status'] ) && $columnArr['status'] == 'on' ? 'on' : 'off';
                    
                    $checkbox           = $col_status == 'on' ? 'checked' : '';
                    
                    $col_target = $device_key . "-" . $colKey;
                    //var_dump($columnArr,$name_prefix); <input type="hidden" name="data[device][desktop][columns][1][status]" value="on" class="desktop-1-status">
                    ?>  
            <div class="ultratable-each-column ultratable-each-column-<?php echo esc_attr( $colKey ); ?> ">
                <div class="column-control-icons">
                    <i class="ultratable-each-column-handle ultratable-handle control-icons">Move</i>
                    <i class="control-icons control-icons-delete">X</i>
                    <i class="control-icons control-icons-edit">Edit</i>
                </div>
                <div class="column-head">
                    <h3 class="this-col-head-number">
                        
                        <?php 
                        echo wp_kses_post( $head_label );
                        echo sprintf( esc_html( "%sColumn %s%s%s%s", 'ultratable' ), '<span>','<i class="col-number">',$serial,'</i>','<span>');
                        //echo wp_kses_post( $head_label ); 
                        ?>
                    </h3> 
                    
                    <input type="hidden" name="<?php echo esc_attr( $name_prefix ); ?>[status]" value="<?php echo esc_attr( $col_status ); ?>" class="<?php echo esc_attr( $device_key . '-' . $colKey ); ?>-status">

                    <label class="switch">
                        <input class="ultratable-placeholder-onoff" data-target="<?php echo esc_attr( $device_key . '-' . $colKey ); ?>-status" type="checkbox" <?php echo esc_attr( $checkbox ); ?>>
                        <div class="slider round"><!--ADDED HTML -->
                            <span class="on">ON</span><span class="off">OFF</span><!--END-->
                        </div>
                    </label>
                </div>
                
                    
                <div class="column-details">
                    
                    <p class="each-col-each-filed">
                        <label>Column Head</label>
                        <input name="<?php echo esc_attr( $name_prefix ); ?>[head][content]" value="<?php echo esc_attr( $head_label ); ?>" class="ua_input">
                    </p>


                    <p class="each-col-each-filed">
                        <label>Column Class</label>
                        <input name="<?php echo esc_attr( $name_prefix ); ?>[head][class]" value="<?php echo esc_attr( $head_class ); ?>" class="ua_input">
                    </p>
                    <?php
$head_prefix = $name_prefix . '[head]';
$head_arr = isset( $columnArr['head'] ) ? $columnArr['head'] : array();
$head_arr['location'] = __( 'Column Head', 'ultratable' );
/**
 * For CSS Style Area on Each Each Item Area at the bottom
 */
do_action( 'ultratable_admin_style_area', $head_prefix, $supported_css_property, $colKey, $head_arr, $device_key, $data, $post );
                    ?>
                    
                    <!-- More Hidden For Wrapper -->
                    <?php 
                    $wrapper_id  = 'tr_id';
                    $wrapper_class  = 'tr_id_class';
                    ?>
                    <input name="<?php echo esc_attr( $name_prefix ); ?>[wrapper][id]" value="<?php echo esc_attr( $wrapper_id ); ?>" type="hidden">
                    <input name="<?php echo esc_attr( $name_prefix ); ?>[wrapper][class]" value="<?php echo esc_attr( $wrapper_class ); ?>" type="hidden">
                    
                    <div class="ultratable-items-wrapper ultratable-items-wrapper-<?php echo esc_attr( $device_key ); ?>-<?php echo esc_attr( $colKey ); ?>" 
                         data-device="<?php echo esc_attr( $device_key ); ?>" 
                         data-column="<?php echo esc_attr( $colKey ); ?>">
                        
                    
                    <?php
                    $items = isset( $columnArr['items'] ) ? $columnArr['items'] : false;
                    //var_dump($items);
                    if( is_array( $items ) ){
                        foreach( $items as $itemKey => $item ){
                            $item_name_prefix   = $name_prefix . "[items][{$itemKey}]";
                            $tag                = isset( $item['tag'] ) ? $item['tag'] : 'div';
                            $class              = isset( $item['class'] ) ? $item['class'] : false;
                            $id                 = isset( $item['id'] ) ? $item['id'] : false;
                            $content            = isset( $item['content'] ) ? $item['content'] : false;
                            
                            
                            
                            $item_target = $device_key . "-{$colKey}-" . $itemKey;
                            
                            ?>
                        <div class="ultratable-item">
                            
                            <b><?php echo esc_html( $itemKey ); ?></b> 
                            
                            <div class="item--control-icons">
                                <a href="#"
                                class="" 
                                data-target="<?php echo esc_attr( $item_target ); ?>" 
                                data-device="<?php echo esc_attr( $device_key ); ?>" 
                                data-column="<?php echo esc_attr( $colKey ); ?>"><?php echo esc_html( 'Edit' ); ?></a>
                                <i class="ultratable-item-handle  ultratable-handle item-control-icons">Move</i>
                                <i class="item-control-icons item-control-icons-delete">X</i>
                            </div>
                            <div class="ultratable-item-body">
                                <p class="each-item-field">
                                    <label>Item Tag</label>
                                    <input name="<?php echo esc_attr( $item_name_prefix ); ?>[tag]" value="<?php echo esc_attr( $tag ); ?>"  class="ua_input">
                                </p>

                                <p class="each-item-field">
                                    <label>Item Class</label>
                                    <input name="<?php echo esc_attr( $item_name_prefix ); ?>[class]" value="<?php echo esc_attr( $class ); ?>"  class="ua_input">
                                </p>


                                <input name="<?php echo esc_attr( $item_name_prefix ); ?>[id]" value="<?php echo esc_attr( $id ); ?>" type="hidden">
                                <?php if( $content ){ ?>
                                <p class="each-item-field">
                                    <label>Content</label>
                                    <input name="<?php echo esc_attr( $item_name_prefix ); ?>[content]" value="<?php echo esc_attr( $content ); ?>"  class="ua_input">
                                </p>
                                <?php } ?>
                                <div class="ultratable-each-item-extra">      
<?php 
/**
 * To add Anything at the bottom of the Items in Admin Panel
 */
do_action( 'ultratable_admin_items_bottom_' . $itemKey, $item_name_prefix, $item, $colKey, $columnArr, $device_key, $supported_items,$supported_css_property, $data, $post_id, $post, $tabs );
/**
 * To add Anything at the bottom of the Items in Admin Panel
 */
do_action( 'ultratable_admin_items_bottom', $item_name_prefix, $itemKey, $item, $colKey, $columnArr, $device_key, $supported_items,$supported_css_property, $data, $post_id, $post, $tabs );


/**
 * For CSS Style Area on Each Each Item Area at the bottom
 */
do_action( 'ultratable_admin_style_area_' . $itemKey, $item_name_prefix, $supported_css_property, $item, $device_key, $data, $post );

/**
 * For CSS Style Area on Each Each Item Area at the bottom
 */
do_action( 'ultratable_admin_style_area', $item_name_prefix, $supported_css_property, $itemKey, $item, $device_key, $data, $post );

?>
                                </div> <!-- /.ultratable-each-item-extra -->
                            </div> <!-- /.each-item-field -->
                        </div> <!-- /.ultratable-item -->
                        
                        
                        
                            <?php
                        }
                    }
                    
 
                    ?>
                        
                    </div>
                    <div class="ultratable-add-items">
                        <?php

                        //<input type="hidden" name="data[device][desktop][columns][1][status]" value="on" class="desktop-1-status">
                        ?>
                        
                        
                        <label for="supported_items">Add New Item:</label>
                        <select class="items-keyword" id="supported_items">
                            <option value="">Select an Item</option>
                            <?php 

                            foreach ($supported_items as $key => $value){
                                ?>
                            <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
                            <?php } ?>
                            
                        </select>
                        <a href="#" data-name="<?php echo esc_attr( $name_prefix ); ?>" class="button button-primary ultratable-add-new-items">Add Items</a>
                    </div>
                    <div class="each-column-extra">
                        
                        <?php
/**
 * For CSS Style Area for Each Column
 */
do_action( 'ultratable_admin_style_area_' . $colKey, $name_prefix, $supported_css_property, $columnArr, $device_key, $data, $post );

/**
 * For CSS Style Area for Each Column
 */
do_action( 'ultratable_admin_style_area', $name_prefix, $supported_css_property, $colKey, $columnArr, $device_key, $data, $post );
                   
                        ?>
                    </div>
                </div>
                
                
            </div>
                    <?php
                    $serial++;
                }
            }
            
            
            //var_dump($device_arr); ?>
        </div>
        <div data-target="" class="add-new-column">
            <?php
            $maxNumber++;
            $name_prefix        = $device_name_prefix . "[columns][{$maxNumber}][status]";
            ?>
            <a href="#" data-name="<?php echo esc_attr( $name_prefix ); ?>" class="button button-primary ultratable-add-new-column">Add new column</a>
        </div>
        
                            <div class="each-device-extra">
                        
                        <?php
/**
 * For CSS Style Area for Each Column
 */
do_action( 'ultratable_admin_style_area_' . $device_key, $device_name_prefix, $supported_css_property, $device_arr, $device_key, $data, $post );

/**
 * For CSS Style Area for Each Column
 */
do_action( 'ultratable_admin_style_area', $device_name_prefix, $supported_css_property, $device_key, $device_arr, $device_key, $data, $post );
                   
                        ?>
                    </div>
        
    </div>
</div>    
    <?php
    }
}
?>