

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script  src="public/jquery-3.6.2.min.js"></script>
        <script src="public/js/jquery.Rut.js"></script>
        <script src="public/js/home-js.js"></script>
        <script src="../public/js/jquery.Rut.js"></script>

    </head>
    <body>
        <h1>Confirmar Hora</h1>
        <form action="javascript: confirmHour()" id="confirmHours">
            <div>
                <h2>Ingreso de paciente</h2>
            </div>
            <div>
                <input type="text" name="user" id="rutUser" required>
                <p>Digitar Rut por favor</p>
            </div>
            <div>
                <input type="submit" value="Confirmar">
            </div>
        </form>
    </body>
</html>
