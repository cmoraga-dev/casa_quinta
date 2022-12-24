<?php
require_once __DIR__.'/../../controller/Booking-controller.php';

session_start();
$api = new Booking_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //$_POST = json_decode(file_get_contents("php://input"), true);
    $api->updateBoxBooking($_POST['id_booking'], $_SESSION['id_box_user']);
}
?>