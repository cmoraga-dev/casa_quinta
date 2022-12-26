const USERUT = document.getElementById('rutUser');
// // Auto formato para campo RUT
// $(function() {
//     $('#rutUser').change(function(){
//         $('#rutUser').Rut({
//             validation: false,
//             format_on: 'change'
//         })
//     }
// )});

/* Confirmar hora.
* Permite confirmar la hora a través del metodo AJAX de JQuery, esto a través de las variables
    obtenidas por el document.getElementById del input del rut.
*/
function confirmHour(){
    let rut = document.getElementById("rutUser").value;
    if(rut){
        $.ajax({
            // envia la peticion URL al API generado en view apartado booking
          url: 'view/Booking/updateConfirmBooking.php',
          
          //Envia el campo rut extraido del metodo getElementById.
          data: {
                rut: rut
            },
            type: 'POST',
        }).done(function (response){

            // Respuesta del servidor, independiente si esta correcto o no.
            let resp = JSON.parse(response);
            if(resp['cod'] === '202'){
                alert("se ha confirmado su hora");
                location.reload();
            }else if(resp['cod'] === '404'){
                console.log(`${resp['cod']} ${resp['def']}`);
            }
            
        }).fail(function (err){
          // Respuesta de un error de peticion hacia el ajax       
          let resp = JSON.parse(err);
          console.log(`${resp['cod']} ${resp['def']}`);
        });
      }
}


/** Agrega los numeros y valida rut.
 * 
 */
$(document).on('click','#btn-num',function(event) {
    let val = document.getElementById("rutUser");
    val.value += event.target.value;
    console.log(validateRut(val.value));
    if(validateRut(val.value)){
        val.value = validateRut(val.value);
    }
})


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

if(USERUT){
    document.getElementById('rutUser').addEventListener('input', function(evt) {
        let value = this.value.replace(/\./g, '').replace('-', '');
        
        if (value.match(/^(\d{2})(\d{3}){2}(\w{1})$/)) {
          value = value.replace(/^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
        }
        else if (value.match(/^(\d)(\d{3}){2}(\w{0,1})$/)) {
          value = value.replace(/^(\d)(\d{3})(\d{3})(\w{0,1})$/, '$1.$2.$3-$4');
        }
        else if (value.match(/^(\d)(\d{3})(\d{0,2})$/)) {
          value = value.replace(/^(\d)(\d{3})(\d{0,2})$/, '$1.$2.$3');
        }
        else if (value.match(/^(\d)(\d{0,2})$/)) {
          value = value.replace(/^(\d)(\d{0,2})$/, '$1.$2');
        }
        this.value = value;
      });
}