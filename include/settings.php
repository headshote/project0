<?php
    
    //Set up error reporting for us here to see everithing that's wrong
    ini_set("display errors", true);
    error_reporting(E_ALL);
    
    //contains declarations of all "low-level" functions
    require("functions.php");
    
    //so that we could use cookies
    session_start();

?>
