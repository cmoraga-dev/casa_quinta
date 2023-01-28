<?php

include_once __DIR__.'/../model/User.php';

class User_controller{

    function getAlluser(){
        $userModel = new User();
        $users = array();
        $users["users"] = array();

        $res = $userModel->getAllUsers();

        if ($res->rowCount()) {
            $this->error = json_encode(array('cod' => '204', 
                                    'msj' => 'Prueba.'));
        
    
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
                                    'msj' => 'Sin usuarios en el sistema.'));
        }
    }

    
    function getUser($rut){
        $user = new User();
        $users = array();
        $users["users"] = array();

        $res = $user->getUser($rut);

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
            $this->error = json_encode(array('cod' => '500', 
                                    'msj' => 'Usuario no encontrado'));
        }
    }

    /** Crear usuario/paciente.
     * Crea un usuario enviando la solicitud a la base de datos, enviando los parametros de:
     * @return "mensaje exitosamente o 505 || error servidor"
     */
    function createUser($first_name, $last_name, $rut ,$email){
        $user = new User();

        $res = $user->createUser($first_name , $last_name, $rut, $email);
        
        if ($res->rowCount()) {
            echo 'Se guardó Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logró crear el usuario'));
        }
    }

    function deleteUser($id){
        $user = new User();

        $res = $user->deleteUser($id);
        
        if ($res->rowCount()) {
            echo 'Se eliminó existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logró eliminar el usuario'));
        }
    }

    
    function updateUser($id , $first_name, $last_name, $email){
        $user = new User();

        $res = $user->updateUser($id , $first_name, $last_name, $email);
        
        if ($res->rowCount()) {
            echo 'Se actualizó existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'msj' => 'No se logró actualizar el parámetro indicado',
                                    'server' => $res));
        }
    }
}
?>