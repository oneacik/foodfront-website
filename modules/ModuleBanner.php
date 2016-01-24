<?php
require_once ("./smarty.php");
require_once ("./Spot.php");
require_once ("./User.php");
require_once ("./Module.php");
require_once ("./Files.php");




class ModuleBanner extends Module{
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
        $smarty->assign("map_banner",$this->main->map_banner);
        return $smarty->fetch("ModuleBanner.tpl");


    }

    function process(){
        if(isset($_FILES["banner"])&&isset($_POST["banner"])){
            $smth=Filess::upload(720, 360);
            if($smth==false){
                return;
            }
            Filess::delete($this->main->map_banner);
            $this->main->updateMapBanner($smth);

        }

    }


}
