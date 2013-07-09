<!DOCTYPE html>
<html>
    <head>
        <? if ( isset($title) ): ?>
            <title>Thee Aces Pizza: <?= htmlspecialchars($title) ?></title>
        <? else: ?>
            <title>Thee Aces Pizza</title>
        <? endif ?>
        <script src="js/script.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
    </head>
    <body>
        <div>
            <div style="margin-left:auto; margin-right:auto; text-align:center" id = 'top'>
                <h1><a href="/">Three Aces Pizza</a></h1>
                <table style="margin-left:auto; margin-right:auto; text-align:center"><tr><td >
                    <ul class="nav nav-pills" >
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="cart.php">Cart(<?= cart_size() ?>)</a></li>
                    </ul>
               </td></tr></table>
            </div>
            <div id = 'mid'>
