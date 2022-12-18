<?php

include_once 'db.php';

    class BoxUser extends DB{

        /** Obtener usuario de Box por Rut.
         * Busca el usuario por rut ingresado y devuelve todo sus datos.
         */
        function getBoxUser($rut){
            $query = $this->connect()->query("SELECT * FROM box_users WHERE identification_number ='$rut'");
            return $query;
        }

        /** Obtiene todos los usuarios de los Box.
         * Devuelve todos los usuarios de Box y sus datos.
         */
        function getAllBoxUsers(){
            $query = $this->connect()->query("SELECT * FROM box_users");
            return $query;
        }

        /** Crear un usuario de Box.
         * Se crea un usuario para el box, donde se debe tener registrado un tipo de cuenta.
         */
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

        /** Elimina un usuario de Box.
         * Se elimina un usuario de Box por su id.
         */
        function deleteBoxUser($id){
            $query = $this->connect()->query("DELETE FROM box_users WHERE id = $id ");
            return $query;
        }

        /** Actualiza un parametro del usuario de Box.
         * Actualiza un parametro del usuario por su id, donde puede variar su variable pero nunca su rut.
         */
        function updateBoxUser($id, $first_name, $last_name, $email){
            $query = $this->connect()->query("UPDATE box_users SET first_name = '$first_name', last_name = '$last_name',
                                                email = '$email' WHERE id = $id ");
            return $query;
        }
    }
?>