<?php

include_once 'db.php';

    class User extends DB{

        /** Obtener usuario/paciente.
         * Se obtiene un usuario paciente por su rut.
         */
        function getUser($rut){
            $query = $this->connect()->query("SELECT * FROM `users` WHERE LOWER(identification_number) = LOWER('$rut')");
            return $query;
        }

        /** Obtener todos los usuarios/pacientes.
         * Se obtiene todos los usuarios pacientes que estan ingresados en el sistema.
         */
        function getAllUsers(){
            $query = $this->connect()->query("SELECT * FROM `users`");
            return $query;
        }

        /** Obtiene el usuario/paciente.
         * Se obtiene el id del usuario paciente que esta ingresado en el sistema.
         */
        function getUserByRut($rut){

            // Validamos que el rut exista
            $queryRut = $this->connect()->query("SELECT count(id) as exist FROM `users` WHERE identification_number = '$rut'");

            //extraemos el valor de la query
            $validateRutExist = $queryRut->fetch(PDO::FETCH_ASSOC)["exist"];

            //validamos si es mayor a 0 para extraer el id del rut asociado
            if($validateRutExist > 0){
                $query = $this->connect()->query("SELECT id FROM users WHERE identification_number ='$rut'");
                return $query;
            }

            // Si no existe respondemos un 0
            return $validateRutExist;
        }

        /** Crear un usuario/paciente.
         * Crea un usuario paciente en el sistema pero primero corrobora si no existe.
         */
        function createUser($first_name, $last_name, $rut, $email){
            try {

                $duplicateKey = $this->connect()->query("SELECT * FROM box_users WHERE identification_number ='$rut'");
                $query = $this->connect()->prepare("INSERT INTO `users` (first_name, last_name, identification_number, email, can_book) 
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
            $query = $this->connect()->query("DELETE FROM `users` WHERE id = $id ");
            return $query;
        }

        /** Actualiza un usuario/paciente.
         * Permite actualizar un parametro del usuario paciente, no permite actualizar un rut.
         */
        function updateUser($id, $first_name, $last_name, $email){
            $query = $this->connect()->query("UPDATE `users` SET first_name = '$first_name', last_name = '$last_name',
                                                email = '$email' WHERE id = $id ");
            return $query;
        }
    }
?>