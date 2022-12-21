<?php

include_once __DIR__.'/../model/Account.php';

class Account_controller{

    function getAccount($name , $pass){
        $user = new Account();
        $users = array();
        $users["users"] = array();

        $res = $user->getAccount($name, $pass);

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "account" => $row['usser_name'],
                    "pass" => $row['pass'],
                );
                array_push($users["users"], $item);
            }
            return $this->user = $users;
        } else {
            $this->error = json_encode(array('cod' => '204', 
                                    'msj' => 'Usuario o contraseña incorrecto'));
        }
    }

    function getByUserAccount($name){
        $user = new Account();
        $users = array();
        $users["users"] = array();

        $res = $user->getByUserAccount($name);

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "account" => $row['usser_name'],
                    "pass" => $row['pass'],
                );
                array_push($users["users"], $item);
            }
            return $this->user = $users;
        } else {
            $this->error = json_encode(array('cod' => '204', 
                                    'msj' => 'Usuario o contraseña incorrecto'));
        }
    }

    function getAllAcount(){
        $user = new Account();
        $users = array();
        $users["users"] = array();

        $res = $user->getAllAccount();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "account" => $row['usser_name'],
                    "pass" => $row['pass'],
                );
                array_push($users["users"], $item);
            }
            return $this->user = $users;
        } else {
            $this->error = json_encode(array('cod' => '500',
                                    'msj' => 'Usuarios incorrecto'));
        }
    }

    function createAccount($name , $pass, $id_type_profile){
        try {
            $user = new Account();

            $res = $user->createAccount($name , $pass, $id_type_profile);
            
            if ($res->rowCount()) {
                echo 'Se guardo Existosamente';
            }else{
                echo json_encode(array('cod' => '500', 
                                        'msj' => 'No se logro crear el usuario'));
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        
    }

    function deleteAccount($idAccount){
        $user = new Account();

        $res = $user->deleteAccount($idAccount);
        
        if ($res->rowCount()) {
            echo 'Se Elimino Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro eliminar el usuario'));
        }
    }

    
    function updatePassAccount($idAccount , $pass){
        $user = new Account();

        $res = $user->updateAccountPassword($idAccount , $pass);
        
        if ($res->rowCount()) {
            echo 'Se actualizo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro actualizar la clave del usuario',
                                    'server' => $res));
        }
    }

    function updateProfileAccount($idAccount , $id_type_profile){
        $user = new Account();

        $res = $user->updateAccountProfile($idAccount , $id_type_profile);
        
        if ($res->rowCount()) {
            echo 'Se actualizo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro actualizar el perfil del usuario'));
        }
    }
}
?>