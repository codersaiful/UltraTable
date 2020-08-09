<?php

if( ( isset( $data ) && empty( $data ) ) || isset( $_GET['reset'] ) ){
    
    $data = array(
        //'POST_ID'  => 123, //Set Table POST ID is here
        //'name' => 'Home Product Tables',
        //'title' => 'Choose your Fafourite Table',
        //'id' => 'wpt_product_table',
        //'class' => array('wpt_product_table','table_tag'), //Class data for table table
        'device' => array(
            'desktop' => array(
                'label' => __( 'Desktop Columns', 'ultratable' ),
                'status' => 'on',
                'columns' => array(
                    array( //This is A Collumn | In Mobile, Now set Only One Column Actually
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Products',
                            'class' =>  'single_products',
                            'style' => array(
                                'color' => 'black',
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

                            'product-title' => array(),
                            'short-description' => array(
                                'class' => 'my_short-description',
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
                            'content' => 'Purchase',
                            'class' =>  'purchase_column',
                            'style' => array(
                                'color' => 'black',
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
                        /*    
                            'shortcode' => array(
                                'tag'   => false,
                                'content' => "[thingToShow id='%ID%' sku='%sku%' title='%title%' id='%ID%' id='%ID%']"
                            ),
                            //'var_dump' => false,
                        */
                            
                            'action' => array( //Action Item, Where available Add to cart Button Actually
                                'tag'   => 'div',
                                'class' => 'ultratable-action-items',
                                //'id'    => 'action_unique_id',
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
                            'content' => 'Extras',
                            'class' =>  'extra-columns',
                            'style' => array(),
                            'attribute' => array(
                                'something' => 'nothing', //These will go to as Att of this Head or TH tag
                                'another'   => 'other',
                            ),
                        ),
                        'wrapper' => array( //Wrapper of All Items, it will be TD actually
                            'id' => 'extra-col',
                            'class' => 'tr_class',
                            'attribute'=> array(
                                'td_some' => 'tr nothing',
                                'td_attr' => 'tr attr value',
                            ),
                        ),
                        'items' => array(
                            
                        ),
                    ),
                    
                ),
                
            ),
            'tablet' => array(
                'label' => __( 'Tablet Columns', 'ultratable' ),
                'status' => 'on',
                'columns' => array(
                ),
            ),
            
            
            
            'mobile' => array(
                'label' => __( 'Mobile Columns', 'ultratable' ),
                'status' => 'on',
                'columns' => array(
                ),
            ),
            
            
        ),
        'head' => 'on' //To Show or Hide Table Head
        
    );
    
}