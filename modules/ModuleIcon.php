<?php
require_once ("./smarty.php");
require_once ("./Spot.php");
require_once ("./User.php");
require_once ("modules/Module.php");
require_once ("./Files.php");




class ModuleIcon extends Module{
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
        $smarty->assign("map_icon",$this->main->map_icon);
        return $smarty->fetch("ModuleIcon.tpl");
        
        
    }
    
    function process(){
        if(isset($_FILES["image"])&&isset($_POST["icon"])){
            $smth=Filess::upload(64, 64);
            if($smth==false){
                return;
            }
            Filess::delete($this->main->map_icon);
            $this->main->updateMapIcon($smth);
            
        }
        
    }
    
    
}