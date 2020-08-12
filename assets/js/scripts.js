jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        
        $('body').on('click','.saiful_click',function(){
            //alert(333);
            var ajax_url = 'http://wpp.cm/wp-admin/admin-ajax.php';
            $.ajax({
                    type: 'POST',
                    url: ajax_url,// + get_data,
                    data: {
                        action: 'ultratable_ajax_table_load',
                        data: {
                            page: 2,
                        }
                    },
                    complete: function(){

                    },
                    success: function(data) {
                        $('.saiful_click_wrapper').html(data);
                    },
                    error: function() {

                    },
                });
        });
    });
});