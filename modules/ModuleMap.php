<?php
require_once ("./smarty.php");
require_once ("./Spot.php");
require_once ("./User.php");
require_once ("modules/Module.php");
require_once ("./Files.php");




class ModuleMap extends Module{
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
        $smarty->assign("lat",$this->main->lat);
        $smarty->assign("lng",$this->main->lng);
        $smarty->assign("address",$this->main->address);
        $smarty->assign("map_icon",$this->main->map_icon);
        
        return $smarty->fetch("ModuleMap.tpl");
        
        
    }
    
    function process(){
        if(
                isset($_POST["update_location"])&&
                isset($_POST["lat"])&&
                isset($_POST["lng"])&&
                isset($_POST["address"])
                ){
            
            $this->main->updateLocation($_POST["lat"],
                $_POST["lng"],
                $_POST["address"]);
            
        }
        
    }
    
    
}