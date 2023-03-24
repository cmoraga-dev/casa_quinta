var idEdit = 0;
$(document).ready(function() {
    // Obtén la cadena de consulta de la URL actual
    let queryString = window.location.search;

    // Separa la cadena de consulta en un objeto de parámetros de búsqueda
    let params = new URLSearchParams(queryString);

    // Obtiene el valor del parámetro 'usuario' y lo convierte en un objeto JavaScript
    let userByEdit = JSON.parse(decodeURIComponent(params.get('user')));

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
            let arrayAccountInfo = resp['server'];   

            // Obtienes el componente de html a editar.
            let inputUserName = document.getElementById("user");
            let inputFirst_name = document.getElementById("name");
            let inputFullname = document.getElementById("fullname");
            let inputRut = document.getElementById("rut");
            let inputEmail = document.getElementById("email");           

            // Deshabilitamos los campos que no se podran editar.
            inputUserName.setAttribute("disabled", true);
            inputFirst_name.setAttribute("disabled", true);
            inputFullname.setAttribute("disabled", true);
            inputRut.setAttribute("disabled", true);
            inputEmail.setAttribute("disabled", true);
           
            arrayAccountInfo.users.map((e) => {
                inputUserName.value = e.account;
                inputFirst_name.value = e.first_name;
                inputFullname.value = e.last_name;
                inputRut.value = e.rut;
                inputEmail.value = e.email;
            });
            idEdit = idUser;
        }
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
 }

function updateAccount() {
    var host = window.location.origin;

    if (idEdit != 0) {
        let inputPass = document.getElementById("password").value;
        let inputName = document.getElementById("user");
        console.log(`${idEdit} y la pass ${inputPass}`);

        // $.ajax({
        //     // envia la peticion URL al API generado.
        //     url: host + '/api/updateAccountPassword',
        //     data: {
        //         idAccount: idEdit,
        //         pass : inputPass,
        //     },
        //     type: 'POST',
        // }).done(function (response) {
        //     //Respuesta del servidor, independiente si esta correcto o no.
        //     let resp = JSON.parse(response);
        //     if (resp['cod'] === '202') {
        //         // Obtenemos el Toast.
        //         let toastEl = document.querySelector('.toast');
        //         let toast = new bootstrap.Toast(toastEl);

        //         // Seteamos los valores de texto del toast.
        //         let msjToast = toastEl.querySelector('.toast-body');
        //         let divTittleToast = toastEl.querySelector('.toast-header');

        //         // Agregamos valores a los componentes obtenidos con texto     
        //         msjToast.textContent = `Se ha actualizado la contraseña`;

        //         // Agregramos un fondo de exito
        //         divTittleToast.classList.add('bg-succes'); // Agrega la clase de estilo .bg-succes
        //         window.location.reload();

        //     } else if (resp['cod'] === '404') {
        //         console.log(`${resp['cod']} ${resp['def']}`);
        //     }

        // }).fail(function (err) {
        //     // Respuesta de un error de peticion hacia el ajax       
        //     let resp = JSON.parse(err);
        //     console.log(`${resp['cod']} ${resp['def']}`);
        // });
    }
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