<?php

require_once("./smarty.php");
require_once("./Console.php");
require_once("./models/User.php");
        
session_start();

switch($_GET["main"]){
    
    case "console":{
        Console::process();
        break;
    }
    
    
    case "login":{
        User::process_login();
        break;
    }
    
    case "register":{
        User::process_register();
        break;
    }
    
    default:{
        break;
    }
    
}
