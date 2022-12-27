<?php
    $res = $_POST['arg1'];

if($res == '202'){
    echo '
    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8">
        <script src="public/jquery-3.6.2.min.js"></script>
        <script src="public/js/information.js"></script>
        <title>Informacion</title>
    </head>
    <div>
        <h1>Su hora ha sido confirmada</h1>
        <p>Por favor, esperar pacientemente su hora de llamada.
        </p>
        <p>En nuestro panel de informacion vera el BOX al cual sera llamado/a</p>
        <button id="btn-back">Volver</button>
    </div>
    
    </html>';
    return;
}else{
    echo '
    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8">
        <script src="public/jquery-3.6.2.min.js"></script>
        <script src="public/js/information.js"></script>
        <title>Informacion</title>
    </head>
    <div>
        <h1>NO se ha podido confirmada su hora</h1>
        <p>Por favor validar que su RUT este bien digitado.
        </p>
        <p>o que posea una Reserva activa.</p>
        <button id="btn-back">Volver</button>
    </div>
    
    </html>';
    return;
}

?>