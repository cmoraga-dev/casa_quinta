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

         /** Obtener usuario de Box por Rut.
         * Busca el numero del box del usuario indicado por id de cuenta.
         */
        function getNumberBoxUser($id_account){
            $query = $this->connect()->query("SELECT ifnull(`box`,0) FROM box_users WHERE id_account ='$id_account'");
            return $query;
        }
        
        /** Obtiene todos los usuarios de los Box.
         * Devuelve todos los usuarios de Box y sus datos.
         */
        function getAllBoxUsers(){
            $query = $this->connect()->query("SELECT * FROM box_users");
            return $query;
        }

        /** Obtiene el numero del box del usuario doctor.
         * Devuelve todos los usuarios de Box y sus datos, se debe enviar el id de la cuenta del doctor.
         */
        function getBox($id){
            $query = $this->connect()->query("SELECT id, `box` FROM box_users where id_account = $id");
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

        /** Actualiza el parametro box del usuario de Box.
         * Actualiza el parametro box del usuario por su id.
         */
        function updateBoxLoginUser($id, $box_num){
            $query = $this->connect()->query("UPDATE box_users SET `box` = '$box_num'  WHERE id_account = $id ");
            return $query;
        }
        
    }
?>