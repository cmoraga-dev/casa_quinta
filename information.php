<?php

if ($_POST['arg1'] == null) {
    echo '<script>location.href = "/casa_quinta"</script>';
    return;
}

$res = $_POST['arg1'];

if ($res == '202') {
    echo '
    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8">
        <script src="public/jquery-3.6.2.min.js"></script>
        <script src="public/js/information.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Informacion</title>
    </head>
    <body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h1>Su hora ha sido confirmada</h1>
                        <p>Por favor, esperar pacientemente su hora de llamada.
                        </p>
                        <p>En nuestro panel de información verá el BOX al cual será llamado/a.</p>
                        <button id="btn-back" class="btn btn-primary btn-lg btn-block">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    
    </html>';
    return;
} else {
    echo '
    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8">
        <script src="public/jquery-3.6.2.min.js"></script>
        <script src="public/js/information.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Informacion</title>
    </head>
    <body>
        <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h1>No se ha podido confirmar su hora</h1>
                        <p>Por favor validar que los datos ingresados sean correctos.
                        </p>
                        <button id="btn-back" class="btn btn-primary btn-lg btn-block">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>';
    return;
}

?>
