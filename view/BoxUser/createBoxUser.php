<?php
require_once __DIR__.'/../../controller/BoxUser-controller.php';

$api = new BoxUser_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $api->createBoxUser($_POST['id_account'], $_POST['first_name'], $_POST['last_name'], $_POST['rut'], $_POST['email'] );
}    
?>