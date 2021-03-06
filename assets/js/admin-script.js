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
        
        $('body.ultratable').on('click','.ultratable-item a,.ultratable-item b',function(e){
            e.preventDefault();
            $(this).parents('.ultratable-item').find('.ultratable-item-body').toggle();
        });
        
        $('body.ultratable').on('click','.control-icons-edit,.column-head',function(e){
            $(this).parents('.ultratable-each-column').find('.column-details').toggle();
        });
        
        $('body.ultratable').on('click','.ultratable-style-wrapper .style-heading',function(e){
            $(this).parents('.ultratable-style-wrapper').find('.ultratable-style-body').toggle();
        });
        
        $('body.ultratable').on('click','.ultratable-style-wrapper .ultratable-reset-style',function(e){
            e.preventDefault();
            $(this).parents('.ultratable-style-wrapper').find('.ultratable-style-body input').val('');
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
        var myOptions = {
            // you can declare a default color here,
            // or in the data-default-color attribute on the input
            defaultColor: false,
            // a callback to fire whenever the color changes to a valid color
            change: function(event, ui){},
            // a callback to fire when the input is emptied or an invalid color
            clear: function() {
                //alert('Empty/invalid color');
            },
            // hide the color picker controls on load
            hide: true,
            // show a group of common colors beneath the square
            // or, supply an array of colors to customize further
            palettes:['#000000','#ffffff','#0a7f9c','#B02B2C','#edae44','#eeee22','#83a846','#7bb0e7','#745f7e','#5f8789','#d65799','#4ecac2'],
        };
        $('.ultratable-color, .ultratable-background-color').wpColorPicker(myOptions);
    });
});
