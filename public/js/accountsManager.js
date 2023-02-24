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

function updateAccount () {
    var host = window.location.origin;

    var name = document.getElementById("alias").value;
    var pass = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;

    if (name != null && name != '') {
        console.log('valid name')
    }

    if (pass != null && pass != '' && pass == confirm_password) {
        console.log('valid pass')
    }

    return;
    $.ajax({
        url: host+'/api/getAccount',
        type: 'POST',
    }).done(function (response) {
        //loadData(response);
        console.log(response);        
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
}
