<?php

include_once 'db.php';

    class Booking extends DB{

        /** Obtiene una hora por usuario.
         * Devuelte una hora por el usuario que se esta buscando.
         */
        function getBooking($user_id){
            $query = $this->connect()->query("SELECT * FROM bookings WHERE identification_number ='$user_id'");
            return $query;
        }

        /** Obtiene todos las horas
         * Devuelve todas las horas ingresadas en la base de datos.
         */
        function getAllBooking(){
            $query = $this->connect()->query("SELECT * FROM bookings");
            return $query;
        }

        /** Crea una nueva hora.
         * Se crea una hora en base a un usuario/paciente.
         */
        function createBooking($user_id, $dataTime){
            try {
                
                $query = $this->connect()->prepare("INSERT INTO bookings (`user_id`, datatime, confirmed, active) 
                                                    VALUES('$user_id', $dataTime, 0, 0)");
                
                $query->execute();
                return $query;
                
            } catch (PDOException $e) {
                return $e->getMessage();
            }
           
        }

        /** Se borra una hora.
         * Se elimina una hora de reserva por su id.
         */
        function deleteBooking($id){
            $query = $this->connect()->query("DELETE FROM bookings WHERE id = $id");
            return $query;
        }

        /** Se actualiza la confirmacion de hora.
         * Actualiza la hora de reserva por un id y su rut de usuario.
         */
        function updateConfirmBooking($id, $confirm, $id_usuario){
            $query = $this->connect()->query("UPDATE bookings SET confirmed = $confirm, user_id = $id_usuario WHERE id = $id ");
            return $query;
        }

        /** Se actualiza el Box id de la reserva.
         * Actualiza la reserva cuando se tiene un doctor asociado a ese box.
         */
        function updateBoxBooking($id, $box_id){
            $query = $this->connect()->query("UPDATE bookings SET box_id = $box_id WHERE id = $id ");
            return $query;
        }

        /** Se actualiza si esta activa la reserva.
         * Actualiza la actividad de la reserva al momento de que el usuario pase al box.
         */
        function updateActiveBooking($id, $active){
            $query = $this->connect()->query("UPDATE bookings SET active = $active WHERE id = $id ");
            return $query;
        }
    }
?>