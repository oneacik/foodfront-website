<?php

require_once("Utils.php");
require_once("Spot.php");
#modules
require_once("./ModuleIcon.php");
require_once("./ModuleTitle.php");
require_once("./ModuleMap.php");


class Console {

    /**
     * 
     * @param Smarty $smarty
     */
    static function process($smarty) {
        $content = array();
        if (isset($_GET["sub"])) {
            $smarty->assign("sub", $_GET["sub"]); //lawl XDD XSS KURWO


            if (isset($_GET["id"])) {
                    switch ($_GET["sub"]) {
                    case "spots":
                        $content=self::processSpots();
                        break;
                    case "menus":
                    case "subscriptions":
                        break;
                }
            } else {
                switch ($_GET["sub"]) {
                    case "spots":
                    case "menus":
                    case "subscriptions":
                        self::update();
                        self::delete();
                        $content = self::listit($smarty);
                        break;
                }
            }
        }
        $smarty->assign("items", $content);
        $smarty->display("console.tpl");
    }

    
    
    
    
    
    static function processSpots(){
        $spot=  Spot::getSpotById($_GET["id"]);
        $items = array(
            new ModuleIcon($spot),
            new ModuleTitle($spot),
            new ModuleMap($spot));
        
        $content=self::listall($items);
        
        
        return $content;
    }
    
    
    
    
    /**
     * 
     * @param  $items
     */
    static function listall($items){
        $content=array();
        foreach ($items as $item){
            /* @var $item Module */
            $item->process();
            $content[]=$item->display();
            
        }
        
        return $content;
    }
    
    
    /**
     * 
     * @param Smarty $smarty
     */
    static function listit($smarty) {
        $items = array();



        switch ($_GET["sub"]) {
            case "spots":
                $items = Spot::getSpotsByUser();
                break;
            case "menus":
            case "subscriptions":

                break;
        }
        $smarty->assign("items", $items);

        $ret = array();
        $ret[] = $smarty->fetch("list.tpl");
        return $ret;
    }

    
    static function delete(){
        if (isset($_POST["delete"])&&isset($_POST["id"])) {
            switch ($_GET["sub"]) {
                case "spots":
                    Spot::deleteSpot();
                    break;
                case "menus":
                case "subscriptions":
                    break;
            }
        }
        
    }
    
    
    static function update() {

        if (isset($_POST["new"])) {
            switch ($_GET["sub"]) {
                case "spots":
                    Spot::createSpot();
                    break;
                case "menus":
                case "subscriptions":
                    break;
            }
        }
    }

}
