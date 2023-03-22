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
            let tittleToast = toastEl.querySelector('.mr-auto');
            let msjToast = toastEl.querySelector('.toast-body');

            // Agregamos valores a los componentes obtenidos con texto
            tittleToast.textContent = `Usuario Creado con Exito!`;
            msjToast.textContent = `Se ha creado satisfactoriamente el usuario ${user}`;

            // Agregramos un fondo de exito
            toastEl.classList.add('bg-success'); // Agrega la clase de estilo .bg-success
            toastEl.style.backgroundColor = 'lightgreen'; // Cambia el color de fondo a lightgreen

            // Lo mostramos.
            toast.show()
            setTimeout(() => {
                location.reload();                
            }, 3000);
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
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