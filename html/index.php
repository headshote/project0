<?php

    require("../include/settings.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
         render( "index_template.php", [ "title" => "Index page"] );
    }
    
?>
