


function validaUsuario(){
    let userAccount = document.getElementById("user").value;
    let passAcount = document.getElementById("pass").value;
   
    $.ajax({
        url: 'login/validateUser.php',
          data: {
                user: userAccount,
                pass: passAcount
          },
          type: 'POST',
      }).done(function (response){
          //Respuesta del servidor, independiente si esta correcto o no.
          let resp = JSON.parse(response);
          console.log(resp['cod']);
          if(resp['cod'] === '202'){
            window.location.href = 'home/index.php';
          }else if(resp['cod'] === '404'){
              console.log(`${resp['cod']} ${resp['def']}`);
          }

          
      }).fail(function (err){
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']} `);
      });
}