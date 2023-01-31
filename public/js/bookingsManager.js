

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


$( "#create-booking" ).button().on( "click", function() {
    dialog.dialog( "open" );
});


dialog = $( "#dialog-form" ).dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
    "Add booking": addBooking,
    Cancel: function() {
        dialog.dialog( "close" );
    }
    },
    close: function() {
    form[ 0 ].reset();
    //allFields.removeClass( "ui-state-error" );
    }
});

form = dialog.find( "form" ).on( "submit", function( event ) {
    event.preventDefault();
    addBooking();
});

/** Obtiene todas las reservas confirmadas del dia.
 *  Se encarga de buscar todas las reservas que han sido confirmadas para el dia de hoy,
 *  sin importar si han sido de dias pasados o futuros.
 */
function getAllBookings() {
    var host = window.location.origin;

    $.ajax({
        // envia la peticion URL al API generado en view apartado booking
        url: host+'/api/getAllBookingDashboard',
        type: 'POST',
    }).done(function (response) {

        // Respuesta del servidor, independiente si esta correcto o no.
        let resp = JSON.parse(response);
        if (resp['cod'] === '202') {
            console.log(resp['server']);
            return resp['server'];
        } else if (resp['cod'] === '404') {
           // console.log(`${resp['cod']} ${resp['def']}`);
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        //console.log(`${resp['cod']} ${resp['def']}`);
    });

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
        Object.entries(response).forEach(item => {
            console.log(item);
            if (item[0] == 'users') {
                return item[1];
            }
        });
        
    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        //console.log(`${resp['cod']} ${resp['def']}`);
    });
}

const table = $('.tableBookingConfirm')[0];
bookingData = getAllBookings();
//loadBookingsIntoTable(bookingData);
usersData = getAllUsers();
console.log(usersData);

rebind();

function updateTips( t ) {
    tips
    .text( t )
    .addClass( "ui-state-highlight" );
    setTimeout(function() {
    tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
}
 

function addBooking() {
    var valid = true;
    allFields.removeClass( "ui-state-error" );

    $( "#users tbody" ).append( "<tr>" +
        "<td>" + name.val() + "</td>" +
        "<td>" + email.val() + "</td>" +
        "<td>" + password.val() + "</td>" +
    "</tr>" );
    dialog.dialog( "close" );
}
 

/**
 * Insert the candles data into the html table.
 * @param  data 
 */
function loadBookingsIntoTable(data) {
    let entriesMap = sortEntries(data);
    console.log (table); OK
    console.log(entriesMap);// map OK

    entriesMap.forEach((candleValues, time) => {
        //console.log ('da candle', candleValues, time); //OK
        let singleCandleMap = new Map(Object.entries(candleValues, time));
        singleCandleMap.set('datetime', formatTime(time));
        singleCandleMap.set('unixtime', time);
        singleCandleMap.set('timespan', '5m');
        addDataRow(singleCandleMap);
    });
    if (entriesMap.size == 0) {
        console.log('No candles data!');
    }
}

/**
 * Add a single row with the candle information
 * aaand also the save button - which is at the end of every row.
 */
function addDataRow(rowValues) {
    //console.log(table); OK
    //console.log(rowValues); //OK
    //console.log(rowValues.size);    

    let currentRow = table.insertRow(-1);
    for (var index = 0; index < Object.keys(headersNames).length; index++) {
        let currentCell = currentRow.insertCell(index);
        var textElement = document.createTextNode(rowValues.get(headersNames[index]));

        currentCell.appendChild(textElement);
    }
}

/**
 * 
 */
function formatTime(s) {
    const dtFormat = new Intl.DateTimeFormat('en-US', {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        timeZone: 'America/Santiago',
        timeZoneName: 'short'
    });
    return dtFormat.format(new Date(s * 1e3));
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
    let sortedCandlesArray = unsortedCandlesArray.sort().reverse();
    let sortedCandlesMap = new Map(sortedCandlesArray);
    return sortedCandlesMap;
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

