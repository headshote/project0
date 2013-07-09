<?php
    
    require('../include/settings.php');

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        if( isset($_SESSION['cart'] ) && $_SESSION['cart'] != [] )
        {
            $handle = fopen( "../db/orders.csv" ,"a");
            $date = getdate();        
            foreach ( $_POST as $key => $value )
            {
                fputcsv( $handle, [ $value, $date["mday"], $date["mon"], $date["year"], $date["hours"], $date["minutes"] ] );  
                //echo $key.': '.$value.'<br/>';
            }
            fclose( $handle);
                    
            $total = 0.0;
            foreach( $_SESSION['cart'] as $entry )
            {
                $total += (int)$entry['amount'] * (float)$entry['item'][3];
            }
                    
            $_SESSION['cart'] = [];
                    
            render("checkout_template.php", ["title" => "Check Out", "total" => $total]);
        }
        else
        {
            render("cart_template.php", ["title" => "Cart"]);
        }        
    }
?>
