<?php

include_once 'db.php';

    class Booking extends DB{

        function getBooking($user_id){
            $query = $this->connect()->query("SELECT * FROM bookings WHERE identification_number ='$user_id'");
            return $query;
        }

        function getAllBooking(){
            $query = $this->connect()->query("SELECT * FROM bookings");
            return $query;
        }

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

        function deleteBooking($id){
            $query = $this->connect()->query("DELETE FROM bookings WHERE id = $id ");
            return $query;
        }

        function updateConfirmBooking($id, $confirm){
            $query = $this->connect()->query("UPDATE bookings SET confirmed = $confirm WHERE id = $id ");
            return $query;
        }

        function updateBoxBooking($id, $box_id){
            $query = $this->connect()->query("UPDATE bookings SET box_id = $box_id WHERE id = $id ");
            return $query;
        }

        function updateActiveBooking($id, $active){
            $query = $this->connect()->query("UPDATE bookings SET active = $active WHERE id = $id ");
            return $query;
        }
    }
?>