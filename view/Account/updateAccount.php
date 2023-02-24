<?php
require_once __DIR__.'/../../controller/Account-controller.php';

session_start();
$api = new Account_controller();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //if ($_POST['pass'] != ""){
    //    $api->updatePassAccount($_POST['idAccount'],$_POST['pass']);
    // }
    if (isset($_POST['name'])){
        $api->updateNameAccount(intval($_POST['idAccount']),$_POST['name']);
    }else{
        echo 'AAAAA';
    }
}
?>