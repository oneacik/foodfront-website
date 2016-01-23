<?php

require_once("Connections.php");
require_once("smarty.php");

class User {

    static function process_login() {
        if (user::checkLogin()) {
            header("Location: /console");
            die();
        }
        $smarty = SSmarty::returnSmarty();
        if (isset($_POST["login"]) && isset($_POST["user"]) && isset($_POST["pass"])) {
            try {

                if (self::login()) {
                    header("Location: /console");
                    die();
                }
            } catch (Exception $ex) {
                $smarty->assign("error", "Błąd bazy danych");
            }
            $smarty->assign("error", "Użytkownik, lub Hasło jest nieoprawne");
        }


        $smarty->display("login.tpl");
    }

    static function process_register() {
        
        if (user::checkLogin()) {
            header("Location: /console");
            die();
        }
        
        $smarty = SSmarty::returnSmarty();
        if (isset($_POST["register"]) && isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["email"])) {
            try {

                if (self::createUser()&&self::login()) {
                    
                    header("Location: /console");
                    die();
                }else{
                    $smarty->assign("error", "Tworzenie uzytkownika nie powiodło się");
                }
                
            } catch (Exception $ex) {
                $smarty->assign("error", "Błąd bazy danych");
            }
        }


        $smarty->display("register.tpl");
    }

    static function checkLogin() {
        return isset($_SESSION["uid"]);
    }

    static function login() {
        $stmt = (new Database())->getConnection()->prepare("SELECT id FROM users WHERE login=? && pass=?");
        $stmt->execute(array($_POST["user"], $_POST["pass"]));
        if (($temp = $stmt->fetch()) != false) {
            $_SESSION["uid"] = $temp["id"];
            return true;
        }
        return false;
    }

    static function getUID() {
        return (isset($_SESSION["uid"]) ? $_SESSION["uid"] : NULL);
    }

    static function logout() {
        
        unset($_SESSION["uid"]);
    }

    static function createUser() {
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO users (login,pass,email) VALUES (?,?,?)");
        if ($stmt->execute(array($_POST["user"], $_POST["pass"], $_POST["email"]))) {
            return true;
        }
        return false;
    }

    static function deleteUser() {
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute(array(self::getUID()));
    }

}
