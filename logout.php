<?php
session_start();
require_once ("User.php");
User::logout();
header("Location: /login/");