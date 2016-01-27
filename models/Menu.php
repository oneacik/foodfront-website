<?php

class Menu{
    var $id;
    var $title;
    var $user;
    var $content;
    
    static function getMenusByUser(){
        if(($uid=User::getUID())==NULL){
            throw new Exception("Użytkownik jest niezalogowany");
        }
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("SELECT * WHERE user=?");
        $stmt->execute(array($uid));
        $menus=$stmt->fetchAll(PDO::FETCH_CLASS,"Menu");
        return $menus;
    }
    
    static function getMenuById($id){

        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("SELECT * FROM spots WHERE id=?");
        $stmt->execute(array($id));
        
        /**
         * @var Spot
         */
        $menu=$stmt->fetchObject("Menu");
        if($menu==FALSE||($menu->user!=User::getUID())){
            return NULL;
            
        }
        return $menu;
    }
    
    
    
    
    
    
}