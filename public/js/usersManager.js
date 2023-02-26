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

function loadData( tableArray = []){

    // Se asigna un valor a la constante para saber si viene vacio el arreglo.
    const table = tableArray.users.length

    console.log(tableArray.users);

    // Se valida si viene con datos para ejecutar la carga de tabla.
    if(table > 0){
        // Se busca el body de la tabla.
        const tbody = document.getElementById("tbody-users");
       
        // Se valida que existe el campo id
        if(tbody){
            // Se limpia el tbody para ir actualizandolo.
            tbody.innerHTML = '';

            tableArray.users.map((e) => {
                // Se crean las varibales de html.
                let tr = document.createElement("tr");
                let tdId = document.createElement("td");
                let tdRut = document.createElement("td");
                let tdFirstName = document.createElement("td");
                let tdLastName = document.createElement("td");
                let tdEmail = document.createElement("td");
                let tdButtons = document.createElement("td");

                let edit_btn = document.createElement("button");
                let delete_btn = document.createElement("button");

                tdButtons.appendChild(edit_btn);
                tdButtons.appendChild(delete_btn);

                // Se asigna un hijo al tbody que es un tr
                tbody.appendChild(tr);

                // Se asignan valores a las variables creadas con los datos tomados del map.
                tr.id = e.id;
                tdId.textContent = e.id;
                tdRut.textContent = e.rut;
                tdFirstName.textContent = e.first_name
                tdLastName.textContent = e.last_name
                tdEmail.textContent = e.email

                // Se le asigna el evento onclick para llamar al metodo callUser
                edit_btn.id = "editUser";
                delete_btn.id = "deleteUser";

                // Se da un nombre al botón que asigna box.
                edit_btn.textContent = "Editar";
                delete_btn.textContent = "Eliminar";

                edit_btn.className = 'btn btn-primary';
                delete_btn.className = 'btn btn-danger';

                tr.appendChild(tdId);
                tr.appendChild(tdRut);
                tr.appendChild(tdFirstName);
                tr.appendChild(tdLastName);
                tr.appendChild(tdEmail);
                //tr.appendChild(tdButtons);
            });

        }
    }
}


function getAllUsers() {
    var host = window.location.origin;

    $.ajax({
        url: host+'/api/getAllUsers',
        type: 'POST',
    }).done(function (response) {
        loadData(response);
        console.log('ok');        
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