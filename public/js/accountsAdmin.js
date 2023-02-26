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
