const table = $('#tableUsers')[0];
const headersNames = getHeadersIndex();

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






function updateTips( t ) {
    tips
    .text( t )
    .addClass( "ui-state-highlight" );
    setTimeout(function() {
    tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
}
 
/**
 * Add a single row with the candle information
 * aaand also the save button - which is at the end of every row.
 */
function addDataRow(rowValues) {
    console.log(table);
    console.log(rowValues); //OK
    console.log(rowValues.size);    


    for (var index = 0; index < Object.keys(headersNames).length; index++) {
        let currentCell = currentRow.insertCell(index);
        var textElement = document.createTextNode(rowValues.get(headersNames[index]));
        currentCell.appendChild(textElement);
    }
}



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
 * Return the column name as a key and the index as the value
 */
function getHeadersIndex() {
    let headersIndex = {}
    $('#candles_table > thead > tr > th').each(function (index, element) {
        let columnName = $(this).text().replace(/\s+/g, '').toLowerCase();
        headersIndex[index] = columnName;
    });
    console.log(headersIndex);
    return headersIndex;
}



function rebind() {
    $("#saveBtn").unbind().click(function () {
        //var updatedRows = JSON.stringify (getUpdatedRows());
        var updatedRows = getUpdatedDataRows();
        //alert(updatedRows);
        $.ajax({
                url: "addOrUpdate",
                method: "POST",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("X-CSRFToken", $("[name=csrfmiddlewaretoken]").val())
                },

                data: {
                    //sp: "addOrUpdate",
                    //selectedTicker: $("select").children("option").filter(":selected").val(),
                    //data: updatedRows
                }
            })
            .done(function (data) {
                res = data
                console.log(res)

                if (res.error) {
                    alert(res.error)
                } else {
                    //console.log('Ok');
                }

            }).fail(function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            });
    });
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
        console.log(response);

        let usersMap = sortEntries(response);
        usersMap.forEach((candleValues, time) => {
            console.log ('da value', candleValues, time); //OK
            let singleUser = new Map(Object.entries(candleValues, time));
            addDataRow(singleUser);
        });
        console.log('ok');        
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });
}
getAllUsers();