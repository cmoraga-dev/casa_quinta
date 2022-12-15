<?php

include_once 'db.php';

    class BoxUser extends DB{

        function getBoxUser($rut){
            $query = $this->connect()->query("SELECT * FROM box_users WHERE identification_number ='$rut'");
            return $query;
        }

        function getAllBoxUsers(){
            $query = $this->connect()->query("SELECT * FROM box_users");
            return $query;
        }

        function createBoxUser($id_account, $first_name, $last_name, $rut, $email){
            try {

                $duplicateKey = $this->connect()->query("SELECT * FROM box_users WHERE id_account ='$id_account'");
                $query = $this->connect()->prepare("INSERT INTO box_users (id_account, first_name, last_name, identification_number, email) 
                                                    VALUES($id_account, '$first_name', '$last_name', $rut, '$email')");
                if($duplicateKey->rowCount() < 1){
                    $query->execute();
                }
                return $query;
                
            } catch (PDOException $e) {
                return $e->getMessage();
            }
           
        }

        function deleteBoxUser($id){
            $query = $this->connect()->query("DELETE FROM box_users WHERE id = $id ");
            return $query;
        }

        function updateBoxUser($id, $first_name, $last_name, $email){
            $query = $this->connect()->query("UPDATE box_users SET first_name = '$first_name', last_name = '$last_name',
                                                email = '$email' WHERE id = $id ");
            return $query;
        }
    }
?>