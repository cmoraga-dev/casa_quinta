<?php

include_once 'db.php';

    class User extends DB{

        function getUser($rut){
            $query = $this->connect()->query("SELECT * FROM users WHERE identification_number ='$rut'");
            return $query;
        }

        function getAllUsers(){
            $query = $this->connect()->query("SELECT * FROM users");
            return $query;
        }

        function createUser($first_name, $last_name, $rut, $email){
            try {

                $duplicateKey = $this->connect()->query("SELECT * FROM box_users WHERE id_account ='$rut'");
                $query = $this->connect()->prepare("INSERT INTO users (first_name, last_name, identification_number, email, can_book) 
                                                    VALUES('$first_name', '$last_name', '$rut', '$email', 0)");
                if($duplicateKey->rowCount() < 1){
                    $query->execute();
                }
                return $query;
                
            } catch (PDOException $e) {
                return $e->getMessage();
            }
           
        }

        function deleteUser($id){
            $query = $this->connect()->query("DELETE FROM users WHERE id = $id ");
            return $query;
        }

        function updateUser($id, $first_name, $last_name, $email){
            $query = $this->connect()->query("UPDATE users SET first_name = '$first_name', last_name = '$last_name',
                                                email = '$email' WHERE id = $id ");
            return $query;
        }
    }
?>