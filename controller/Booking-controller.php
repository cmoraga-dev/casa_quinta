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

    /** Buscar usuario por id.
     * Busca la reserva del usuario por su id y retorna un array con todos los datos de la reserva.
     * @return "mensaje exitosamente o 500 || error servidor"
     */
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

    /** Crea una reserva.
     * Se genera una reserva de hora asociada al usuario paciente.
     * Se espera recibir el "id usuario" y la "fecha de la reserva".
     * @return "mensaje exitosamente o 500 || error servidor"
     */
    function createBookingUser($id_account,$fechaReserva ){
        $box_user = new Booking();

        $res = $box_user->createBooking($id_account, $fechaReserva );
        
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

    /** Actualiza confirmacion reserva.
     * Se actualiza la confirmacion de la reserva a travez del rut al momento de digitarlo.
     * @return "mensaje exitosamente o 500 || error servidor"
     */
    function updateConfirmBooking($rut ){
        $box_user = new Booking();
        $res = $box_user->updateConfirmBooking($rut );
        $response = [];
        if($res != 0){
            if ($res->rowCount()) {
                $response = [ "code"=>202, "def"=> "Usuario confirmado con exito" ];
                echo json_encode ($response);
                return;
            }else{
                echo json_encode(array('cod' => '500', 
                                        'msj' => 'No se logro actualizar el parametro indicado',
                                        'server' => $res));
                return;
            }
        }
        $response = [ "code"=>404, "def"=> "Usuario no encontrado" ];
        echo json_encode ($response);
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