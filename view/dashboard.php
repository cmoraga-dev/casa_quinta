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
        <div id="dialog-form" title="Create new user">
            <p class="validateTips">All form fields are required.</p> 
            <form>
                <fieldset>
                <label for="name">Nombre de paciente</label>
                <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">
                <label for="rut">RUT</label>
                <input type="text" name="rut" id="rut" value="" class="text ui-widget-content ui-corner-all">
                <label for="booking_datetime">Hora</label>
                <input type="" name="booking_datetime" id="booking_datetime" value="" class="text ui-widget-content ui-corner-all">
            
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>