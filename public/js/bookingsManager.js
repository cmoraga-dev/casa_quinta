

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
    getAllBookingConfirmToday();
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
        const tbody = document.getElementById("tbody-Confirm");
       
        // Se valida que existe el campo id
        if(tbody){
            // Se limpia el tbody para ir actualizandolo.
            tbody.innerHTML = '';

            // Se crea un map del array que llega con su parametro bookings
            tableArray.bookings.map((e) => {
                // Se crean las varibales de html.
                let tr = document.createElement("tr");
                let tdName = document.createElement("td");
                let tdBooking = document.createElement("td");
                let tdConfirm = document.createElement("td");
                let tdButton = document.createElement("td");

                let button = document.createElement("button");

                // Se asigna un hijo al tbody que es un tr
                tbody.appendChild(tr);

                // Se asignan valores a las variables creadas con los datos tomados del map.
                tr.id = e.id;
                tdName.textContent = e.full_name_user;
                tdBooking.textContent = e.datatime_booking;
                tdConfirm.textContent = e.datatime_confirmed;

                // Se le asigna el evento onclick para llamar al metodo callUser
                button.id = "callUser";

                // Se da un nombre al boton que asginada un box.
                button.textContent = "Llamar";                

                // assign child(s) to TR element.
                tdButton.appendChild(button);
                tr.appendChild(tdName);
                tr.appendChild(tdBooking);
                tr.appendChild(tdConfirm);
                tr.appendChild(tdButton);

                // Antes de terminar determinamos si ya tienen un box id asignado y deshabilitamos el botón.
                if(e.id_box_user > 0){
                    // Se le asgina la clase "btn btn-primary" para que aparezca en color verde si ya se llamó a box.
                    button.className = "btn btn-success";

                    // Se da un nombre al boton dado que debe significar que ha sido llamado.
                    button.textContent = "Llamado";

                    button.disabled = true;
                    return;
                }

                // Se le asgina la clase "btn btn-primary" para que aparezca en color azul
                button.className = "btn btn-primary";
                
        });
        }        
    }
}

const addButton = document.querySelector('Añadir');

$(document).on('click',addButton, function(event) {
    alert('works!!')
});




/** Llamar a paciente.
 * 
 */
$(document).on('click','#callUser',function(event) {

    // Se captura el id del tr que es el asignado con el booking id y es el padre del td
    // de donde esta asignado el button.
    let id_tr = event.target.parentElement.parentElement.id;

    var host = window.location.origin;
    $.ajax({
        
        // envia la peticion URL al API generado en view apartado booking
        url: host+'/api/updateBoxBooking',
        data: {
            id_booking : id_tr,
        },
        type: 'POST',
    }).done(function (response) {
        //Respuesta del servidor, independiente si esta correcto o no.
        let resp = JSON.parse(response);
        if (resp['cod'] === '202') {
            // Debemos desabilitar el boton para llamar, dado que ya se le asigno un box.
            event.target.disabled = true
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
