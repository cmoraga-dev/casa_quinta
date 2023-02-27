/* Cierra Session.
    Elimina el proceso de inicio de session,
    esto se envia al archivo que elimina la session.
*/
function logOut(){
    top.location.href = "../login/exitSession.php"; 

}

/* Cierra Session.
    Elimina el proceso de inicio de session,
    esto se envia al archivo que elimina la session.
*/
function goToHome(){
    top.location.href = "../../view/home"; 

}

function updateAccount (e) {

    e.preventDefault();
    var host = window.location.origin;

    var user_id = document.getElementById("user_id").value;
    var name = document.getElementById("alias").value;
    var pass = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    var valid_name = false;
    var valid_pass = null;

    if (name != null && name != '') {
        valid_name = name;
    }

    if (pass != null && pass != '' && pass != null && pass != 'false' && pass == confirm_password) {
        valid_pass = pass;
    }

    $.ajax({
        url: host+'/api/updateAccount',
        type: 'POST',
        data:{
            idAccount: user_id,
            pass: valid_pass,
            name: valid_name
        }
    }).done(function (response) {
        console.log(response);
        window.location.reload();  
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        //var resp = JSON.parse(err);
        console.log('errorrr');
        console.log(err);
        //console.log(`${resp['cod']} ${resp['def']}`);
    });
}
