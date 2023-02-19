

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

window.setTimeout( function() {
    window.location.reload();
  }, 30000);


dialog = $("#dialog-form").dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
    "Add booking": null,
    Cancel: function() {
        dialog.dialog( "close" );
    }
    },
    close: function() {
    form[ 0 ].reset();
    //allFields.removeClass( "ui-state-error" );
    }
});


form = dialog.find("form").on( "submit", function( event ) {
    event.preventDefault();
    dialog.dialog( "close" );
    return true;
});







/**
 * Receives an ascending sorted JS Object with the candles.
 * @returns A descending sorted JS Map of candles.
 */
function sortEntries(unsortedEntries) {
    // By default, JS can't sort a map
    // Instead, it's neccesary to convert the map to an array and then call sort functions.
    let unsortedCandlesMap = new Map(Object.entries(unsortedEntries));
    let unsortedCandlesArray = [...unsortedCandlesMap];
    let sortedCandlesArray = unsortedCandlesArray.sort(); //.reverse();
    let sortedCandlesMap = new Map(sortedCandlesArray);
    return sortedCandlesMap;
}

/**
 * Source:
 * StackOverFlow (of course). See link:
 * https://stackoverflow.com/questions/1125292/how-to-move-cursor-to-end-of-contenteditable-entity/3866442#3866442
 * @param {*} contentEditableElement 
 */
function setCursorAtEndOfContenteditable(contentEditableElement) {
    var range, selection;
    if (document.createRange) //Firefox, Chrome, Opera, Safari, IE 9+
    {
        range = document.createRange(); //Create a range (a range is a like the selection but invisible)
        range.selectNodeContents(contentEditableElement); //Select the entire contents of the element with the range
        range.collapse(false); //collapse the range to the end point. false means collapse to end rather than the start
        selection = window.getSelection(); //get the selection object (allows you to change selection)
        selection.removeAllRanges(); //remove any selections already made
        selection.addRange(range); //make the range you have just created the visible selection

    } else if (document.selection) {//IE 8 and lower
        range = document.body.createTextRange(); //Create a range (a range is a like the selection but invisible)
        range.moveToElementText(contentEditableElement); //Select the entire contents of the element with the range
        range.collapse(false); //collapse the range to the end point. false means collapse to end rather than the start
        range.select(); //Select the range (make it the visible selection
    }
}

$.fn.selectText = function () {
    var doc = document;
    var element = this[0];
    //console.log(this, element);
    if (doc.body.createTextRange) {
        var range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection) {
        var selection = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }
};


function loadBodyTable( tableArray = []){

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

                tr.appendChild(tdId);
                tr.appendChild(tdRut);
                tr.appendChild(tdFirstName);
                tr.appendChild(tdLastName);
                tr.appendChild(tdEmail);
                tr.appendChild(tdButtons);
            });

        }
    }
}


/** Obtiene todas las reservas confirmadas del dia.
 *  Se encarga de buscar todas las reservas que han sido confirmadas para el dia de hoy,
 *  sin importar si han sido de dias pasados o futuros.
 */
function getAllUsers() {
    var host = window.location.origin;

    $.ajax({
        url: host+'/api/getAllUsers',
        type: 'POST',
    }).done(function (response) {
        loadBodyTable(response);
        console.log('ok');        

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
}
getAllUsers();