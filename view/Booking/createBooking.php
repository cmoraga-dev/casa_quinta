<?php
require_once __DIR__.'/../../controller/Booking-controller.php';

$api = new Booking_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $data = $api->createBookingUser($_POST['rut'], $_POST['fechaReserva']);
    //echo json_encode($data);
}    
?>