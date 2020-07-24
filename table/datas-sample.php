<?php
        $datas = array(
        'POST_ID'  => 123, //Set Table POST ID is here
        'name' => 'Home Product Tables',
        'title' => 'Choose your Fafourite Table',
        'id' => 'wpt_product_table',
        'class' => array('wpt_product_table','table_tag'), //Class data for table table
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
                'fullwidth' => array( //This is a Full Width Column Where there is no Head
                    'status' => 'on', //Probale Value on and off
                    'wrapper' => array( //Wrapper of All Items, it will be TD actually
                        'id' => 'full_width',
                        'class' => 'full width Items',
                        'attribute'=> array(
                            'td_some' => 'tr nothing',
                            'td_attr' => 'tr attr value',
                        ),
                    ),
                    'items' => array(
                        
                        'single_product' => array(
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),

                    ),
                ),
            ),
            'tablet' => array(
                'label' => 'Tablet Columns',
                'status' => 'on',
                'columns' => array(
                    array(
                        'status'    => 'on',
                        'head'      => array(
                            'tag'       => false,
                            'content'   => 'Saiful Islam', //Checking for Empty Content
                            'class'     => 'product_thumbs',
                            'style'     => array(
                                //'display'       => 'none',
                            ),
                        ),
                        'wrapper'   => array(
                            'id'        => 'prouct_thubns',
                            'class'     => 'thumbs_id',
                        ),
                        'items'     => array(
                            'product-image'        => array(
                                'tag'   => 'section',
                                'class' => 'prodd_thumbsss',
                                'setting'=> false,
                            ),
                        ),
                    ),
                    array(
                        'status'    => 'off',
                        'head'      => array(
                            'tag'       => false,
                            'content'   => '<img src="http://wpp.cm/wp-content/uploads/2020/01/hoodie-blue-1-100x100.jpg" draggable="false">', //Checking for Empty Content
                            'class'     => 'product_thumbs',
                            'style'     => array(
                                //'display'       => 'none',
                            ),
                        ),
                        'wrapper'   => array(
                            'id'        => 'prouct_thubns',
                            'class'     => 'thumbs_id',
                        ),
                        'items'     => array(
                            'quantity'        => array(
                                'tag'   => 'section',
                                'class' => 'prodd_thumbsss',
                                'setting'=> false,
                            ),
                        ),
                    ),
                    array( //This is A Collumn 
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            //'id' => 'col-1-skdlsld',
                            
                            'tag'   => false,
                            'content' => 'Products', //Data/Content will be come from wpEditor
                            'class' =>  'products_column',
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
                            'quantityssss' => array('tag'=>'section'),
                            'product-title' => array(
                                'tag'   => 'h1',
                                'class' => 'product title class',
                                'id'    => 'product title',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => array(
                                    'link'  => 'link', //probal values link, no_link, new tab, quick_view
                                    'open'  => 'new_tab',
                                ),
                            ),
                            'price' => array(
                                'tag'   => 'div',
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),
                            //'quantity' => array('tag'=>'section'),
                            'description' => array(
                                'tag'       =>'section',
                                'class'     => 'product_description',
                                'id'        => 'descriptIDOfProduct',
                                'style'     => false,
                                'settings'  => array(
                                    'data'      =>  'test',
                                    'other'     =>  'nothings',
                                ),
                            ),
                            'content' => array('tag'=>'section','class'=> 'my_content'),
                            
                        ),
                    ),
                    array( //This is actually a Column
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'tag'   => false,
                            'content' => 'Actions Product',
                            'class' =>  'another_class name',
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
                                'tag'   => 'div',
                                'class' => 'wpt_quantity',
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
                'fullwidth' => array( //This is a Full Width Column Where there is no Head
                    'status' => 'on', //Probale Value on and off
                    'wrapper' => array( //Wrapper of All Items, it will be TD actually
                        'id' => 'full_width',
                        'class' => 'full width Items',
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
            
            
            
            'mobile' => array(
                'label' => 'Mobile Columns',
                'status' => 'on',
                'columns' => array(
                    array( //This is A Collumn | In Mobile, Now set Only One Column Actually
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Products Details',
                            'class' =>  'products_column',
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
                            'price' => array(
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),
                            'product-title' => array(
                                'class' => 'product title class',
                                'id'    => 'product title',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => array(
                                    'link'  => 'link', //probal values link, no_link, new tab, quick_view
                                    'open'  => 'new_tab',
                                ),
                            ),
                            
                        ),
                    ),
                    array(
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Others Details',
                            'class' =>  'other_columns',
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
                            'id' => 'td_id_dfd',
                            'class' => 'tr_sdd_class',
                            'attribute'=> array(
                                'td_some' => 'tsnothing',
                                'td_attr' => 'tfttr value',
                            ),
                        ),
                        'items' => array(
                            'action' => array( //Action Item, Where available Add to cart Button Actually
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

























$datas = array(
        'POST_ID'  => 123, //Set Table POST ID is here
        'name' => 'Home Product Tables',
        'title' => 'Choose your Fafourite Table',
        'id' => 'wpt_product_table',
        'class' => array('wpt_product_table','table_tag'), //Class data for table table
        'device' => array(
            'desktop' => array(
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
                'fullwidth' => array( //This is a Full Width Column Where there is no Head
                    'status' => 'on', //Probale Value on and off
                    'wrapper' => array( //Wrapper of All Items, it will be TD actually
                        'id' => 'full_width',
                        'class' => 'full width Items',
                        'attribute'=> array(
                            'td_some' => 'tr nothing',
                            'td_attr' => 'tr attr value',
                        ),
                    ),
                    'items' => array(
                        
                        'single_product' => array(
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),

                    ),
                ),
            ),
            'tablet' => array(
                'status' => 'on',
                'columns' => array(
                    array(
                        'status'    => 'on',
                        'head'      => array(
                            'tag'       => false,
                            'content'   => 'Saiful Islam', //Checking for Empty Content
                            'class'     => 'product_thumbs',
                            'style'     => array(
                                //'display'       => 'none',
                            ),
                        ),
                        'wrapper'   => array(
                            'id'        => 'prouct_thubns',
                            'class'     => 'thumbs_id',
                        ),
                        'items'     => array(
                            'product-image'        => array(
                                'tag'   => 'section',
                                'class' => 'prodd_thumbsss',
                                'setting'=> false,
                            ),
                        ),
                    ),
                    array(
                        'status'    => 'off',
                        'head'      => array(
                            'tag'       => false,
                            'content'   => '<img src="http://wpp.cm/wp-content/uploads/2020/01/hoodie-blue-1-100x100.jpg" draggable="false">', //Checking for Empty Content
                            'class'     => 'product_thumbs',
                            'style'     => array(
                                //'display'       => 'none',
                            ),
                        ),
                        'wrapper'   => array(
                            'id'        => 'prouct_thubns',
                            'class'     => 'thumbs_id',
                        ),
                        'items'     => array(
                            'quantity'        => array(
                                'tag'   => 'section',
                                'class' => 'prodd_thumbsss',
                                'setting'=> false,
                            ),
                        ),
                    ),
                    array( //This is A Collumn 
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            //'id' => 'col-1-skdlsld',
                            
                            'tag'   => false,
                            'content' => 'Products', //Data/Content will be come from wpEditor
                            'class' =>  'products_column',
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
                            'quantityssss' => array('tag'=>'section'),
                            'product-title' => array(
                                'tag'   => 'h1',
                                'class' => 'product title class',
                                'id'    => 'product title',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => array(
                                    'link'  => 'link', //probal values link, no_link, new tab, quick_view
                                    'open'  => 'new_tab',
                                ),
                            ),
                            'price' => array(
                                'tag'   => 'div',
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),
                            //'quantity' => array('tag'=>'section'),
                            'description' => array(
                                'tag'       =>'section',
                                'class'     => 'product_description',
                                'id'        => 'descriptIDOfProduct',
                                'style'     => false,
                                'settings'  => array(
                                    'data'      =>  'test',
                                    'other'     =>  'nothings',
                                ),
                            ),
                            'content' => array('tag'=>'section','class'=> 'my_content'),
                            
                        ),
                    ),
                    array( //This is actually a Column
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'tag'   => false,
                            'content' => 'Actions Product',
                            'class' =>  'another_class name',
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
                                'tag'   => 'div',
                                'class' => 'wpt_quantity',
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
                'fullwidth' => array( //This is a Full Width Column Where there is no Head
                    'status' => 'on', //Probale Value on and off
                    'wrapper' => array( //Wrapper of All Items, it will be TD actually
                        'id' => 'full_width',
                        'class' => 'full width Items',
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
            
            
            
            'mobile' => array(
                'status' => 'on',
                'columns' => array(
                    array( //This is A Collumn | In Mobile, Now set Only One Column Actually
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Products Details',
                            'class' =>  'products_column',
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
                            'price' => array(
                                'class' => 'item_price_class',
                                'id'    => 'item price id',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => false,
                            ),
                            'product-title' => array(
                                'class' => 'product title class',
                                'id'    => 'product title',
                                'style' => array( 'color' => 'black' ),
                                'attribute' => array('some' => 'nothing'),
                                'settings'  => array(
                                    'link'  => 'link', //probal values link, no_link, new tab, quick_view
                                    'open'  => 'new_tab',
                                ),
                            ),
                            
                        ),
                    ),
                    array(
                        'status' => 'on', //Probale Value on and off
                        'head' => array( // This will be TH , imean column Head.
                            'content' => 'Others Details',
                            'class' =>  'other_columns',
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
                            'id' => 'td_id_dfd',
                            'class' => 'tr_sdd_class',
                            'attribute'=> array(
                                'td_some' => 'tsnothing',
                                'td_attr' => 'tfttr value',
                            ),
                        ),
                        'items' => array(
                            'action' => array( //Action Item, Where available Add to cart Button Actually
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