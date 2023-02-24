<?php
require_once __DIR__.'/../../controller/Account-controller.php';

$api = new Account_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if ($_POST['pass']){
        $api->updatePassAccount($_POST['idAccount'],$_POST['pass']);
    }
    if ($_POST['alias']){
    $api->updateNameAccount($_POST['idAccount'],$_POST['pass']);
    }
}
?>