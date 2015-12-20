<?php
require_once './Connections.php';

$data=new Database();
$data->reinstall();
var_dump($data->getConnection()->errorInfo());
