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
  <script src="https://kit.fontawesome.com/499ea74159.js" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="../../public/js/jquery.Rut.js"></script>
  <script src="../../public/js/usersManager.js"></script>
  <script>
    function addUser() {
      var host = window.location.origin;

      var rut = document.getElementById("dialog_rut").value;
      var first_name = document.getElementById("dialog_first_name").value;
      var last_name = document.getElementById("dialog_last_name").value;
      var email = document.getElementById("dialog_email").value;

      console.log
      $.ajax({
        url: host + '/api/createUser',
        type: 'POST',
        data: {
          rut: rut,
          first_name: first_name,
          last_name: last_name,
          email: email,
        }
      }).done(function(response) {
        console.log(response);
        resp = JSON.parse(response)
        if (resp['cod'] === '202') {
          location.reload();
        }

      }).fail(function(err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
      });
    }


    $(function() {
      var dialog, form,

        // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
        first_name = $("#nombre"),
        last_name = $("#apellido"),
        rut = $("#rut"),
        email = $("#email"),

        allFields = $([]).add(first_name).add(last_name).add(rut).add(email),
        tips = $(".validateTips");

      function updateTips(t) {
        tips
          .text(t)
          .addClass("ui-state-highlight");
        setTimeout(function() {
          tips.removeClass("ui-state-highlight", 1500);
        }, 500);
      }


      dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
          "Añadir paciente": function() {
            addUser()
          },
          Cancelar: function() {
            dialog.dialog("close");
          }
        },
        close: function() {
          form[0].reset();
          allFields.removeClass("ui-state-error");
        }
      });

      form = dialog.find("form").on("submit", function(event) {
        event.preventDefault();
        //addUser();
      });

      $("#create-user").button().on("click", function() {
        dialog.dialog("open");
      });
    });
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
        <li><a class="dropdown-item" href="/view/home/accountsManager.php">Detalles de cuenta</a></li>
        <?php if ($_SESSION["user_profile"] == 1) { ?>
          <li><a class="dropdown-item" href="/view/home/accountsAdmin.php">Mantenedor de cuentas</a></li>
        <?php } ?>
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

  <div id="dialog-form" class="form-control" title="Añadir paciente">
    <p class="validateTips">Todos los campos son requeridos.</p>
    <form>
      <fieldset>
        <label for="dialog_first_name">Nombre de paciente</label>
        <input type="text" name="dialog_first_name" id="dialog_first_name" value="" class="form-control"">

                <label for=" dialog_last_name">Apellido de paciente</label>
        <input type="text" name="dialog_last_name" id="dialog_last_name" value="" class="form-control">

        <label for="dialog_rut">RUT</label>
        <input type="text" name="dialog_rut" id="dialog_rut" value="" class="form-control">

        <label for="dialog_email">Email</label>
        <input type="text" name="dialog_email" id="dialog_email" value="" class="form-control">

        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
      </fieldset>
    </form>
  </div>


  <div class="container" style="padding-top: 50px;">
    <div class="d-flex justify-content-center" style="margin-bottom: 20px;">
      <h3>Mantenedor de pacientes</h3>
    </div>
    <button id="create-user" class="btn btn-success"> Añadir paciente</button>
    <div class="table-responsive{-sm|-md|-lg|-xl}">
      <table id="tableUsers" class="table table-striped">
        <thead class="table-primary">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">RUT</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <!--<th scope="col">Acciones</th></!-->
          </tr>
        </thead>
        <tbody id="tbody-users">
          <tr>
            <td colspan="1000"><i class="fas fa-spinner spinning"></i> Loading...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>