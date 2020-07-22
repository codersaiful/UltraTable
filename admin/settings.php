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
        ?>
            
<h1>Settings</h1>    
        <?php
    }
}
