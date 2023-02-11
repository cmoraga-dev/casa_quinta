

/* Confirmar hora.
* Permite confirmar la hora a través del metodo AJAX de JQuery, esto a través de las variables
    obtenidas por el document.getElementById del input del rut.
*/
function confirmHour(){
    let rut = document.getElementById("rutUser").value.replace('\t','');
    let fechaReserva = new Date().toLocaleString('en-US', { timeZone: 'America/Santiago', hour12: false}).replace(/(\w+)\/(\w+)\/(\w+), (\w+)/, '$3-$2-$1 $4');
    //toISOString().slice(0, 19).replace('T', ' ');
    var host = window.location.origin;

    if(rut){
        $.ajax({
            // envia la peticion URL al API generado en view apartado booking
          url: host+'/api/createBooking',
          
          //Envia el campo rut extraido del metodo getElementById.
          data: {
                rut: rut,
                fechaReserva: fechaReserva
            },
            type: 'POST',
        }).done(function (response){

            // Respuesta del servidor, independiente si esta correcto o no.
            let resp = JSON.parse(response);
            if(resp['cod'] === '202'){
                postForm('information.php', {arg1: '202'}, 'POST');
               // location.reload();
            //}else if(resp['cod'] === '404'){
            }else { 
                postForm('information.php', {arg1: resp['cod']}, 'POST');
                //console.log(`${resp['cod']} ${resp['def']}`);
            }
            
        }).fail(function (err){
          // Respuesta de un error de peticion hacia el ajax       
          let resp = JSON.parse(err);
          //console.log(`${resp['cod']} ${resp['def']}`);
        });
      }
}


/** Agrega los numeros y valida rut.
 * Permite agregar los digitos del rut al momento de hacer clic en los botones del numero,
 * y formatea el rut para que posea los puntos y guion.
 */
$(document).on('click','#btn-num',function(event) {
    let val = document.getElementById("rutUser");
    val.value += event.target.value;

    // Validamos que el rut que nos parcea este con mas de 1 caracter.
    if(validateRut(val.value)){
        val.value = validateRut(val.value);
    }
})

/** Transformar rut.
 * Permite validar el rut para agregar los puntos y los guion
 * cuando corresponde y devuelve el rut parceado.
 * @param {string} rut 
 * @returns rut {11.111.111-1} 
 */
function validateRut(rut){

    var actual = rut.replace(/^0+/, "");
    if (actual != '' && actual.length > 1) {
        var sinPuntos = actual.replace(/\./g, "");
        var actualLimpio = sinPuntos.replace(/-/g, "");
        var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
        var rutPuntos = "";
        var i = 0;
        var j = 1;
        for (i = inicio.length - 1; i >= 0; i--) {
            var letra = inicio.charAt(i);
            rutPuntos = letra + rutPuntos;
            if (j % 3 == 0 && j <= inicio.length - 1) {
                rutPuntos = "." + rutPuntos;
            }
            j++;
        }
        var dv = actualLimpio.substring(actualLimpio.length - 1);
        rutPuntos = rutPuntos + "-" + dv;
    }
    return rutPuntos;
}

/** Metodo Borrar digito.
 *  Borra el ultimo digito que posee el input del rut,
 * para luego setearlo al formato de rut.
 */
$(document).on('click','#btn-del',function() {
    // Obtenemos el rut que esta actualmente en el campo rutUSer.
    let rutDel = document.getElementById("rutUser").value;
    let val = document.getElementById("rutUser");

    // Lo limpiamos de puntos y del guion.
    let cleanDot = rutDel.replace(/\./g, "");
    let cleanDash = cleanDot.replace(/-/g, "");

    // Le quitamos su ultimo caracter con el borrar.
    let rutCleanLastDig = cleanDash.substring(0,cleanDash.length - 1);

    // Luego de quitar el ultimo digito lo parciamos con el validateRut y lo agregamos como su actual valor, siempre y cuando este sea mayor a 1.
    if(validateRut(rutCleanLastDig)){
        val.value = validateRut(rutCleanLastDig);
    }else{
        // En caso de que quede en 1, se pasa el valor que quedo.
        val.value = rutCleanLastDig;
    }
})


function postForm(path, params, method) {
    method = method || 'post';

    var form = document.createElement('form');
    form.setAttribute('method', method);
    form.setAttribute('action', path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', key);
            hiddenField.setAttribute('value', params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}