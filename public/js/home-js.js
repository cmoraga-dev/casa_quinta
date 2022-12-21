
/* Confirmar hora.
* Permite confirmar la hora a travez del metodo AJAX de JQyuery, esto a tavez de las variables
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

function clearRUT(rut) {
    return String(rut).replace(/[^0-9a-z]/gi, '');
}

function validateRUT(rut) {
    if (typeof rut !== 'string' && typeof rut !== 'number') {
        console.log(typeof rut)
        throw new TypeError('Input parameter must be of type string or integer')
    }

    const cleanRUT = typeof rut === 'string' ? clearRUT(rut) : String(rut)
    const checkDigit = [...cleanRUT].slice(-1)[0]
    const withoutCheckDigitRUT = cleanRUT.slice(0, -1)
    const obtainedCheckDigit = getCheckDigit(withoutCheckDigitRUT)

    return checkDigit.toLowerCase() === obtainedCheckDigit.toLowerCase()
}

/**
 * @param {(string|number)} rut 
 * @returns {string}
 */
 function getCheckDigit(rut) {
    const cleanRUT = clearRUT(rut)
    const reversedRUT = [...String(cleanRUT)].map(v => parseInt(v)).reverse()
    let result = 0
  
    for (let i = 0, j = 2; i < reversedRUT.length; i++, j < 7 ? j++ : j = 2) {
      result += reversedRUT[i] * j;
    }
  
    return (11 - (result % 11)) <= 9 ? String((11 - (result % 11))) : 'K'
  }