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
    function getAllBookingToday()
    {
        $booking = new Booking();
        $bookings = array();
        $bookings["bookings"] = array();

        $res = $booking->getAllBookingToday();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "full_name_user" => $row['full_name'],
                    "datatime_booking" => $row['datatime'],
                    "datatime_confirmed" => $row['confirmHour'],
                    "id_box_user" => $row['box_id'],
                    "active" => $row['active']
                );
                array_push($bookings["bookings"], $item);
            }
            echo json_encode(array(
                'cod' => '202',
                'def' => 'Reservas obtenidas con exito',
                'server' => $bookings
            ));
            return;
        } else {
            echo json_encode(array(
                'cod' => '404',
                'def' => 'Reserva no encontrada'
            ));
            return;
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

    /** Busca todas las reservas del usuario no confirmadas.
     * Se busca por rut del usuario todas sus reservas que tiene sin confirmar y extrae esa informacion para mostrarla en pantalla.
     * @return "202 || confirmado con exito , 404 || error no encontrado o 500 || error servidor" 
     */
    function getAllBookingNotConfirmByUser($rut){
        $box_user = new Booking();       
        $bookibngs = array();
        $bookibngs["bookings"] = array();

        $res = $box_user->getAllBookingNotConfirmByUser( $rut );
        
        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "datatime" => $row['datatime'],
                    "full_name" => $row['full_name'],
                    "rut" => $row['rut']
                );
                array_push($bookibngs["bookings"], $item);
            }
            echo json_encode(array('cod' => '202', 
                                    'def' => 'Reservas obtenidas con exito',
                                    'server' => $bookibngs));
            return;
        } else {
            echo json_encode(array('cod' => '404', 
                                    'def' => 'Reserva no encontrada'));
            return;
        }
        echo json_encode(array('cod' => '500', 
                                'def' => 'Problemas con el servidor',
                                'server' => $res));
        return;
    }

    /** Busca todas las reservas de los usuarios confirmados.
     * Se busca todas sus reservas que tienen su hora confirmada y extrae esa informacion para mostrarla en pantalla.
     * @return "202 || confirmado con exito , 404 || error no encontrado o 500 || error servidor" 
     */
    function getAllBookingDashboard(){
        $box_user = new Booking();       
        $bookibngs = array();
        $bookibngs["bookings"] = array();

        $res = $box_user->getDashboardConfirm( );
        
        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "full_name_account" => $row['full_name_account'],
                    "datatime" => $row['datatime'],
                    "box_num" => $row['box'],
                    "full_name_patient" => $row['full_name_patient']
                );
                array_push($bookibngs["bookings"], $item);
            }
            echo json_encode(array('cod' => '202', 
                                    'def' => 'Reservas obtenidas con exito',
                                    'server' => $bookibngs));
            return;
        } else {
            echo json_encode(array('cod' => '404', 
                                    'def' => 'Reserva no encontrada'));
            return;
        }
        echo json_encode(array('cod' => '500', 
                                'def' => 'Problemas con el servidor',
                                'server' => $res));
        return;
    }
    

    /** Crea una reserva.
     * Se genera una reserva de hora asociada al usuario paciente.
     * Se espera recibir el "id usuario" y la "fecha de la reserva".
     * @return "mensaje exitosamente o 500 || error servidor"
     */
    function createBookingUser($id_account,$fechaReserva ){
        $box_user = new Booking();

        //$id_account = str_replace('+','',$id_account);

        $res = $box_user->createBooking($id_account, $fechaReserva );
        
        if ($res->rowCount()) {
            echo json_encode(array('cod' => '202', 
            'def' => 'Usuario confirmado con éxito'));

        }else{
            echo json_encode(array('cod' => '500', 
                                    'def' => 'No se logró crear el booking'.$id_account.$fechaReserva));
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

    /** Actualiza el box id del booking.
     * Se actualiza el box id que esta asociado al doctor que llama al paciente, donde se le envia
     * el id_box junto con el id del booking para su asociacion al id del doctor.
     * @return "202 || confirmado con exito , 404 || error no encontrado o 500 || error servidor" 
     */
    function updateBoxBooking($id , $box_id){
        $box_user = new Booking();

        $res = $box_user->updateBoxBooking($id , $box_id);
        
        if ($res->rowCount()) {
            echo json_encode(array('cod' => '202', 
                                     'def' => 'Box actualizado con exito'));
                return;
        }else{
            echo json_encode(array('cod' => '500', 
                                    'def' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }
}
?>