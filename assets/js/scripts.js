jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        
        $('.item').each(function(){
            var style = $(this).attr('style');
            $(this).children('a').attr('style',style);
        });
        
        
        $('body').on('click','.saiful_click',function(){
            var POST_ID = 481,
            atts = $('.ultratable_table_' + POST_ID ).attr('data-atts'),
            args = $('.ultratable_table_' + POST_ID ).attr('data-args'),
            backup_args = $('.ultratable_table_' + POST_ID ).attr('data-args-backup'),
            //data = $('.ultratable_table_' + POST_ID ).attr('data-data'),
            page_number = 2;
            var ajax_url = 'http://wpp.cm/wp-admin/admin-ajax.php';
            try {
                args = JSON.parse(args);
                backup_args = JSON.parse(backup_args);
                atts = JSON.parse(atts);
            }catch(e){
                args = backup_args = args = '';
                console.log('Something went wrong. Fail to JSON.parse any one.');
            }
            try {
                //data = JSON.parse(data);
            }catch(e){
                //data = '';
            }

            
            $.ajax({
                    type: 'POST',
                    url: ajax_url,// + get_data,
                    data: {
                        action: 'ultratable_ajax_table_load',
                        data: {
                            paged: page_number,
                            POST_ID: POST_ID,
                            atts: atts,
                            args: args,
                            //data: data,
                        }
                    },
                    complete: function(){

                    },
                    success: function(data) {
                        $('.ultratable_table_div_' + POST_ID).html(data);
                    },
                    error: function() {

                    },
                });
        });
    });
});