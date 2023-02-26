<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <script src="../public/jquery-3.6.2.min.js"></script>
    <script src="../public/js/dashboard-js.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <img src="../public/img/qr_code.png" alt="QR Code" style="position:fixed; bottom:10px; right:10px; z-index:999;">
    <div class="container" style="padding-top: 50px;">
        <div class="d-flex justify-content-center" style="margin-bottom: 20px;">
            <h1>Sala de espera </h1>
        </div>
        <div class="table-responsive{-sm|-md|-lg|-xl}">
            <table id="tableBooking-dashboard" class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Nombre de paciente</th>
                        <th scope="col">Hora agendada</th>
                        <th scope="col">Box</th>
                        <th scope="col">Nombre Doctor</th>
                    </tr>
                </thead>
                <tbody id="tbody-dashboard">
                    <tr>
                        <td> Sin datos </td>
                        <td> Sin datos </td>
                        <td> Sin datos </td>
                        <td> Sin datos </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>