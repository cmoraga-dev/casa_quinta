

/* Cierra Session.
    Elimina el proceso de inicio de session,
    esto se envia al archivo que elimina la session.
*/
function logOut(){
    console.log('Cerrar Session');
    top.location.href = "../login/exitSession.php"; 

}

window.setTimeout( function() {
    getAllBookingConfirmToday();
}, 1000);

window.setTimeout( function() {
    window.location.reload();
  }, 30000);

/** Obtiene todas las reservas confirmadas del dia.
 *  Se encarga de buscar todas las reservas que han sido confirmadas para el dia de hoy,
 *  sin importar si han sido de dias pasados o futuros.
 */
function getAllBookingConfirmToday() {

    $.ajax({
        // envia la peticion URL al API generado en view apartado booking
        url: '../../view/Booking/getAllBookingToday.php',
        type: 'POST',
    }).done(function (response) {

        // Respuesta del servidor, independiente si esta correcto o no.
        let resp = JSON.parse(response);
        if (resp['cod'] === '202') {
            empyArray = [];
            console.log(resp['server']);
            loadBodyTable(resp['server']);
        } else if (resp['cod'] === '404') {
            console.log(`${resp['cod']} ${resp['def']}`);
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });

}

/** Carga de tabla.
 * Carga la tabla que se mostrara en el home luego de validar el acceso, aca se mostrara los pacientes que han confirmado una hora el dia de hoy,
 * junto con su hora reservada y que confirmaron.
 * Esto se poblara con los datos extraidos del array que se le pasa.
 * @param {*} tableArray 
 * @retun tbody.
 */
function loadBodyTable( tableArray = []){

    // Se asigna un valor a la constante para saber si viene vacio el arreglo.
    const empyTable = tableArray.bookings.length

    // Se valida si viene con datos para ejecutar la carga de tabla.
    if(empyTable > 0){
        // Se busca el body de la tabla.
        const tbody = document.getElementById("tbodyConfirm");
        
        // Se limpia el tbody para ir actualizandolo.
        tbody.innerHTML = '';
     
        // Se crea un map del array que llega con su parametro bookings
        tableArray.bookings.map((e) => {
            // Se crean las varibales de html.
            let tr = document.createElement("tr");
            let tdName = document.createElement("td");
            let tdBooking = document.createElement("td");
            let tdConfirm = document.createElement("td");

            let button = document.createElement("button");

            // Se asigna un hijo al tbody que es un tr
            tbody.appendChild(tr);

            // Se asignan valores a las variables creadas con los datos tomados del map.
            tr.id = e.id;
            tdName.textContent = e.full_name_user;
            tdBooking.textContent = e.datatime_booking;
            tdConfirm.textContent = e.datatime_confirmed;
            
            // Se da un nombre al boton que asginada un box.
            button.textContent = "Llamar";

            // Se asignan los hijos al tr.
            tr.appendChild(tdName);
            tr.appendChild(tdBooking);
            tr.appendChild(tdConfirm);
            tr.appendChild(button);
        });
    }
    
}