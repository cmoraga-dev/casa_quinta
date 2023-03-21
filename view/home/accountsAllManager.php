<?php
include("../login/validateSession.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Mantenedor de cuentas</title>
    <script src="../../public/jquery-3.6.2.min.js"></script>
    <script src="../../public/js/accountsManager.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <!-- As a heading -->
    <nav class="navbar navbar-dark bg-primary">

        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                Menu
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/view/home/index.php">Home</a></li>
                <li><a class="dropdown-item" href="/view/home/usersManager.php">Mantenedor de usuarios</a></li>
                <?php if ($_SESSION["user_profile"] == 1) { ?>
                    <li><a class="dropdown-item" href="/view/home/accountsAdmin.php">Mantenedor de cuentas</a></li>
                <?php } ?>
                <li><a class="dropdown-item" href="">Detalles de cuenta</a></li>
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
    <h1>Crearemos cuenta y veremos cuenta</h1>
    <div class="container" style="padding-top: 50px;">
        <div class="d-flex justify-content-center" style="margin-bottom: 20px;">
            <h3>Mantenedor de cuentas</h3>
        </div>
        <button id="create-account" class="btn btn-success">Cuenta nueva</button>
        <div class="table-responsive{-sm|-md|-lg|-xl}">
            <table id="tableUsers" class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Cuenta</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo de cuenta</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody-accounts">
                    <tr>
                        <td colspan="1000"><i class="fas fa-spinner spinning"></i> Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>