<?php
    include("../login/validateBoxLoginUser.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script  src="../../public/jquery-3.6.2.min.js"></script>
        <script src="../../public/js/login-js.js"></script>
    </head>
    <body>
        <h1>Casa Quinta</h1>
        <form action="javascript: updateBox()" id="submitValidateUser">
            <div>
                <p>Ingrese numero del box:</p>
                <input type="text" id="box-num">
            </div>
            <div>
                <input type="submit" value="Confirmar">
            </div>
        </form>
    </body>
</html>
