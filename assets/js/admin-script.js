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
        
        $('body.ultratable').on('click','.ultratable-item a',function(e){
            e.preventDefault();
            $(this).parents('.ultratable-item').find('.ultratable-item-body').toggle();
        });
        
        $('body.ultratable').on('click','.control-icons-edit,.column-head',function(e){
            $(this).parents('.ultratable-each-column').find('.column-details').fadeToggle();
        });
        
        
        
        $('body.ultratable').on('click','.control-icons-delete',function(e){
            $(this).closest('.ultratable-each-column').remove();
        });
        
        $('body.ultratable').on('click','.item-control-icons-delete',function(e){
            $(this).closest('.ultratable-item').remove();
        });
        
        
        $( ".ultratable-device-body,.ultratable-items-wrapper" ).sortable({
            handle:this,//'.ultratable-handle'//this //.ultratable-handle this is handle class selector , if need '.ultratable-handle',
        });
        
        
        
        
        //Adding new Element
    });
});
