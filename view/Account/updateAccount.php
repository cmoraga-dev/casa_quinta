<?php
require_once __DIR__.'/../../controller/Account-controller.php';

session_start();
$api = new Account_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if ($_POST['pass'] != false){
        $api->updatePassAccount($_POST['idAccount'],$_POST['pass']);
    }
    if ($_POST['name'] != false){
        $api->updateNameAccount($_POST['idAccount'],$_POST['name']);
    }
}
?>