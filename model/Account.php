<?php

include_once 'db.php';

    class Account extends DB{

        function getAccount($name, $pass){
            $query = $this->connect()->query("SELECT * FROM accounts WHERE usser_name ='$name' AND pass ='$pass'");
            return $query;
        }

        function getAllAccount(){
            $query = $this->connect()->query("SELECT * FROM accounts");
            return $query;
        }

        function createAccount($name, $pass, $id_typeProfile){
            try {

                $duplicateKey = $this->connect()->query("SELECT * FROM accounts WHERE usser_name ='$name'");
                $query = $this->connect()->prepare("INSERT INTO accounts (id_type_profile, usser_name, pass) VALUES($id_typeProfile, '$name', '$pass')");
                if($duplicateKey->rowCount() < 1){
                    $query->execute();
                }
                return $query;
                
            } catch (PDOException $e) {
                return $e->getMessage();
            }
           
        }

        function deleteAccount($idAccount){
            $query = $this->connect()->query("DELETE FROM accounts WHERE id = $idAccount ");
            return $query;
        }

        function updateAccountPassword($idAccount, $pass){
            $query = $this->connect()->query("UPDATE accounts SET pass = '$pass' WHERE id = $idAccount ");
            return $query;
        }

        function updateAccountProfile($idAccount, $id_typeProfile){
            $query = $this->connect()->query("UPDATE accounts SET id_type_profile = $id_typeProfile WHERE id = $idAccount ");
            return $query;
        }
    }

?>