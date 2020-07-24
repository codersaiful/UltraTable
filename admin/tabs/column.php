<?php
/**
 * Available:
 * $post_id
 * $data - Saved Data, Which Already saved at POST decleared at admin/post_metabox_form.php
 * $tabs - Supported Tabs decleared at admin/post_metabox_form.php
 */

//Supported Device Also Included in WPT_ARGS_Manager::sanitize()
$suppoeted_device = array('desktop','tablet','mobile');
$suppoeted_device = apply_filters( 'ultratable_supported_device_arr', $suppoeted_device, $data );
$suppoeted_device = is_array( $suppoeted_device ) ? $suppoeted_device : false;
$devices = isset( $data['device'] ) && is_array( $data['device'] ) ? $data['device'] : false;
//var_dump($devices);
if( !$devices || !$suppoeted_device ){
    return;
}

foreach( $suppoeted_device as $device_key ){
    $device_arr = isset( $devices[$device_key] ) && is_array( $devices[$device_key] ) ? $devices[$device_key] : false;
    if( $device_arr ){
        $label = isset( $device_arr['label'] ) && !empty( $device_arr['label'] ) ? $device_arr['label'] : $device_key;
        $status = isset( $device_arr['label'] ) && !empty( $device_arr['label'] ) ? 'on' : 'off';
        $checkbox = $status == 'on' ? 'checked' : '';
    ?>
<div class="ultraaddons-panel ultratable-device ultratable-device-<?php echo esc_attr( $device_key ); ?>" data-device-key="<?php echo esc_attr( $device_key ); ?>">
    <div class="ultratable-device-inside">
        <div class="ultratable-device-head">
            <h1><?php echo esc_html( $label ); ?></h1>
            <input type="hidden" name="data[device][<?php echo esc_attr( $device_key ); ?>]['label']" value="<?php echo esc_attr( $label ); ?>" class="<?php echo esc_attr( $device_key ); ?>-label">
            <input type="hidden" name="data[device][<?php echo esc_attr( $device_key ); ?>]['status']" value="<?php echo esc_attr( $status ); ?>"class="<?php echo esc_attr( $device_key ); ?>-status">
            
            <label class="switch">
                <input class="ultratable-placeholder-onoff" data-target="<?php echo esc_attr( $device_key ); ?>-status" type="checkbox" <?php echo esc_attr( $checkbox ); ?>>
                <div class="slider round"><!--ADDED HTML -->
                    <span class="on">ON</span><span class="off">OFF</span><!--END-->
                </div>
            </label>
        </div>
        <div class="ultratable-device-body">
            <?php var_dump($device_arr); ?>
        </div>
    </div>
</div>    
    <?php
    }
}
?>