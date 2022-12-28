<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Confirmar Hora</title>
    <script src="public/jquery-3.6.2.min.js"></script>
    <script src="public/js/jquery.Rut.js"></script>
    <script src="public/js/home-js.js"></script>
    <link rel="stylesheet" href="public/css/home-css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <div class="div-content">
            <h1 class="text-confirm">Confirmar Hora</h1>
        </div>
        <form action="javascript: confirmHour()" id="confirmHours">
            <div>
                <input type="text" name="user" id="rutUser" required class="rut-screen z-depth-1" placeholder="20.833.673‑8">
            </div>

            <div class="enum-keys">
                <button type="button" value="7" class="btn btn-light waves-effect" id="btn-num">7</button>
                <button type="button" value="8" class="btn btn-light waves-effect" id="btn-num">8</button>
                <button type="button" value="9" class="btn btn-light waves-effect" id="btn-num">9</button>
                


                <button type="button" value="4" class="btn btn-light waves-effect" id="btn-num">4</button>
                <button type="button" value="5" class="btn btn-light waves-effect" id="btn-num">5</button>
                <button type="button" value="6" class="btn btn-light waves-effect" id="btn-num">6</button>


                <button type="button" value="1" class="btn btn-light waves-effect" id="btn-num">1</button>
                <button type="button" value="2" class="btn btn-light waves-effect" id="btn-num">2</button>
                <button type="button" value="3" class="btn btn-light waves-effect" id="btn-num">3</button>

                <button type="button" value="Borrar" class="btn btn-danger" id="btn-del">Borrar</button>
                <button type="button" value="0" class="btn btn-light waves-effect" id="btn-num">0</button>
                <button type="submit" value="Confirmar" class="btn btn-primary">Confirmar</button>

            </div>
        </form>
    </div>
</body>

</html>