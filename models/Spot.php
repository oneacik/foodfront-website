<?php
require_once './Connections.php';
require_once './User.php';
class Spot{

    var $id;
    var $user,$menu;
    var $title;
    var $lat,$lng;
    var $creation_date;
    var $update_date;
    var $map_icon;
    var $hi_icon;
    var $address;
    
    
    
    
    static function createSpot(){
        if(User::getUID()==NULL){
            return NULL;
        }
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("INSERT INTO spots (user,creation_date) VALUES (?,NOW())");
        if(  !$stmt->execute(array(User::getUID()))    ){
            return NULL;
            
        }
        
        return $conn->lastInsertId();
        
    }
    
    static function deleteSpot(){
        if(($uid=User::getUID())==NULL){
            throw new Exception("Użytkownik jest niezalogowany");
        }
        
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("DELETE FROM spots WHERE user=? && id=?");
        $stmt->execute(array($uid,$_POST["id"]));
        
        
    }
    
    static function getSpotsByUser(){
        if(($uid=User::getUID())==NULL){
            throw new Exception("Użytkownik jest niezalogowany");
        }
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("SELECT id,title,address,user,menu,lat,lng,creation_date,update_date,map_icon,hi_icon FROM spots WHERE user=?");
        $stmt->execute(array($uid));
        $spots=$stmt->fetchAll(PDO::FETCH_CLASS,"Spot");
        return $spots;
    }
    
    /**
     * 
     * @param integer $id
     * @return Spot
     */
    
    static function getSpotById($id){

        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("SELECT id,title,address,user,menu,lat,lng,creation_date,update_date,map_icon,hi_icon FROM spots WHERE id=?");
        $stmt->execute(array($id));
        
        /**
         * @var Spot
         */
        $spot=$stmt->fetchObject("Spot");
        if($spot==FALSE||($spot->user!=User::getUID())){
            return NULL;
            
        }
        return $spot;
    }
    
    function updateTitle($title){
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("UPDATE spots SET title=? WHERE id=?");
        $stmt->execute(array($title,$this->id));
        $this->title=$title;
    }
    
    function updateMapIcon($img){
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("UPDATE spots SET map_icon=? WHERE id=?");
        $stmt->execute(array($img,$this->id));
        $this->map_icon=$img;
    }
    
    function updateLocation($lat,$lng,$address){
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("UPDATE spots SET lat=?,lng=?,address=?  WHERE id=?");
        $stmt->execute(array($lat,$lng,$address,$this->id));
        $this->lat=$lat;
        $this->lng=$lng;
        $this->address=$address;
        
    }
    
    
}
