$( function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      first_name = $( "#nombre" ),
      last_name = $( "#apellido" ),
      rut = $( "#rut" ),
      email = $( "#email" ),

      allFields = $( [] ).add( first_name ).add( last_name).add( rut ).add( email ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }

  
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Añadir cuenta": function() {addUser()},
        Cancelar: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      //addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  } );


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
    var valid_pass = false;

    if (name != null && name != '') {
        valid_name = name;
    }

    if (pass != null && pass != '' && pass == confirm_password) {
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


function addUser() {
    var host = window.location.origin;

    var rut = document.getElementById("dialog_account_name").value;
    var first_name = document.getElementById("dialog_pass").value;
    var last_name = document.getElementById("dialog_pass_confirm").value;
    var email = document.getElementById("dialog_email").value;
    
    console.log
    $.ajax({
        url: host+'/api/createUser',
        type: 'POST',
        data: { 
            rut : rut,
            first_name : first_name,
            last_name : last_name,
            email : email,
        }
    }).done(function (response) {
        console.log(response);
        resp = JSON.parse(response)
        if(resp['cod'] === '202'){
          location.reload();
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
}


function loadData( tableArray = []){

    // Se asigna un valor a la constante para saber si viene vacio el arreglo.
    console.log(typeof(tableArray));
    const table = tableArray.server.users.length;

    console.log(tableArray.server.users);

    // Se valida si viene con datos para ejecutar la carga de tabla.
    if(table > 0){
        // Se busca el body de la tabla.
        const tbody = document.getElementById("tbody-accounts");
       
        // Se valida que existe el campo id
        if(tbody){
            // Se limpia el tbody para ir actualizandolo.
            tbody.innerHTML = '';

            tableArray.server.users.map((e) => {
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
        loadData(response);
        console.log('ok');        
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
}
getAllAccounts();