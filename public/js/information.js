
// Boton volver al confirmar hora.
$(document).on('click','#btn-back',function() {
    location.href = '/';
})

setInterval(function () {$('#btn-back').click();},5000);