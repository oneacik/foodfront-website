<?php

$jsonInput = file_get_contents("php://input");
$response = json_decode($jsonInput, true);
print $response['hej'];