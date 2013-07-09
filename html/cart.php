<?php

    require('../include/settings.php');
    
    if ( $_SERVER['REQUEST_METHOD'] == 'GET')
    {
       render("cart_template.php", ["title" => "Cart"]);
    }
    
    else if( $_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['change_index']) )
        {
            $amount = (int)$_POST['amount'];
            $change_index = (int)$_POST['change_index'];
            if( isset($_SESSION['cart'][$change_index]) )
            {                
                if( $amount > 0 && $amount <=99 )
                    $_SESSION['cart'][$change_index]['amount'] = $amount;
            }
        }
        else if( isset($_POST['remove_index']) )
        {
            $remove_index = (int)$_POST['remove_index'];
            if( isset($_SESSION['cart'][$remove_index]) )
            {
                unset( $_SESSION['cart'][$remove_index] );
            }
        }
        //var_dump($_POST);
        //var_dump($_SESSION['cart']);
        render("cart_template.php", ["title" => "Cart"]);
    }

?>
