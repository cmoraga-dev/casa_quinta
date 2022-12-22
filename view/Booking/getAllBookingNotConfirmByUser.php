<?php
require_once __DIR__.'/../../controller/Booking-controller.php';

$api = new Booking_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $api->getAllBookingNotConfirmByUser($_POST['rut']);
}
?>