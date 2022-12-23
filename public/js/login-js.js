


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
            window.location.href = 'home/checkin.php';
          }else if(resp['cod'] === '404'){
              console.log(`${resp['cod']} ${resp['def']}`);
          }

          
      }).fail(function (err){
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
        console.log(`${resp['cod']} ${resp['def']} `);
      });
}

/** Actualizar numero del Box.
 * Se llama a la API para actualizar el numero del box que esta el usuario doctor,
 * esta llamada siempre se iniciara cuando se haga login y no halla ya una sesion abierta.
 */
function updateBox() {
  let box_num = document.getElementById("box-num").value;

  if(box_num){
    $.ajax({
      url: '../BoxUser/updateBoxLoginUser.php',
      data: {
        box_num_user: box_num
      },
      type: 'POST',
    }).done(function (response) {
      //Respuesta del servidor, independiente si esta correcto o no.
      console.log(response);
      let resp = JSON.parse(response);
      if (resp['cod'] === '202') {
        window.location.href = '../home/index.php';
      } else if (resp['cod'] === '404') {
        console.log(`${resp['cod']} ${resp['def']}`);
      }
  
  
    }).fail(function (err) {
      // Respuesta de un error de peticion hacia el ajax       
      let resp = JSON.parse(err);
      console.log(`${resp['cod']} ${resp['def']} `);
    });
  }
  
}