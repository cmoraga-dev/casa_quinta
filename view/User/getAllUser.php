<?php
require_once __DIR__.'/../../controller/User-controller.php';

header('Content-type: application/json');


$api = new User_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $data = $api->getAlluser();
    echo json_encode($data);
}

?>
