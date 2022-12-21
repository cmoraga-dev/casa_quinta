

/* Cierra Session.
    Elimina el proceso de inicio de session,
    esto se envia al archivo que elimina la session.
*/
function logOut(){
    console.log('Cerrar Session');
    top.location.href = "../login/exitSession.php"; 

}