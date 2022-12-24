<?php
	
	session_start();
	
	$usser_account	= (!empty($_SESSION["user"]))?	$_SESSION["user"] : null;
	
	//Se valida si esta vacio el parametro que se le asigna la varibale de session, instanciada en el accountr-controller al hacer login.
	if(empty($usser_account)){
		
        //al estar vacia el usuario que es extraido del login se redirigue a la pagina de login.
		echo '<script>top.location.href = "/casa_quinta/view";</script>';
		die;
		
	}else{
		
        // se extrae al momento de validar el login.
		$user_profile = $_SESSION["user_profile"];
        $user_id = $_SESSION["id_account"];
	}

?>