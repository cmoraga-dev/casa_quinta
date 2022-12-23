<?php
require_once __DIR__.'/../../controller/boxUser-controller.php';

session_start();

$api = new BoxUser_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $api->updateBoxLoginUser($_SESSION["id"], $_POST['box_num_user']);
}
?>