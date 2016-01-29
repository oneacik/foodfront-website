<?php

class Database {

    /**
     *
     * @var PDO
     */
    static private $conn = null;

    /**
     *
     * @return PDO
     */
    function getConnection() {

        if (self::$conn === null) {
            try {
                self::$conn = new PDO('mysql:host=localhost;dbname=oneat;charset=utf8', 'root', 'likrysz1');
            } catch (PDOException $ex) {
                echo $ex;
            }
        }
        return self::$conn;
    }

    function closeConnection() {
        if (self::$conn !== null) {
            self::$conn->close();
        }
    }

    function reinstall() {
        try {
            $conn = self::getConnection();
            $conn->exec("DROP DATABASE oneat;");
            $conn->exec("CREATE DATABASE oneat;");
            $conn->exec("USE oneat;");
            $conn->exec("CREATE TABLE users ("
                    . "id INT auto_increment,"
                    . "login VARCHAR(32),"
                    . "pass VARCHAR(32),"
                    . "email VARCHAR(128),"
                    . "creation_date TIMESTAMP DEFAULT NOW(),"
                    . "primary key (id))");

            $conn->exec("CREATE TABLE spots ("
                    . "id INT auto_increment,"
                    . "user INT,"
                    . "menu INT DEFAULT 0,"
                    . "title VARCHAR(64) DEFAULT 'Tytul Domyslny',"
                    . "address VARCHAR(128) DEFAULT 'Adres Domyslny, Warszawa',"
                    . "lat DOUBLE DEFAULT 52.2296756,"
                    . "lng DOUBLE DEFAULT 21.0122287,"
                    . "creation_date TIMESTAMP DEFAULT '0000-00-00 00:00:00',"
                    . "update_date TIMESTAMP DEFAULT NOW(),"
                    . "map_icon INT DEFAULT 0,"
                    . "map_banner INT DEFAULT 0,"
                    . "hi_icon INT DEFAULT 0,"
                    . "primary key (id))");

            $conn->exec("CREATE TABLE menus ("
                    . "id INT auto_increment,"
                    . "user INT,"
                    . "title VARCHAR(64),"
                    . "content TEXT,"
                    . "primary key (id))");

            $conn->exec("CREATE TABLE subscriptions ("
                    . "id INT auto_increment,"
                    . "content Varchar(64),"
                    . "price DOUBLE,"
                    . "discount_price DOUBLE,"
                    . "quantity DOUBLE,"
                    . "type INT,"
                    . "primary key (id))");


            $conn->exec("CREATE TABLE images ("
                    . "id INT auto_increment,"
                    . "primary key (id))");



        } catch (PDOException $ex) {
            echo $ex;
        }
    }

}
