
// Boton volver al confirmar hora.
button = 

$(document).on('click','#btn-back',function() {
    location.href = '/';
})

setInterval(function () {$('#btn-back').click();},10000);