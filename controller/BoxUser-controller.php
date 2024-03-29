<?php

include_once __DIR__.'/../model/BoxUser.php';

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
                                    'def' => 'Usuario de box no encontrado'));
        }
    }

    function getBoxuser($rut){
        $box_user = new BoxUser();
        $box_users = array();
        $box_users["Users"] = array();

        $res = $box_user->getBoxuser($rut);

        if ($res->rowCount()) {
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "id_account" => $row['id_account'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "rut" => $row['identification_number'],
                    "email" => $row['email'],
                    "box_num" =>$row['box'],
                );
                array_push($box_users["Users"], $item);
            }
            return $this->boxUser = $box_users;
        } else {
            $this->error = json_encode(array('cod' => '500', 
                                    'def' => 'Usuario de box no encontrado'));
        }
    }

    function createBoxUser($id_account,$first_name , $last_name, $rut ,$email){
        $box_user = new BoxUser();

        $res = $box_user->createBoxUser($id_account, $first_name , $last_name, $rut, $email);
        
        if ($res->rowCount()) {
            echo 'Se guardo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'def' => 'No se logro crear el usuario del box'));
        }
    }

    function deleteBoxUser($id){
        $box_user = new BoxUser();

        $res = $box_user->deleteBoxUser($id);
        
        if ($res->rowCount()) {
            echo 'Se Elimino Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'def' => 'No se logro eliminar al usuario del box'));
        }
    }

    /** Actualizar paramatros del usuario del box.
     * Se actualiza los parametros del doctor que son los usuarios de box, permite actualizar
     * todo menos su rut y su cuenta.
     * @return "202 || confirmado con exito , 404 || error no encontrado o 500 || error servidor" 
     */
    function updateBoxUser($id , $first_name, $last_name, $email){
        $box_user = new BoxUser();

        $res = $box_user->updateBoxUser($id , $first_name, $last_name, $email);
        
        if ($res->rowCount()) {
            echo 'Se guardo Existosamente';
        }else{
            echo json_encode(array('cod' => '500', 
                                    'def' => 'No se logro actualizar el parametro indicado',
                                    'server' => $res));
        }
    }

    /** Actualizar paramatros box del usuario del box.
     * Se actualiza el parametros box del doctor que son los usuarios de box, esto se 
     * actualiza siempre que haga login el usuario del box , indicando su box actual, pasando su id de box user.
     * @return "202 || confirmado con exito , 404 || error no encontrado o 500 || error servidor" 
     */
    function updateBoxLoginUser($id_account , $box_num){
        $box_user = new BoxUser();
        $box_users = array();

        // Actualiza el box del doctor.
        $res = $box_user->updateBoxLoginUser($id_account , $box_num);

        // Extrae el numero del box que encontro.
        $res2 = $box_user->getBox($id_account);

        // Validamos si se actualizo un parametro del res (update del box).
        if ($res->rowCount()) {
            while ($row = $res2->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "box_user" => $row['box']
                );
                array_push($box_users, $item);
            }
            // guardamos el nombre de usuario como box_user_login.
            $_SESSION['box_user_login'] = $box_users[0]["box_user"];
            $_SESSION['id_box_user'] = $box_users[0]["id"];

            echo json_encode(array('cod' => '202', 
                                    'def' => 'Obtenido con exito'));
            return;
        }else{
            
            // En caso que no actualice el parametro, validamos si existe un box asginado al doctor. 
            if ($res2->rowCount()) {
                while ($row = $res2->fetch(PDO::FETCH_ASSOC)) {
                    $item = array(
                        "id" => $row['id'],
                        "box_user" => $row['box']
                    );
                    array_push($box_users, $item);
                }
                
                // Validamos que el box que quiere asignar ya esta asignado al doctor.
                // En caso de ser asi se responed con error 202 que es todo ok.
                if($box_users[0]["box_user"] == $box_num){

                    // guardamos el nombre de usuario como box_user_login.
                    $_SESSION['box_user_login'] = $box_users[0]["box_user"];
                    $_SESSION['id_box_user'] = $box_users[0]["id"];
        
                    echo json_encode(array('cod' => '202', 
                                            'def' => 'Obtenido con exito'));
                    return;
                }
            }

            // Si no error 404 dato incorrecto
            echo json_encode(array('cod' => '404',
                                    'def' => 'Un dato es incorrecto'));
            return;
        }
        echo json_encode(array('cod' => '500', 
                                'def' => 'Error por parte del servidor',
                                'server'=> $res));
    }
}
?>