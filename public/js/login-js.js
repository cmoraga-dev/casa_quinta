


function validaUsuario(){
    let userAccount = document.getElementById("user").value;
    let passAcount = document.getElementById("pass").value;
    let info_validate = document.getElementById("info-val-user");
    var host = window.location.origin;

    $.ajax({
        url: host+'/api/validateUser',
          data: {
                user: userAccount,
                pass: passAcount
          },
          type: 'POST',
      }).done(function (response){
          //Respuesta del servidor, independiente si esta correcto o no.
          console.log(response);
          let resp = JSON.parse(response);
          // console.log(resp['cod']);
          if(resp['cod'] === '202'){
            window.location.href = 'view/home/checkin.php';
          }else if(resp['cod'] === '404'){

            //Se quita el atributo de hidden para mostrar el mensaje.
            window.setTimeout( function() {
              info_validate.removeAttribute("hidden");
            }, 100);

            //Se assigna el atributo hidden de nuevo para que se esconda el msj.
            window.setTimeout( function() {
              info_validate.setAttribute("hidden", true);
            }, 5000);
          }

          
      }).fail(function (err){
        // Respuesta de un error de peticion hacia el ajax       
        let resp = JSON.parse(err);
      });
}

/** Actualizar numero del Box.
 * Se llama a la API para actualizar el numero del box que esta el usuario doctor,
 * esta llamada siempre se iniciara cuando se haga login y no halla ya una sesion abierta.
 */
function updateBox() {
  let box_num = document.getElementById("box-num").value;
  var host = window.location.origin;

  if(box_num){
    $.ajax({
      url: host +'/api/updateBoxLoginUser',
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
        //console.log(`${resp['cod']} ${resp['def']}`);
      }
  
  
    }).fail(function (err) {
      // Respuesta de un error de peticion hacia el ajax       
      let resp = JSON.parse(err);
      //console.log(`${resp['cod']} ${resp['def']} `);
    });
  }
  
}