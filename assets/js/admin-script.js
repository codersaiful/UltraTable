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
            $(this).parents('.ultratable-each-column').find('.column-details').toggle();
        });
        
        
        
        $('body.ultratable').on('click','.control-icons-delete',function(e){
            var conf = confirm('Column will be remove. Unable to redo.\nAre you sure?');
            if(conf){
                $(this).closest('.ultratable-each-column').remove();
            }
            
        });
        
        $('body.ultratable').on('click','.item-control-icons-delete',function(e){
            var conf = confirm('Item will be remove. Unable to redo.\nAre you sure?');
            if(conf){
                $(this).closest('.ultratable-item').remove();
            }
        });
        
        
        $( ".ultratable-device-body,.ultratable-items-wrapper" ).sortable({
            handle:this,//'.ultratable-handle'//this //.ultratable-handle this is handle class selector , if need '.ultratable-handle',
        });
        
        
        
        
        //Adding new Element //ultratable-add-new-column
        $('body.ultratable').on('click','.ultratable-add-new-column',function(e){
            e.preventDefault();
            var name = $(this).data('name');
            $(this).closest('.ultratable-device-inside').find('.ultratable-device-body').append('<input type="hidden" name="' + name + '" value="on">');
            
            $('body.ultratable input#publish[name=save],body.ultratable input#publish[name=publish]').trigger('click'); //publish
        });
        
        //Adding new Item //ultratable-add-new-column
        $('body.ultratable').on('click','.ultratable-add-new-items',function(e){
            e.preventDefault();
            var name = $(this).data('name'); //items-keyword
            var value = $(this).closest('.ultratable-add-items').find('.items-keyword').val();
            $(this).closest('.column-details').find('.ultratable-items-wrapper').append('<input type="hidden" name="' + name + '[items][' + value + '][id]" value="' + value + '">');
            
            $('body.ultratable input#publish[name=save],body.ultratable input#publish[name=publish]').trigger('click'); //publish
        });
        
    });
});
