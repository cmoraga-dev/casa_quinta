<?php
require_once __DIR__.'/../../controller/User-controller.php';

$api = new User_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    return $api->getAlluser();
}
?>
