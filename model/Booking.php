<?php

include_once 'db.php';
include_once __DIR__.'/User.php';

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
        function getAllBooking()
        {
            $query = $this->connect()->query("SELECT * FROM `bookings`");
            return $query;
        }

        /** Obtiene todos las horas confirmadas del dia.
         * Devuelve todas las horas ingresadas en la base de datos que son del dia y que han sido confirmadas
         * esta query es compleja debido a que mantiene join para extraer mas datos.
         */
        function getAllBookingToday()
        {
            $query = $this->connect()->query("SELECT b.id as 'id', datatime,confirmHour, CONCAT(u.first_name,' ' ,u.last_name) as 'full_name'
                                                FROM `bookings` b INNER JOIN `users` u ON b.user_id = u.id 
                                                WHERE confirmed  = 1 AND active = 1 
                                                AND DATE(confirmHour) = DATE(NOW())");
            return $query;
        }

        /** Obtiene todos las horas reservadas por el usuario.
         * Devuelve todas las horas ingresadas en la base de datos.
         */
        function getAllBookingNotConfirmByUser($rut)
        {
            // Si el valor traido es mayor a 0 se ejecuta el metodo para extraer el id
            $query = $this->connect()->query("SELECT b.id as 'id', datatime, CONCAT(u.first_name,' ' ,u.last_name) as 'full_name', u.identification_number as 'rut'
                                                FROM `bookings` b INNER JOIN `users` u ON b.user_id = u.id
                                                WHERE u.identification_number = $rut AND confirmed = 0 AND active = 0
                                                ORDER BY datatime ASC; ");
            return $query;
        }
                
        /** Obtener Dashboard de hoy.
         * Se crea una consulta SQL para recrear los parametros de un dashboard solicitado que debera
         * traer los datos solicitados por el usuario: Nombre de paciente, Hora agendada, Box, Nombre Doctor
         */
        function getDashboardConfirm(){
            $query = $this->connect()->query("SELECT CONCAT(u.first_name,' ' ,u.last_name) as 'full_name_client', datatime, bu.box, 
                                                CONCAT(bu.first_name,' ' ,bu.last_name) as 'full_name_user'
                                                FROM `bookings` b 
                                                INNER JOIN `users` u ON b.user_id = u.id
                                                INNER JOIN `box_users` bu ON b.box_id = bu.id
                                                WHERE DATE(b.confirmHour) = DATE(NOW());");
            return $query;
        }

        /** Crea una nueva hora.
         * Se crea una hora en base a un usuario/paciente.
         */
        function createBooking($user_id, $dataTime){
            try {
                
                $query = $this->connect()->prepare("INSERT INTO bookings (`user_id`, datatime) 
                                                    VALUES($user_id, '$dataTime')");
                
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
         * Actualiza la hora de reserva por un id extraido en base a su rut del usuario.
         */
        function updateConfirmBooking($rut){
            // Se crea una variable de tipo usuario para extraer el metodo que obtiene el id del rut
            $user = new User(); 
            
            // Se instancia el metodo y se extrae el valor traido
            $responseRutByUser = $user->getUserByRut($rut);

            // Si el valor traido es mayor a 0 se ejecuta el metodo para extraer el id
            if($responseRutByUser != 0 ){
                $id_usuario = $user->getUserByRut($rut)->fetch(PDO::FETCH_ASSOC)["id"];
                $query = $this->connect()->query("UPDATE bookings SET confirmed = 1, active = 1, confirmHour = NOW() WHERE `user_id` = $id_usuario AND confirmed = 0");
                return $query;
            }
            return $responseRutByUser;
            
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
