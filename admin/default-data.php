<?php

if( isset( $data ) && empty( $data ) ){
    
    $data = array(
        'device' => array(
            'desktop' => array(
                'label' => 'Desktop Columns',
                'status' => 'on',
                'columns' => array(
                    array( //This is A Collumn | In Mobile, Now set Only One Column Actually
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Products Details',
                            'class' =>  'single_products',
                            'style' => array(
                                'color' => 'white',
                                'font-size'=> '18px',
                                'background' => 'red'
                            ),
                            'attribute' => array(
                                'something' => 'nothing', //These will go to as Att of this Head or TH tag
                                'another'   => 'other',
                            ),
                        ),
                        'wrapper' => array( //Wrapper of All Items, it will be TD actually
                            'id' => 'td_id',
                            'class' => 'tr_class',
                            'attribute'=> array(
                                'td_some' => 'tr nothing',
                                'td_attr' => 'tr attr value',
                            ),
                        ),
                        'items' => array(

                            'add-to-cart' => array(
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),
                            'action' => array(
                                'class' => 'item_pricess_class',
                                'id'    => 'item sprice id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),
                                
                            
                            
                            
                            
                        ),
                    ),
                    array( //This is A Collumn | In Mobile, Now set Only One Column Actually
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Products Details',
                            'class' =>  'single_products',
                            'style' => array(
                                'color' => 'white',
                                'font-size'=> '18px',
                                'background' => 'red'
                            ),
                            'attribute' => array(
                                'something' => 'nothing', //These will go to as Att of this Head or TH tag
                                'another'   => 'other',
                            ),
                        ),
                        'wrapper' => array( //Wrapper of All Items, it will be TD actually
                            'id' => 'td_id',
                            'class' => 'tr_class',
                            'attribute'=> array(
                                'td_some' => 'tr nothing',
                                'td_attr' => 'tr attr value',
                            ),
                        ),
                        'items' => array(

                            'quantity' => array(
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),
                            
                            'shortcode' => array(
                                'tag'   => false,
                                'content' => "[thingToShow id='%ID%' sku='%sku%' title='%title%' id='%ID%' id='%ID%']"
                            ),
                            //'var_dump' => false,
                        
                            
                            'action' => array( //Action Item, Where available Add to cart Button Actually
                                'tag'   => 'div',
                                'class' => 'wpt_action',
                                'id'    => 'action_unique_id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => array(
                                    'type' => 'advance', //Can be two types: simple and advance. in single: custom code addToCart | default_wooCommerce add to cart
                                ),
                            ),
                            
                            
                        ),
                    ),
                    array( //This is A Collumn | In Mobile, Now set Only One Column Actually
                        'status' => 'off', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Products Details',
                            'class' =>  'single_products',
                            'style' => array(
                                'color' => 'white',
                                'font-size'=> '18px',
                                'background' => 'red'
                            ),
                            'attribute' => array(
                                'something' => 'nothing', //These will go to as Att of this Head or TH tag
                                'another'   => 'other',
                            ),
                        ),
                        'wrapper' => array( //Wrapper of All Items, it will be TD actually
                            'id' => 'td_id',
                            'class' => 'tr_class',
                            'attribute'=> array(
                                'td_some' => 'tr nothing',
                                'td_attr' => 'tr attr value',
                            ),
                        ),
                        'items' => array(
                        
                            'description' => array(
                                'tag'   => 'section',
                                'class' => 'my description',
                            ),
                            'action' => array( //Action Item, Where available Add to cart Button Actually
                                'tag'   => 'div',
                                'class' => 'wpt_action',
                                'id'    => 'action_unique_id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => array(
                                    'type' => 'advance', //Can be two types: simple and advance. in single: custom code addToCart | default_wooCommerce add to cart
                                ),
                            ),
                            
                            
                        ),
                    ),
                    
                ),
            ),
            
        ),
        'head' => 'on' //To Show or Hide Table Head
        
    );
    
}