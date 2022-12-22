<?php

include_once __DIR__.'/../model/Account.php';

class Account_controller{

    /** Obtiene el usuario.
     *  Consulta al modelo de cuentas si el usuario con la contrasena enviada existe, devolviendo una query para extraer sus datos.
     * @return "202 || login exitoso , 204 || error usuario no existe o contrasena"
     */
    function getAccount($name , $pass){
        $user = new Account();
        $users = array();
        $users = array();

        // Encriptamos la password que nos llega.
        $passEncryp  = hash('sha512',$pass);


        $res = $user->getAccount($name, $passEncryp);

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "account" => $row['usser_name'],
                    "id_type_profile" => $row['id_type_profile'],
                );
                array_push($users, $item);
            }

            // iniciamos la session
            session_start();

            // guardamos el nombre de usuario como session name
            $_SESSION['user'] = $users[0]["account"];
            $_SESSION["user_profile"] = $users[0]["id_type_profile"];
            $_SESSION["id"] = $users[0]["id"];
            

            echo json_encode(array('cod' => '202', 
                                    'def' => 'Obtenido con exito'));
            return;
        } else {
            echo json_encode(array('cod' => '404',
                                    'def' => 'Usuario o contraseña incorrecto'));
            return;
        }
        echo json_encode(array('cod' => '500', 
                                'def' => 'Error por parte del servidor',
                                'server'=> $res));
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