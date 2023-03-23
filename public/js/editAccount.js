
$(document).ready(function() {
    // Obtén la cadena de consulta de la URL actual
    let queryString = window.location.search;

    // Separa la cadena de consulta en un objeto de parámetros de búsqueda
    let params = new URLSearchParams(queryString);

    // Obtiene el valor del parámetro 'usuario' y lo convierte en un objeto JavaScript
    let userByEdit = JSON.parse(decodeURIComponent(params.get('user')));

    let inputUserName = document.getElementById("user");
    inputUserName.setAttribute("disabled",true);

    let idUser = userByEdit.id;

    loadEditAccount(idUser);
 })

 // Obtenemos los datos del usuario a editar y lo cargamos en la pagina.
 function loadEditAccount( idUser ){
    var host = window.location.origin;
    $.ajax({
        url: host+'/api/getAccount',
        data: {
            idAccount : idUser,
        },
        type: 'POST',
    }).done(function (response) {
        //Respuesta del servidor, independiente si esta correcto o no.
        let resp = JSON.parse(response);

        if (resp['cod'] === '202') {          
            console.table(resp['server']);
            let arrayAccountInfo = resp['server'];           
            // arrayAccountInfo.users.map((e) => {
            //     inputUserName.value = e.account;
            // });
           
        }
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
 }

//Cancelar Creacion
$(document).on('click','#cancel-create',function(event) {
    // Volvemos al menu de listado de cuentas.
    top.location.href = "/view/home/accountsAdmin.php";
 });

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