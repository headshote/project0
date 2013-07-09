<?php

    require("../include/settings.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        /* example for myself to keep in mind
        $xml = simplexml_load_file("../db/catalog.xml");
        echo $xml->getName() . "<br>";

        foreach($xml->children() as $item)
        {
            echo $item->getName() . ": " . $item->name . "; " . $item->category . "; " . $item->description . "; " ;
            foreach($item->price as $price)
            {
                echo (string)$price['size'] . ": " . (string)$price . ", ";
            } 
            echo".<br>";
        }
        */    
            
        //render menu
        if( isset($_GET['filter']) ) //in case we selected to filter categories
        {       
            $items = get_catalog($categ_filt=$_GET['filter']); 
            $filter = $_GET['filter'];
            render( "menu_template.php", [ "title" => "Add to cart", "filter" => $filter, "items" => $items ] );
        }
        else    //in case no filtering
        {
            $items = get_catalog();
            render( "menu_template.php", [ "title" => "Add to cart",  "items" => $items ] );   
        } 
    }
    
    else if ( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        //loop to temporarily store data from POST request 
        //(which would be 1 item(array[naem,cat,descr,price,etc..]) and 1 amount(int) [ 2 vars] every time)
        $vars = [];                
        foreach ( $_POST as $key => $value)
        {
            if ( $key == 'item')
                $value = unpack_categories( $value );
            else if ( $key == 'amount')
            {
                 $value = (int)$value;
                 if ( $value<=0 || $value>99 )
                 {
                    $vars=[];
                    break;
                 }
            }               
            if( $key =='item' || $key == 'amount')
            {                    
                $vars += [ $key=> $value ];    
            }            
        }
        
        //sending data from post request to cookie
        if ( !isset($_SESSION['cart']) )
        {
            $_SESSION['cart'] = [] ;
        }
        $push_it = true;
        if ( $vars != [] )
        {   
            foreach ( $_SESSION['cart'] as $key => $entry )
            {
                if ( $entry['item'] == $vars['item'] )
                {
                    if ( $_SESSION['cart'][$key]['amount'] + $vars['amount'] <= 99 )
                        $_SESSION['cart'][$key]['amount'] += $vars['amount'];
                    $push_it = false;
                    break;
                }
            }
            if ( $push_it == true)
                array_push( $_SESSION['cart'], $vars ) ;
        }
         
        //rendering catalog anew        
        if( isset($_POST['filter']) ) 
        {      
            $items = get_catalog($categ_filt=$_POST['filter']); 
            $filter = $_POST['filter'];
            render( "menu_template.php", [ "title" => "Add to cart", "filter" => $filter, "items" => $items ] );
        }
        else
        {
            $items = get_catalog();
            render( "menu_template.php", [ "title" => "Add to cart",  "items" => $items ] );   
        }                
    }
        
?>
