

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
    getAllBookings();
}, 100);

window.setTimeout( function() {
    window.location.reload();
  }, 30000);


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
            loadBodyTable(resp['server']);
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
        // envia la peticion URL al API generado en view apartado booking
        url: host+'/api/getAllUsers',
        type: 'POST',
    }).done(function (response) {

        // Respuesta del servidor, independiente si esta correcto o no.
        var resp = JSON.parse(response);
        if (resp['cod'] === '202') {
            loadBodyTable(resp['server']);
        } else if (resp['cod'] === '404') {
           // console.log(`${resp['cod']} ${resp['def']}`);
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        var resp = JSON.parse(err);
        //console.log(`${resp['cod']} ${resp['def']}`);
    });
    return resp;
}


// Getting the value from the template
// Store it as a global variable
const table = $('.tableBookingConfirm')[0];
const headersNames = getHeadersIndex();
mixedData = getAllBookings();
loadBookingsIntoTable(mixedData);
usersData = getAllUsers();
console.log(usersData);

makeCellsEditable();
cellsChangeObserver();
rebind();

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
 * Add a row when there are no candles to show
 */
function addEmptyRow() {
    var table = document.getElementById('tableBookingConfirm');
    var td = table.children[1];
    td.children[0].remove()
}

/**
 * Return the column name as a key and the index as the value
 */
function getHeadersIndex() {
    let headersIndex = {}
    $('#tableBookingConfirm > thead > tr > th').each(function (index, element) {
        let columnName = $(this).text().replace(/\s+/g, '').toLowerCase();
        headersIndex[index] = columnName;
    });
    return headersIndex;
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
function sortEntries(unsortedCandles) {
    // By default, JS can't sort a map
    // Instead, it's neccesary to convert the map to an array and then call sort functions.
    let unsortedCandlesMap = new Map(Object.entries(unsortedCandles));
    let unsortedCandlesArray = [...unsortedCandlesMap];
    let sortedCandlesArray = unsortedCandlesArray.sort().reverse();
    let sortedCandlesMap = new Map(sortedCandlesArray);
    return sortedCandlesMap;
}

/**
 * Make the cells temporary editable on double click,
 * using the property 'contenteditable'.
 */
function makeCellsEditable() {
    const tableCells = $('table tbody tr td')

    tableCells.dblclick(function () {
        let isIcon = $(this).text() == 'Missing candle!';
        //console.log('is icon?', isIcon); // OK
        if (!isIcon) $(this).attr('contenteditable', 'true').focus();
    });
    tableCells.on('keydown', function (e) {
        var keyCode = e.keyCode || e.which;
        // console.log('key code', keyCode); //OK
        if (keyCode == 9) {
            // Change here
            let isIconNext = $(this).next('td').text() == 'Missing candle!';
            e.preventDefault();
            if (!isIconNext) {
                calculateSMA($(this));
                $(this).next('td').attr('contenteditable', 'true').focus().selectText();
                //console.log($(this).parent());
                $(this).parent().addClass('updated');
            }
            let userValue = $(this)[0].childNodes[0].nodeValue;
            console.log('user value', userValue);
            let validValue = Math.abs(parseFloat(userValue)) >= 0 ? Math.abs(parseFloat(userValue)) : '';
            $(this)[0].childNodes[0].nodeValue = '';
            $(this)[0].childNodes[0].nodeValue = validValue;
            console.log('valid value', validValue);
    
            if (userValue.endsWith('.')) {
                $(this)[0].childNodes[0].nodeValue = `${validValue}.`;
            }else if (userValue.endsWith('.0'))
                $(this)[0].childNodes[0].nodeValue = `${userValue}.`;
            
        }
        if (keyCode == 13) {
            e.preventDefault();
        }
    });
    tableCells.on('input', function () {
        $(this).focus();
        setCursorAtEndOfContenteditable($(this)[0]);

    });


    $(document).click(function (e) {
        if (!tableCells.toArray().some(f => f.contains(e.target))) {
            tableCells.removeAttr('contenteditable');
            $(this).removeAttr('contenteditable');
        }
    })
}


/**
 * Starts the MutationObserver object.
 * Checks constantly for every change on the cells content.
 * On change: adds the class 'updated' to the parent row.
 */
function cellsChangeObserver() {

    // Observer options
    const observerOptions = {
        attributes: false,
        childList: false,
        subtree: true,
        characterData: true,
        attributeOldValue: false,
        characterDataOldValue: false
    };

    // Element to observe
    var dataCells = $('table tbody')[0];

    // Observer constructor and callback
    const observer = new MutationObserver((mutationList) => {
        mutationList.forEach((mutation) => {
            console.log('data updated!', mutation);
            console.log(mutation.target.nodeValue, typeof (mutation.target));
            let mutatedRow = mutation.target.parentElement.parentElement;
            mutatedRow.className = 'updated';

        })
    });
    observer.observe(dataCells, observerOptions);
}

/**
 * Detect the candle data from updated rows only.
 * Also performs validation (to prevent sending garbage).
 */
function getUpdatedDataRows() {
    var updatedRows = $('table > tbody > tr.updated');
    let processedRows = {};
    $.each(updatedRows, function (key, valueObject) {
        let singleRow = {}
        for (let index in headersNames) {
            //alert(headersNames[index] + '' + valueObject.cells[index].innerHTML);
            singleRow[headersNames[index]] = valueObject.cells[index].innerHTML;
        }
        processedRows[key] = singleRow;
    });
    //alert(JSON.stringify(processedRows));
    return JSON.stringify(processedRows);
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

