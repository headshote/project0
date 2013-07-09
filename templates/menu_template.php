<table style="margin-left:auto; margin-right:auto;">
    <thead style="font-size:22px">
        <tr>
            <th style='text-align:left'>
            Filtering options
            </th>
            <th>
            Menu
            </th>
        </tr>
    </thead>
<tbody>
<tr>
<?php 
    $categ_list = get_categories();
    //var_dump($categ_list);
?>
<td style=" vertical-align:top">
    <p style='margin-right:20px; '><b><a href="?filter=show_everything">Show Everything</a></b><br/>
    <?php foreach( $categ_list as $categ_entry ): ?>
        <a href="?filter=<?= rawurlencode($categ_entry) ?>"><?= $categ_entry ?></a><br/>
    <?php endforeach ?>
    </p>
</td>
<td>
    <table class='table-striped' style="margin-left:auto; margin-right:auto;">
        <thead>
            <tr>
                <th>Item</th>
                <th>Category</th>
                <th>Description</th>  
                <th>Price</th>
                <th></th>                        
            </tr>
        </thead>
        <tbody>        
            <?php  foreach (  $items as $item  ): ?>
            <tr>
                <td><p style='margin-left:6px; margin-right:6px'><?= $item['name']  ?></p></td>
                <td><p style='margin-left:6px; margin-right:6px'><?= $item['category']   ?></p></td>
                <td><div style="width: 400px;  overflow: auto"><p style='margin-left:6px; margin-right:6px'><?= $item['description'] ?></p></div></td> 
                <td style='vertical-align:top'><?php foreach ( $item['price'] as $key => $value )  
                        {     
                            $name = $item['name'];
                            $category = $item['category'];  
                            if ($value != '')
                                echo  "<p style='margin-top:5px ;font-size:16px'>".$key .': '. $value ."</p><br/>";
                       }
                    ?>
                </td>
                <td><?php foreach ( $item['price'] as $key => $value )  
                        {     
                            $name = $item['name'];
                            $category = $item['category'];  
                            if ($value != '')
                                if ( !isset($filter) )
                                    echo  "<form  action='menu.php' method='post'><div class='input-append'><input name='amount' class='input-mini' type='text' value='1' size='1' maxlength='2'/><input type='hidden' name='item' value='" . "$name|$category|$key|$value" . "'/><button class='btn' type='submit'>Add to cart</button></div></form>";
                                else
                                    echo "<form  action='menu.php' method='post'><div class='input-append'><input name='amount' class='input-mini' type='text' value='1' size='1' maxlength='2'/><input type='hidden' name='filter' value='$filter'/><input type='hidden' name='item' value='" . "$name|$category|$key|$value" . "'/><button class='btn' type='submit'>Add to cart</button></div></form>";
                        }
                    ?>                    
                </td>
            </tr>
            <?php  endforeach ?>
        </tbody>
    </table>
</td>
</tr>
</tbody>
</table>
