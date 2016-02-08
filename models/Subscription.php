<?php
require_once './Connections.php';

class Subscription{

    var $id;
    var $content;
    var $price;
    var $discountPrice;
    var $quantity;
    var $type;

   static function createSubscription(){
        if(User::getUID()==NULL){
            return NULL;
        }
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("INSERT INTO subscriptions (content, price, discount_price, quantity, type, uid) VALUES (?,?,?,?,?,?");
        if(  !$stmt->execute(array($_POST["content"], $_POST["price"], $_POST["discountPrice"], $_POST["quantity"], $_POST["type"], User::getUID()))    ){
            return NULL;
        }
        return $conn->lastInsertId();
   }

    static function getSubscriptionsByUser(){
         if(($uid=User::getUID())==NULL){
            throw new Exception("Użytkownik jest niezalogowany");
        }
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("SELECT * FROM subscriptions WHERE user=?");
        $stmt->execute(array($uid));
        $subscriptions=$stmt->fetchAll(PDO::FETCH_CLASS,"Subscription");
        return $subscriptions;
    }

    static function getSubscriptionById($id){
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("SELECT * FROM subscriptions WHERE id=?");
        $stmt->execute(array($id));
        $subscription=$stmt->fetchObject("Subscription");

        if($subscription==FALSE||$subscription->user!=User::getUID()){
            return false;
        }
        return $subscription;
    }

    static function deleteSubscription(){
        if(($uid=User::getUID())==NULL){
            throw new Exception("Użytkownik jest niezalogowany");
        }

        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("DELETE FROM subscription WHERE user=? && id=?");
        $stmt->execute(array($uid,$_POST["id"]));


    }
}
