<?php
require_once __DIR__.'/../../controller/Booking-controller.php';

$api = new Booking_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $api->createBookingUser($_POST['user_id'], $_POST['fechaReserva']);
}    
?>