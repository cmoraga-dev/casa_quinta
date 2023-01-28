<?php
require_once __DIR__.'/../../controller/User-controller.php';

header('Content-type: application/json');
echo json_encode( 'aaaaaaa' );


$api = new User_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $api->getAlluser();
    return 'Error!';
}

?>
