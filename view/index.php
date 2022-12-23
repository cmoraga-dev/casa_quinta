<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script  src="../public/jquery-3.6.2.min.js"></script>
        <script src="../public/js/login-js.js"></script>
    </head>
    <body>
        <h1>Casa Quinta</h1>
        <form action="javascript: validaUsuario()" id="submitValidateUser">
            <div>
                <p>Usuario:</p>
                <input type="text" name="user" id="user">
            </div>
            <div>
                <p>Contraseña:</p>
                <input type="text" name="pass" id="pass">
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </body>
</html>
