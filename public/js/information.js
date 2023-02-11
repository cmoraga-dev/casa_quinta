
// Boton volver al confirmar hora.
$(document).on('click','#btn-back',function() {
    location.href = '/';
})

setTimeout(function(){history.back();}, 3000);
