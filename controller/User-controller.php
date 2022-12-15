<?php

include_once __DIR__.'\..\model\User.php';

class User_controller{

    function getAlluser(){
        $user = new User();
        $users = array();
        $users["users"] = array();

        $res = $user->getAllUsers();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "rut" => $row['identification_number'],
                    "email" => $row['email'],
                );
                array_push($users["users"], $item);
            }
            return $this->user = $users;
        } else {
            $this->error = json_encode(array('cod' => '204', 
                                    'msj' => 'Usuario no encontrado'));
        }
    }

    function createUser($first_name, $last_name, $rut ,$email){
        $user = new User();

        $res = $user->createUser($first_name , $last_name, $rut, $email);
        
        if ($res->rowCount()) {
            echo 'Se guardo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro crear el usuario'));
        }
    }

    function deleteUser($id){
        $user = new User();

        $res = $user->deleteUser($id);
        
        if ($res->rowCount()) {
            echo 'Se Elimino Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro eliminar el usuario'));
        }
    }

    
    function updateUser($id , $first_name, $last_name, $email){
        $user = new User();

        $res = $user->updateUser($id , $first_name, $last_name, $email);
        
        if ($res->rowCount()) {
            echo 'Se actualizo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }
}
?>