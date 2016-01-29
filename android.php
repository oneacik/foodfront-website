<?php
#models
require_once("models/User.php");
require_once("models/Spot.php");

class Android {

    static function process(){

        $json = json_decode(file_get_contents("php://input"));
        $function = $json->function;

        switch($function){
            case "login":
                $arr = self::login($json->username, $json->password);
                self::login();
                break;

            case "getSpots":
                break;

        }

        $response = json_encode($arr);
        echo $response;
    }

    static function login($username,$password) {

        $login = User::_login($username,$password);

        if($login == true) {
            $arr = array('succes'=>'true');
        } else {
            $arr = array('succes'=>'false');
        }

        return $arr;
    }
}

Android::process();
