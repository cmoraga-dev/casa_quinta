<?php

include_once __DIR__.'\..\model\BoxUser.php';

class BoxUser_controller{

    function getAllBoxuser(){
        $box_user = new BoxUser();
        $box_users = array();
        $box_users["Users"] = array();

        $res = $box_user->getAllBoxUsers();

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "id_account" => $row['id_account'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "rut" => $row['identification_number'],
                    "email" => $row['email'],
                );
                array_push($box_users["Users"], $item);
            }
            return $this->boxUser = $box_users;
        } else {
            $this->error = json_encode(array('cod' => '204', 
                                    'msj' => 'Usuario de box no encontrado'));
        }
    }

    function createBoxUser($id_account,$first_name , $last_name, $rut ,$email){
        $box_user = new BoxUser();

        $res = $box_user->createBoxUser($id_account, $first_name , $last_name, $rut, $email);
        
        if ($res->rowCount()) {
            echo 'Se guardo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro crear el usuario del box'));
        }
    }

    function deleteBoxUser($id){
        $box_user = new BoxUser();

        $res = $box_user->deleteBoxUser($id);
        
        if ($res->rowCount()) {
            echo 'Se Elimino Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro eliminar al usuario del box'));
        }
    }

    
    function updateBoxUser($id , $first_name, $last_name, $email){
        $box_user = new BoxUser();

        $res = $box_user->updateBoxUser($id , $first_name, $last_name, $email);
        
        if ($res->rowCount()) {
            echo 'Se guardo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }
}
?>