
$(document).ready(function() {
    // Obtén la cadena de consulta de la URL actual
    let queryString = window.location.search;

    // Separa la cadena de consulta en un objeto de parámetros de búsqueda
    let params = new URLSearchParams(queryString);

    // Obtiene el valor del parámetro 'usuario' y lo convierte en un objeto JavaScript
    let usuario = JSON.parse(decodeURIComponent(params.get('usuario')));

    console.log(usuario.nombre); // Imprime "Juan"
    console.log(usuario.edad); // Imprime "30"
    console.log(usuario.correo); // Imprime "juan@example.com"

    let inputUserName = document.getElementById("user");
    inputUserName.setAttribute("disabled",true);
 })