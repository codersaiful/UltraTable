<?php

if( !function_exists( 'ultratable_settings_page' ) ){
    
    function ultratable_settings_page() {
        ultratable_settings_page_form();
    }
}
if( !function_exists( 'ultratable_settings_page_form' ) ){
    
    function ultratable_settings_page_form() {
        
        
        $datas = filter_input_array(INPUT_POST);
        do_action( 'ultratable_save_data', $datas );
        $option_key = apply_filters( 'ultratable_option_key', 'ultratable_configure_options', $datas );
        $values = apply_filters( 'ultratable_options', get_option( $option_key ), $datas, $option_key );
        
        
        //table_on_archive
        $table_on_archive = isset( $values['archive_table_id'] ) && is_numeric( $values['archive_table_id'] ) ? $values['archive_table_id'] : false;
        $checkbox = isset( $values['table_on_archive'] ) ? 'checked' : '';
        ?>
            
<div class="ultratable-wrapper ultraaddons ultraaddons-wrapper">
    <form action="" method="POST">
        <div class="ultraaddons-panel">
            <table class="ultraaddons-table">
                <tr>
                    <th>
                        <label>Table ID</label>
                    </th>
                    <td>
                        <input type="text" class="ua_input" name="archive_table_id" value="<?php echo esc_attr( $table_on_archive ); ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label>Enable Quantity Button</label></th>
                    <td>
                        <?php
                        
                        ?>
                        <label class="switch">
                            <input  name="table_on_archive" type="checkbox" <?php echo esc_attr( $checkbox ); ?>>
                            <div class="slider round"><!--ADDED HTML -->
                                <span class="on">ON</span><span class="off">OFF</span><!--END-->
                            </div>
                        </label>

                    </td>
                </tr>
            </table>
        </div>
        
        
        <div class="section ultraaddons-button-wrapper ultraaddons-panel no-background">
            <button name="configure_submit" class="button-primary button-primary primary button">Save Change</button>
            <button name="reset_button" class="button button-default" onclick="return confirm('If you continue with this action, you will reset all options in this page.\nAre you sure?');">Reset Default</button>
        </div>
    </form>
</div>  
        <?php
    }
}
