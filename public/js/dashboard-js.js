

window.setTimeout( function() {
    getAllBookingDashboard();
}, 100);

window.setTimeout( function() {
    window.location.reload();
  }, 30000);


function getAllBookingDashboard(){
    var host = window.location.origin;
    $.ajax({
        // envia la peticion URL al API generado en view apartado booking
        url: host+'/api/getAllBookingDashboard',
        type: 'POST',
    }).done(function (response) {
        console.log(response)
        // Respuesta del servidor, independiente si esta correcto o no.
        let resp = JSON.parse(response);
        if (resp['cod'] === '202') {
            loadBodyTable(resp['server']);
        } else if (resp['cod'] === '404') {
            //console.log(`${resp['cod']} ${resp['def']}`);
        }

    }).fail(function (err) {
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']}`);
    });

}

/** Carga de tabla.
 * Carga la tabla que se mostrara en el home luego de validar el acceso, aca se mostrara los pacientes que han confirmado una hora el dia de hoy,
 * y han sido asignado un box para asistir.
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
        const tbody = document.getElementById("tbody-dashboard");
       
        // Se valida que existe el campo id
        if(tbody){
            // Se limpia el tbody para ir actualizandolo.
            tbody.innerHTML = '';

            // Se crea un map del array que llega con su parametro bookings
            tableArray.bookings.map((e) => {
                // Se crean las varibales de html.
                let tr = document.createElement("tr");
                let tdName_patient = document.createElement("td");
                let tdBookingDate = document.createElement("td");
                let tdBox_num = document.createElement("td");
                let tdName_doc = document.createElement("td");


                // Se asigna un hijo al tbody que es un tr
                tbody.appendChild(tr);

                // Se asignan valores a las variables creadas con los datos tomados del map.
                tr.id = e.id;
                tdName_patient.textContent = e.full_name_patient;
                tdBookingDate.textContent = e.datatime;
                tdBox_num.textContent = e.box_num;
                tdName_doc.textContent = e.full_name_account;

                // Se asignan los hijos al tr.
                tr.appendChild(tdName_patient);
                tr.appendChild(tdBookingDate);
                tr.appendChild(tdBox_num);
                tr.appendChild(tdName_doc);

        });
        }        
    }
}