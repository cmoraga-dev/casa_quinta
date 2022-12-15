


function validaUsuario(){
    let userAccount = document.getElementById("user").value;
    let passAcount = document.getElementById("pass").value;
   
    console.log(userAccount + '  ' + passAcount)
    // $.ajax({
    //     url: "/casa_quinta/",
    //     method: "POST",
    //     data: { user : userAccount,
    //             pass: passAcount
        
    //     },
    //     dataType: "html"
    // }).done(function( res ) {
    //     alert( "Data Saved: " + res );
    //   });
}