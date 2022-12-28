<?php
echo 'todo bien';
require_once __DIR__.'/../../controller/Booking-controller.php';

echo 'todo bien';

$api = new Booking_controller();

echo 'todo bien';
// if($_SERVER["REQUEST_METHOD"] === "POST"){
//     //$_POST = json_decode(file_get_contents("php://input"), true);
//     $api->getAllBookingToday();
// }
?>