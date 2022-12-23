<?php
	
	session_start();
	
	$usser_account	= (!empty($_SESSION["user"]))?	$_SESSION["user"] : null;
	$box_user_login	= (!empty($_SESSION["box_user_login"]))?	$_SESSION["box_user_login"] : null;
	
	//Se valida si esta vacio el parametro que se le asigna la varibale de session, instanciada en el BoxUser-controller al hacer login.
	if(empty($usser_account)){
		
        //al estar vacia el usuario que es extraido del login se redirigue a la pagina de login.
		echo '<script>top.location.href = "/casa_quinta/view";</script>';
		die;		
	}else if(empty($usser_account)){

		 //al estar vacia el usuario que es extraido del login se redirigue a la pagina de login.
		 echo '<script>top.location.href = "/casa_quinta/";</script>';
		 die;
	}
?>