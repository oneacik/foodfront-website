<?php
require_once ("./smarty.php");
require_once ("./Spot.php");
require_once ("./User.php");
require_once ("modules/Module.php");
require_once ("./Files.php");




class ModuleTitle extends Module{
    /**
     *
     * @var Spot
     */
    
    
    
    function validate(){
        return ($_GET["sub"]=="spots" && isset($_GET["id"]) && $this->main->user==User::getUID());
    }
    
    /**
     * 
     * @param Item $item
     */
    function display(){
        $smarty=SSmarty::returnSmarty();
        $smarty->assign("title",$this->main->title);
        return $smarty->fetch("ModuleTitle.tpl");
        
        
    }
    
    function process(){
        if(isset($_POST["title"])&&isset($_POST["title_change"])){
            $this->main->updateTitle($_POST["title"]);
            
        }
        
    }
    
    
}