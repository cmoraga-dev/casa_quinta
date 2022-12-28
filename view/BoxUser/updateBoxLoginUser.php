<?php
require_once __DIR__.'/../../controller/BoxUser-controller.php';

session_start();

$api = new BoxUser_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $api->updateBoxLoginUser($_SESSION["id_account"], $_POST['box_num_user']);
}
?>