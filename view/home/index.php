<?php
    include("../login/validateSession.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="../../public/js/home-index-js.js"></script> 
        <script  src="../../public/jquery-3.6.2.min.js"></script>       
    </head>
    <body>
        <div class="header">
        <button type="button" onclick="javascript:goToHome();">Home</button>
            <h1><?= $_SESSION["user"]?></h1>
            <button type="button" onclick="javascript:logOut();">Cerrar Sesion</button>
        </div>
        <div>
            <h3>Pacientes en espera</h3>
            <table id="tableBookingConfirm">
                <thead>
                    <tr>
                        <th>Nombre de paciente</th>
                        <th>Hora agendada</th>
                        <th>Hora Llegada</th>
                    </tr>
                </thead>
                <tbody id = "tbodyConfirm">
                    <tr>
                        <td> Sin datos </td>
                        <td> Sin datos </td>
                        <td> Sin datos </td>
                        <td> <input type="button" value="Llamar" disabled> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div></div>
    </body>
</html>