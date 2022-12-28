<?php
	
	session_start();
	
    // destruye la session.
	session_destroy();
	
	//Lo redirigue a la pagina de login.

	header("Location: /login");	
	
?>