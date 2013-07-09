<?php

    /* Renders template that contains html and "highest" level php-functionality
    *  to process incoming data ($vars) and display it to user in a neat form.
    *  Everything is broken into header, template itself and footer; header and footer are common
    *  for all pages through website, template is obviously unique
    */
    function render( $template, $vars=[])
    {
        if( file_exists( "../templates/$template" ) )
        {
            extract($vars); //to "send" variables from one php script (mostly from html) to another
                            //( to templates)
            require_once("../templates/header.php");
            require_once("../templates/$template");
            require_once("../templates/footer.php");
            exit;
        }
        else
        {
            trigger_error("Invalid template! $template", E_USER_ERROR);
        }
    }
    
    /* Gets items from menu database (or catalog or whatever)
     * and stores it into neat data structure in memory
     * (array of arrays [ name, cat, descr, [prices] ]
     */ 
    function get_catalog( $categ_filt = 'show_everything')
    {
        $xml = simplexml_load_file("../db/catalog.xml");
        $items = [];
        if ( $categ_filt == 'show_everything' ) //case we want to show all catalog
        {
            $i = 0;
            foreach( $xml->children() as $item)
            {
                 $items[$i] = [ 'name' => (string)$item->name, 'category' => (string)$item->category,
                               'description' => (string)$item->description, 'price' => [] ] ;                                                            
                 foreach($item->price as $price)
                 {
                    $items[ $i ]['price'] += [ (string)$price['size'] => (string)$price ];
                 }
                 $i++;
            }
        }
        else //if not entire catalog
        { 
            $categ_list = get_categories();
            if( in_array( $categ_filt, $categ_list  ) ) //if filtering string is a valid category
            {
                    $i = 0;
                    foreach( $xml->children() as $item)
                    {
                        if ( (string)$item->category == $categ_filt )
                        {
                             $items[$i] = [ 'name' => (string)$item->name, 'category' => (string)$item->category,
                                           'description' => (string)$item->description, 'price' => [] ] ;                                                            
                             foreach($item->price as $price)
                             {
                                $items[ $i ]['price'] += [ (string)$price['size'] => (string)$price ];
                             }
                             $i++;
                        }
                    }
            }        
            else //if filtering list is not valid category just get  everything (with sort of recursion)
                $items = get_catalog();            
        }
        return $items;
    }
    
    /*  convert 'name|category|size|price' string to an array
    *   [name, category, size, price]
    *
    */
    function unpack_categories ( $string )
    {
        $retval = [ ];
        $i = 0;
        $j = 0;
        while( $i < strlen($string) )
        {
            // if current char is special char that divides string
            if ( $string[$i] == '|')
            {
                $i++;   //jump over this char
                $j++;   //start filling new string in array
            }
            if ( !isset($retval[$j]) )
            {
                $retval[$j] = '';
            }
            $retval[$j] .= $string[$i];
            $i++;
        }        
        return $retval;
    }  
    
    /* Shows number of cart entries
     */
    function cart_size()
    {
        if( ! isset( $_SESSION['cart'] ) )
            return 0;
        return count( $_SESSION['cart'] );
    }
    
    /* Gets categories from catalog and storers them in array of stings
     */ 
    function get_categories()
    {
        $xml = simplexml_load_file("../db/catalog.xml");
        $items = [];
        $i = 0;
        foreach( $xml->children() as $item)
        {
            if( !in_array( (string)$item->category, $items ) )
            {
                $items[$i] =  (string)$item->category ; 
                $i++;
            }
        }
        return $items;
    }
?>

