<?php
include("../login/validateSession.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="../../public/js/bookingsManager.js"></script>
    <script>
$( function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Crear agendamiento": function() {},
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      //addUser();
    });
 
    $( "#create-booking" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  } );



    </script>
</head>

<body>
    <!-- As a heading -->
    <nav class="navbar navbar-dark bg-primary">

            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    Menu
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/view/home/index.php">Agendas activas</a></li>
                    <li><a class="dropdown-item" href="/view/home/bookingsManager.php">Mantenedor de agendamiento</a></li>
                    <li><a class="dropdown-item" href="">Mantenedor de cuentas</a></li>
                    <li><button type="button" onclick="javascript:logOut();" class="dropdown-item">Cerrar sesión</button></li>
                </ul>
            </div>
            <span class="navbar-text">
                <p class="h3">Nombre de usuario: <?= $_SESSION["user"] ?></p>
            </span>
            <span class="navbar-text">
                <p class="h3" style="padding-right: 30px;">Box actual: <?= $_SESSION["box_user_login"] ?></p>
            </span>
    </nav>

    <div id="dialog-form" title="Añadir agendamiento">
            <p class="validateTips">Todos los campos son requeridos.</p> 
            <form>
                <fieldset>
                <label for="name">Nombre de paciente</label>
                <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">
                <label for="rut">RUT</label>
                <input type="text" name="rut" id="rut" value="" class="text ui-widget-content ui-corner-all">
                <label for="booking_datetime">Hora</label>
                <input type='text' class="form-control" id='booking_datetime' />
                <script type="text/javascript">
                    $(document).on("click", "#booking_datetime", function(){
                         //$(this).datetimepicker();
                    });
                </script>
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                </fieldset>
            </form>
        </div>
        

    <div class="container" style="padding-top: 50px;">
    <div class="d-flex justify-content-center" style="margin-bottom: 20px;">
        <h3>Mantenedor de agendas</h3>
    </div>
        <div class="table-responsive{-sm|-md|-lg|-xl}">
            <table id="tableBookingConfirm" class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Nombre de paciente</th>
                        <th scope="col">Hora agendada</th>
                        <th scope="col">Acciones</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="tbody-Confirm">
                    <tr>
                        <td> Sin datos </td>
                        <td> Sin datos </td>
                        <td> <input type="button" value="Guardar cambios" class="btn btn-success"> <input type="button" value="Eliminar" class="btn btn-danger" disabled> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button id="create-booking"> Añadir agendamiento</button>
    </div>
</body>
</html>