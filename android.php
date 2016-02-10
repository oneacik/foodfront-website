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
                break;

            case "getSpots":
                $arr = self::getSpots();
                break;
            case "getSpot":
                $arr = self::getSpot($json->id);;
                break;

        }

        $response = json_encode($arr);
        echo $response;
    }

    static function login($username,$password) {

        $login = User::_login($username,$password);

        if($login >= 0) {
            $arr = array('errno'=>0,'error'=> "");
        }
        elseif($login == -1) {
            $arr = array('errno'=>-1,'error'=> "Wrong credentials");
        }
        else {
            $arr = array('errno'=>-2,'error'=> "System error");
        }

        return $arr;
    }

    static function getSpots() {

        $spots = Spot::getSpots();
        if($spots){
            $error = array('errno'=>0,'error'=>'');
            $arr = array('places'=>$spots,'error'=>$error);
        } else {
            $error = array('errno'=>-1,'error'=>'System error');
            $arr = array('error'=>$error);
        }
        return $arr;
    }

    static function getSpot($id) {
        $spot = Spot::_getSpotById($id);
        if($spot){
            $arr = array('places'=>$spot,'errno'=>0,'error'=>'');
        } else {
            $arr = array('errno'=>-1,'error'=>'System error');
        }
        return $arr;
    }

    }



Android::process();
