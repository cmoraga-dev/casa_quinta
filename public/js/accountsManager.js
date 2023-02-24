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

function getAccountDetails () {
    var host = window.location.origin;

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
getAllUsers();

$(document).on('keyup','#dialog_rut',function(event) {
    $('#dialog_rut').Rut({
        //  on_error: function(){return (s.length >= 11 && s.length < 13); },
          format_on: 'keyup'
        })
});