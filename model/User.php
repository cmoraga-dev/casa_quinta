<?php

include_once 'db.php';

    class User extends DB{

        /** Obtener usuario/paciente.
         * Se obtiene un usuario paciente por su rut.
         */
        function getUser($rut){
            $query = $this->connect()->query("SELECT * FROM users WHERE identification_number ='$rut'");
            return $query;
        }

        /** Obtener todos los usuarios/pacientes.
         * Se obtiene todos los usuarios pacientes que estan ingresados en el sistema.
         */
        function getAllUsers(){
            $query = $this->connect()->query("SELECT * FROM users");
            return $query;
        }

        /** Crear un usuario/paciente.
         * Crea un usuario paciente en el sistema.
         */
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

        /** Elimina un usuario/paciente.
         * Elimina un usuario paciente por su id.
         */
        function deleteUser($id){
            $query = $this->connect()->query("DELETE FROM users WHERE id = $id ");
            return $query;
        }

        /** Actualiza un usuario/paciente.
         * Permite actualizar un parametro del usuario paciente, no permite actualizar un rut.
         */
        function updateUser($id, $first_name, $last_name, $email){
            $query = $this->connect()->query("UPDATE users SET first_name = '$first_name', last_name = '$last_name',
                                                email = '$email' WHERE id = $id ");
            return $query;
        }
    }
?>