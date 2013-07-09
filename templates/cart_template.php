<?php if ( isset($_SESSION['cart']) && $_SESSION['cart'] != [] ): ?> 
    <p style='font-size:22px; text-align:center'><b>Contents of cart</b></p>
    <table class='table-striped' style="margin-left:auto; margin-right:auto; text-align:center">
        <thead>
            <tr>
                <th>Item</th>
                <th>Category</th>
                <th>Size</th>  
                <th>Price</th>   
                <th>Amount in cart</th>  
                <th></th>                   
            </tr>
        </thead>
        <tbody>       
            <?php  foreach (  $_SESSION['cart'] as $key => $item  ): ?>
            <tr style='vertical-align:center'>
                <td><?= $item['item'][0] ?></td>
                <td><?= $item['item'][1] ?></td>
                <td><?= $item['item'][2] ?></td> 
                <td><?= $item['item'][3] ?></td>
                <td>
                    <form  action='cart.php' method='post'>
                        <div class='input-append'>
                            <input type='hidden' name = 'change_index' value='<?= $key ?>'/><input type='text' class='input-mini' name = 'amount' size='1' maxlength='2' value="<?= $item['amount'] ?>"/><button class='btn' type = 'submit'>Change amount</button>
                        </div>
                    </form>
                </td>
                <td>
                    <form  action='cart.php' method='post'>
                        <div class='input-append'>
                            <input type='hidden' name = 'remove_index' value='<?= $key ?>'/><button class='btn' type = 'submit'>Remove entry</button>
                        </div>
                   </form>
                </td>
            </tr>
            <?php  endforeach ?>
        </tbody>
    </table>
    <div style="margin-left:auto; margin-right:auto;text-align:center">
        <form action='checkout.php' method='post'>
            <?php $i=0; ?>
            <?php  foreach (  $_SESSION['cart'] as $item  ): ?>
                <input type='hidden' name='<?= $i ?>' value="<?= $item['item'][0].'|'.$item['item'][1].'|'.$item['item'][2] ."|".$item['amount'] ?>">
            <?php $i++; ?>          
            <?php  endforeach ?>
            <button class='btn' type='submit'>Purchase</button>
        </form>
    </div>
<?php else: ?>
    <p style='text-align:center;font-size:14px'>Cart is empty</p>
<?php endif ?>
