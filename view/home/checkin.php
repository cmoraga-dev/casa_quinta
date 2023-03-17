<?php
    include("../login/validateBoxLoginUser.php");

    if($_SESSION["box_user_login"] !=0){
?>
  <!DOCTYPE html>
  <html>
      <head>
          <meta charset="utf-8">
          <title>Checkin Box</title>
          <script  src="../../public/jquery-3.6.2.min.js"></script>
          <script src="../../public/js/login-js.js"></script>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      </head>
      <body>
      <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
            <form action="javascript: updateBox()" id="submitValidateUser">
                <h3 class="mb-5">Casa Quinta</h3>
                  <div class="form-outline mb-4">
                      <label class="form-label" for="user">Ingrese numero del box</label>
                      <input type="text" id="box-num" class="form-control form-control-lg" required>
                  </div>
                      <input type="submit" class="btn btn-primary btn-lg btn-block" value="Confirmar">
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      </body>
  </html>
<?php } ?>