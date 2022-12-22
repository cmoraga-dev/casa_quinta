<?php

include_once __DIR__.'/../model/Booking.php';

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
                                    'def' => 'Booking no encontrado'));
        }
    }

    /** Obtener las reservas del dia.
     * Busca todas las reservas del dia y que estan confirmadas en el dia de la consulta por ejemplo :
     * Todas las de hoy 21/12/2022 y estan confirmadas.
     * @return "202 || extraido con exito , 404 || error no encontrado o 500 || error servidor" 
     */
    function getAllBookingToday(){
        $bookibng = new Booking();
        $bookibngs = array();
        $bookibngs["bookings"] = array();

        $res = $bookibng->getAllBooking();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "full_name_user" => $row['full_name'],
                    "datatime_booking" => $row['datatime'],
                    "datatime_confirmed" => $row['confirmHour']
                );
                array_push($bookibngs["bookings"], $item);
            }
            return $this->boxUser = $bookibngs;
        } else {
            $this->error = json_encode(array('cod' => '204', 
                                    'def' => 'Booking no encontrado'));
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
                                    'def' => 'Usuario de booking no encontrado'));
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
                                    'def' => 'No se logro crear el booking'));
        }
    }

    function deleteBooking($id){
        $box_user = new Booking();

        $res = $box_user->deleteBooking($id);
        
        if ($res->rowCount()) {
            echo 'Se Elimino Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'def' => 'No se logro eliminar el booking'));
        }
    }

    /** Actualiza confirmacion reserva.
     * Se actualiza la confirmacion de la reserva a travez del rut al momento de digitarlo.
     * @return "202 || confirmado con exito , 404 || error no encontrado o 500 || error servidor" 
     */
    function updateConfirmBooking($rut ){
        $box_user = new Booking();
        $res = $box_user->updateConfirmBooking($rut );
        
        if($res != 0){
            if ($res->rowCount()) {
                echo json_encode(array('cod' => '202', 
                                     'def' => 'Usuario confirmado con exito'));
                return;
            }else{
                echo json_encode(array('cod' => '500', 
                                        'def' => 'No se logro actualizar el parametro indicado',
                                        'server' => $res));
                return;
            }
        }
        echo json_encode(array('cod' => '404', 
                                     'def' => 'Usuario no encontrado'));
    }

    function updateActiveBooking($id , $active ){
        $box_user = new Booking();

        $res = $box_user->updateActiveBooking($id , $active );
        
        if ($res->rowCount()) {
            echo 'Se actualizo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'def' => 'No se logro actualizar el parametro indicado',
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
                                    'def' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }
}
?>