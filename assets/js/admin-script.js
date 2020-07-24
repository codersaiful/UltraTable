jQuery(document).ready(function($){
    'use strict';
    $(document).ready(function () {
        $('body.ultratable').on('change','.ultratable-placeholder-onoff',function(){
            var target = $(this).attr('data-target');
            if($(this).is(":checked")){
                $('.' + target).val('on');
            }else if($(this).is(":not(:checked)")){
                $('.' + target).val('off');
            }
        });
    });
});
