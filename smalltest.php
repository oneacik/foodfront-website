<?php

require_once ('Connections.php');
require_once ('models/User.php');
require_once ('models/Spot.php');

(new Database())->reinstall();
$_POST["login"]="test";
$_POST["pass"]="test";
$_POST["email"]="test@vp.pl";
User::createUser();
User::login();
assert(User::checkLogin());
$id=Spot::createSpot();
echo "spot id:".$id;
$spot=Spot::getSpotById($id);
assert($spot->id==$id);
