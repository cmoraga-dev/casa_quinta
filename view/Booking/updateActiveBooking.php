<?php
require_once __DIR__.'/../../controller/Booking-controller.php';

session_start();
$api = new Booking_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $api->updateBoxBooking($_POST['id_booking'], $_POST['status_booking']);
}
?>