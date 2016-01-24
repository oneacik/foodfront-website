<?php

$jsonInput = file_get_contents("php://input");
$response = json_decode($jsonInput, true);

$data = array(
    'errno' => '0',
    'error' => '',
);

$send = json_encode($data);

echo $send;