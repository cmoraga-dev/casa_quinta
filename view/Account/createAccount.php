<?php
require_once __DIR__.'/../../controller/Account-controller.php';

$api = new Account_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $api->createAccount($_POST['user'], $_POST['pass'], 2);
}    
?>