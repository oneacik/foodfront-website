<?php

require_once("models/Subscription.php");
require_once("models/User.php");
require_once("models/Spot.php");
require_once("models/Menu.php");

class tests{

    static function process(){

        $_SESSION["uid"] = User::getUID();
        $methods = get_class_methods(new tests());

        foreach($methods as $method) {
            if(strchr($method,'test')){
                if(self::$method() == true){
                    echo '<H1>'.$method.': <font color="green"><b>TRUE</b></font></h1><hr>';
                } else {
                    echo '<H1>'.$method.': <font color="red"><b>FALSE</b></font></h1><hr>';
                }
            }
        }
    }

    static function testSubscription(){

        $logout = User::logout();
        $subscription = new Subscription();
        $_POST["content"] = self::generateRandomString();
        $_POST["price"] = self::generateRandomString();
        $_POST["discountPrice"] = self::generateRandomString();
        $_POST["quantity"] = self::generateRandomString();
        $_POST["type"] = self::generateRandomString();
        $_SESSION["uid"] = "378984";

        if(($create = $subscription->createSubscription()) !== NULL){
            echo 'CREATE SUBSCRIPTION: <font color="green">STWORZONO, twoje UID: '.$create.'</font></br>';
            $_POST["id"] = $create;
        } else {
            echo 'CREATE SUBSCRIPTION: <font color="red">ERROR!</font></br>';
            return false;
        }

        if(($getId = $subscription->getSubscriptionById($create)) !== false){
            echo 'GET BY ID: <font color="green">ODNALEZIONO</font></br>';
        } else {
            echo 'GET BY ID: <font color="red">ERROR</font></br>';
            return false;
        }

        if(($getUser = $subscription->getSubscriptionsByUser()) !== false){
            echo 'GET BY USER: <font color="green">ODNALEZIONO</font></br>';
        } else {
            echo 'GET BY USER: <font color="red">ERROR</font></br>';
            return false;
        }

        $subscription->deleteSubscription();
        if($subscription->getSubscriptionById($create) == NULL){
            echo 'DELETE SUBSCRIPTION: <font color="green">USUNIETO</font></br>';
        } else {
            echo 'DELETE SUBSCRIPTION: <font color="red">ERROR</font></br>';
            return false;
        }

        return true;

    }

    static function generateRandomString($length = 3) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static function testUser() {
        $user = new User();
        $logout = User::logout();

        $_POST["user"] = self::generateRandomString();
        $_POST["pass"] =  self::generateRandomString();
        $_POST["email"] =  self::generateRandomString();

        if($register = User::createUser()){
            echo 'CREATE USER: <font color="green">Stworzono uzytkownika o id: '.$register.' Dane: '.$_POST["user"].' Haslo: '.$_POST["pass"].'</font></br>';
        } else {
            echo 'CREATE USER: <font color="red">ERROR!</font>';
        }

        $login = User::login();
        $id = User::getUID();

        if($login == true) {
            echo 'LOGIN: <font color="green">Zalogowano, twoje UID: '.$id.'</font></br>';
        } else {
            echo '<font color="red">LOGIN: ERROR!</font></br>';
            return false;
        }

        if(User::checkLogin()){
            echo 'CHECK LOGIN: <font color="green">Zalogowany</font></br>';
        } else {
            echo 'CHECK LOGIN: <font color="red">Niezalogowany</font></br>';
            return false;
        }

        if($delete = User::deleteUser() == true){
            echo 'DELETE USER: <font color="green">Usunieto uzytkownika</font></br>';
        } else {
            echo 'DELETE USER: <font color="red">ERROR</font></br>';
            return false;
        }


        User::logout();
        if(!isset($_SESSION["uid"])){
            echo 'LOGOUT: <font color="green">Wylogowano!</font></br>';
        } else {
            echo 'LOGOUT: <font color="red">ERROR!</font></br>';
            return false;
        }
        return true;
    }

    static function testSpot() {
        $logout = User::logout();
        $spot = new Spot();
        $uid = $_SESSION["uid"] = "378984";

        if(($create = $spot->createSpot()) !== NULL){
            echo 'CREATE SPOT: <font color="green">STWORZONO: '.$create.'</font></br>';
        } else {
            echo 'CREATE SPOT: <font color="red">ERROR!</font></br>';
            return false;
        }

       if(($spot->getSpots()) !== NULL){
            echo 'GET SPOTS: <font color="green">ODNALEZIONO</font></br>';
        } else {
            echo 'GET SPOTS: <font color="red">ERROR!</font></br>';
            return false;
        }

       if($spot->getSpotsByUser() !== NULL){
            echo 'GET SPOTS BY USER: <font color="green">ODNALEZIONO</font></br>';
        } else {
            echo 'GET SPOTS BY USER: <font color="red">ERROR!</font></br>';
            return false;
        }

       if($spot->getSpotById($create) !== NULL){
            echo 'GET SPOTS BY ID: <font color="green">ODNALEZIONO</font></br>';
        } else {
            echo 'GET SPOTS BY ID: <font color="red">ERROR!</font></br>';
            return false;
        }

        $spot = $spot->getSpotById($create);
        $oldMapIcon = $spot->map_icon;
        $oldBanner = $spot->map_banner;
        $oldLat = $spot->lat;
        $oldLng = $spot->lng;
        $oldAddress = $spot->address;
        $string = self::generateRandomString();

        $spot->updateTitle($string);
        $spot = $spot->getSpotById($create);
           if($spot->title == $string){
            echo 'UPDATE TITLE: <font color="green">UDANE</font></br>';
           } else {
            echo 'UPDATE TITLE: <font color="red">ERROR!</font></br>';
            return false;
        }

        $spot->updateMapIcon("312312");
        $spot = $spot->getSpotById($create);
        if($oldMapIcon !== $spot->map_icon){
            echo 'UPDATE MAP ICON: <font color="green">UDANE</font></br>';
        } else {
            echo 'UPDATE MAP ICON: <font color="red">ERROR!</font></br>';
            return false;
        }

        $spot->updateBanner("312312");
        $spot = $spot->getSpotById($create);

        if($oldBanner !== ($spot->map_banner)){
            echo 'UPDATE BANNER: <font color="green">UDANE</font></br>';
        } else {
            echo 'UPDATE BANNER: <font color="red">ERROR!</font></br>';
            return false;
        }

        $spot->updateLocation("312312","312312","312312");
        $spot = $spot->getSpotById($create);
        if($oldLat !== ($spot->lat) && $oldLng !== ($spot->lng) && $oldAddress !== ($spot->address)){
            echo 'UPDATE LOCATION: <font color="green">UDANE</font></br>';
        } else {
            echo 'UPDATE LOCATION: <font color="red">ERROR!</font></br>';
            return false;
        }

        $_POST["id"] = $create;
        $spot->deleteSpot();
        if(($spot = $spot->getSpotById($create)) == NULL){
            echo 'DELETE SPOT: <font color="green">UDANE</font></br>';
        } else {
            echo 'DELETE SPOT: <font color="red">ERROR!</font></br>';
            return false;
        }

        return true;
    }

}
tests::process();
