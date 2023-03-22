<?php

include_once 'db.php';

    class Account extends DB{

        /** Validar Usuario.
         * Funcion para obtener una cuenta a travez de las variables indicadas, deben ser tipo string para su guardado y encriptada la clave.
         */
        function getAccount($name, $pass){
            $query = $this->connect()->query("SELECT * FROM accounts WHERE user_name ='$name' AND pass ='$pass'");
            return $query;
        }

        /** Obtiene todos los usuarios.
         * Devuelve todos los usuarios y sus datos.
         */
        function getAllAccount(){
            $query = $this->connect()->query("SELECT a.*, b.type_privilege as profile_type FROM accounts a
                JOIN privileges b on a.id_type_profile = b.id");
            return $query;
        }

        
        /** Obtiene el usuario por nombre.
         * Devuelve el usuario buscado y sus datos.
         */
        function getByUserAccount($user){
            $query = $this->connect()->query("SELECT * FROM accounts WHERE user_name = $user");
            return $query;
        }

        /** Crear Cuenta.
         * Funcion para crear cuenta para el acceso al sistema, las cuentas estan asociadas a un tipo de perfil con un rol de acceso.
         */
        function createAccount($name, $pass, $first_name, $last_name, $rut, $email){
            try {

                $duplicateKey = $this->connect()->query("SELECT * FROM accounts WHERE user_name ='$name'");
                $query = $this->connect()->prepare("INSERT INTO accounts (id_type_profile, user_name, pass) VALUES(2, '$name', '$pass')");                
                if($duplicateKey->rowCount() < 1){      
                    $query->execute();

                    // obtenemos el ultimo usuario creado para asi obtener el id recien creado.
                    $queryLast_id = $this->connect()->query("SELECT id FROM `accounts` ORDER BY `accounts`.`id` desc  limit 1");

                    // lo sacamos con el fecth
                    $row_lastId = $queryLast_id->fetch(PDO::FETCH_ASSOC);
                   
                    // se lo agregamos a la variable
                    $last_id = $row_lastId['id'];

                    //Luego de obtener el id, debemos agregarlo al nuevo usuario de box.
                    $query2 = $this->connect()->prepare("INSERT INTO box_users (id_account, first_name, last_name, identification_number, email) 
                                                         VALUES($last_id, '$first_name', '$last_name', $rut, '$email')");
                
                }
                return $last_id;
                
            } catch (PDOException $e) {
                return $e->getMessage();
            }
           
        }

        /** Borrar una cuenta.
         * Elimina una cuenta asociada a un id unico en el sistema.
         */
        function deleteAccount($idAccount){
            $query = $this->connect()->query("DELETE FROM accounts WHERE id = $idAccount ");
            return $query;
        }

        /** Actualizar Clave.
         * Actualiza la contrasena de una cuenta asociada a un id unico, este parametro debe llegar encriptado y de tipo string.
         */
        function updateAccountPassword($idAccount, $pass){
            $query = $this->connect()->query("UPDATE accounts SET pass = '$pass' WHERE id = $idAccount");
            return $query;
        }

        /** Actualizar Nombre.
         */
        function updateAccountName($idAccount, $name){
            $query = $this->connect()->query("UPDATE accounts SET alias = '$name' WHERE id = $idAccount");
            return $query;
        }


        /** Actualizar Perfil.
         * Actualiza el tipo de perfil de la cuenta para aumentar o quitar los acceso al usuario seleccionado.
         */
        function updateAccountProfile($idAccount, $id_typeProfile){
            $query = $this->connect()->query("UPDATE accounts SET id_type_profile = $id_typeProfile WHERE id = $idAccount ");
            return $query;
        }
    }

?>