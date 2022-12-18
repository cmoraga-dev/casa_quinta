<?php

include_once __DIR__.'\..\model\Booking.php';

class Booking_controller{

    function getAllBooking(){
        $bookibng = new Booking();
        $bookibngs = array();
        $bookibngs["bookings"] = array();

        $res = $bookibng->getAllBooking();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "user_id" => $row['user_id'],
                    "datatime" => $row['datatime'],
                    "confirmed" => $row['confirmed'],
                    "active" => $row['active']
                );
                array_push($bookibngs["bookings"], $item);
            }
            return $this->boxUser = $bookibngs;
        } else {
            $this->error = json_encode(array('cod' => '204', 
                                    'msj' => 'Booking no encontrado'));
        }
    }

    function getBookingByUser($user_id){
        $bookibng = new Booking();
        $bookibngs = array();
        $bookibngs["bookings"] = array();

        $res = $bookibng->getAllBooking($user_id);

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "user_id" => $row['user_id'],
                    "datatime" => $row['datatime'],
                    "confirmed" => $row['confirmed'],
                    "active" => $row['active']
                );
                array_push($bookibngs["bookings"], $item);
            }
            return $this->boxUser = $bookibngs;
        } else {
            $this->error = json_encode(array('cod' => '500', 
                                    'msj' => 'Usuario de booking no encontrado'));
        }
    }

    function createBoxUser($id_account,$fechaActual ){
        $box_user = new Booking();

        $res = $box_user->createBooking($id_account, $fechaActual );
        
        if ($res->rowCount()) {
            echo 'Se guardo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro crear el booking'));
        }
    }

    function deleteBooking($id){
        $box_user = new Booking();

        $res = $box_user->deleteBooking($id);
        
        if ($res->rowCount()) {
            echo 'Se Elimino Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro eliminar el booking'));
        }
    }

    
    function updateConfirmBooking($id , $confirm,  $id_usuario ){
        $box_user = new Booking();

        $res = $box_user->updateConfirmBooking($id , $confirm,  $id_usuario );
        
        if ($res->rowCount()) {
            echo 'Se actualizo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }

    function updateActiveBooking($id , $active ){
        $box_user = new Booking();

        $res = $box_user->updateActiveBooking($id , $active );
        
        if ($res->rowCount()) {
            echo 'Se actualizo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }

    function updateBoxBooking($id , $box_id){
        $box_user = new Booking();

        $res = $box_user->updateBoxBooking($id , $box_id);
        
        if ($res->rowCount()) {
            echo 'Se actualizo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }
}
?>