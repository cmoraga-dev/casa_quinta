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

function createAccount(){
    var host = window.location.origin;

    let userName = document.getElementById("user").value;
    let password = document.getElementById("password").value;
    let name = document.getElementById("name").value;
    let fullname = document.getElementById("fullname").value;
    let rut = document.getElementById("rut").value;
    let email = document.getElementById("email").value;
    
    $.ajax({
        url: host+'/api/createAccount',
        type: 'POST',
        data: { 
            user : userName,
            pass : password,
            first_name : name,
            last_name : fullname,
            rut : rut,
            email : email,
        }
    }).done(function (response) {
       resp = JSON.parse(response)
        console.log(resp['cod'] );        
        if(resp['cod'] === '202'){
            // Obtenemos el Toast.
            let toastEl = document.querySelector('.toast');
            let toast = new bootstrap.Toast(toastEl);

            // Seteamos los valores de texto del toast.
            let msjToast = toastEl.querySelector('.toast-body');
            let divTittleToast = toastEl.querySelector('.toast-header');

            // Agregamos valores a los componentes obtenidos con texto     
            msjToast.textContent = `Se ha creado satisfactoriamente el usuario ${userName}`;

            // Agregramos un fondo de exito
            divTittleToast.classList.add('bg-success'); // Agrega la clase de estilo .bg-success

            // Lo mostramos.
            toast.show()
            setTimeout(() => {
                location.reload();                
            }, 2000);
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
}

function editAccount(){
// $.ajax({
        
    //     // envia la peticion URL al API generado en view apartado booking
    //     url: host+'/api/deleteAccount',
    //     data: {
    //         idAccount : id_tr,
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
    //         msjToast.textContent = `Se ha eliminado el usuario`;

    //         // Agregramos un fondo de exito
    //         divTittleToast.classList.add('bg-danger'); // Agrega la clase de estilo .bg-warning
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

function redirectToCreateEditAccount(){
    top.location.href = "/view/home/createEditAccounts.php";
}

function loadData( tableArray = []){

    // Se asigna un valor a la constante para saber si viene vacio el arreglo.
    const table = tableArray.users.length;

    // Se valida si viene con datos para ejecutar la carga de tabla.
    if(table > 0){
        // Se busca el body de la tabla.
        const tbody = document.getElementById("tbody-accounts");
       
        // Se valida que existe el campo id
        if(tbody){
            // Se limpia el tbody para ir actualizandolo.
            tbody.innerHTML = '';

            tableArray.users.map((e) => {
                // Se crean las varibales de html.
                let tr = document.createElement("tr");
                let tdId = document.createElement("td");
                let tdAccountName = document.createElement("td");
                let tdAccountAlias = document.createElement("td");
                let tdAccountType = document.createElement("td");
                let tdButtons = document.createElement("td");

                let edit_btn = document.createElement("button");
                let delete_btn = document.createElement("button");

                tdButtons.appendChild(edit_btn);
                tdButtons.appendChild(delete_btn);

                // Se asigna un hijo al tbody que es un tr
                tbody.appendChild(tr);

                // Se asignan valores a las variables creadas con los datos tomados del map.
                tr.id = e.id;
                tdAccountName.textContent = e.user_name;
                tdAccountAlias.textContent = e.alias;
                tdAccountType.textContent = e.profile_type;
                
                // Se le asigna el evento onclick para llamar al metodo callUser
                edit_btn.id = "editUser";
                delete_btn.id = "deleteUser";

                // Se da un nombre al botón que asigna box.
                edit_btn.textContent = "Editar";
                delete_btn.textContent = "Eliminar";

                edit_btn.className = 'btn btn-primary';
                delete_btn.className = 'btn btn-danger';

                tr.appendChild(tdId);
                tr.appendChild(tdAccountName);
                tr.appendChild(tdAccountAlias);
                tr.appendChild(tdAccountType);
                tr.appendChild(tdButtons);
            });

        }
    }
}


function getAllAccounts() {
    var host = window.location.origin;

    $.ajax({
        url: host+'/api/getAllAccounts',
        type: 'POST',
    }).done(function (response) {
        //console.log(response)
        data = JSON.parse(response)
        loadData(data['server']);
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
}
getAllAccounts();

//Eliminar Cuenta
$(document).on('click','#deleteUser',function(event) {

    // Se captura el id del tr que es el asignado con el booking id y es el padre del td
    // de donde esta asignado el button.
    let id_tr = event.target.parentElement.parentElement.id;

    var host = window.location.origin;
    $.ajax({
        
        // envia la peticion URL al API generado en view apartado booking
        url: host+'/api/deleteAccount',
        data: {
            idAccount : id_tr,
        },
        type: 'POST',
    }).done(function (response) {
        //Respuesta del servidor, independiente si esta correcto o no.
        let resp = JSON.parse(response);
        if (resp['cod'] === '202') {
            // Obtenemos el Toast.
            let toastEl = document.querySelector('.toast');
            let toast = new bootstrap.Toast(toastEl);

            // Seteamos los valores de texto del toast.
            let msjToast = toastEl.querySelector('.toast-body');
            let divTittleToast = toastEl.querySelector('.toast-header');

            // Agregamos valores a los componentes obtenidos con texto     
            msjToast.textContent = `Se ha eliminado el usuario`;

            // Agregramos un fondo de exito
            divTittleToast.classList.add('bg-danger'); // Agrega la clase de estilo .bg-warning
            window.location.reload();

        } else if (resp['cod'] === '404') {
            console.log(`${resp['cod']} ${resp['def']}`);
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    }); 
 });

 //Eliminar Cuenta
$(document).on('click','#editUser',function(event) {

    // Se captura el id del tr que es el asignado con el booking id y es el padre del td
    // de donde esta asignado el button.
    let id_tr = event.target.parentElement.parentElement.id;

    console.log(id_tr);
    var host = window.location.origin;
    top.location.href = "/view/home/createEditAccounts.php";
 });

  //Cancelar Creacion
$(document).on('click','#cancel-create',function(event) {
    // Volvemos al menu de listado de cuentas.
    top.location.href = "/view/home/getAllAccounts.php";
 });