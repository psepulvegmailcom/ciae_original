<?php

	$UsuarioUsername	= new Usuario(); 	
	$UsuarioEmail		= new Usuario(); 	
	$username   		= VarSystem::getVariable('username');
	$email 				= VarSystem::getVariable('email');
	
	/*
	POSIBLES RESPUESTAS:
		libre		=> email y username est�n libres
		email 		=> el email esta ocupado con un registro previo
		username 	=> el username esta ocupado con un registro previo
		ocupado		=> ambos datos est�n utilizados en alg�n registro 
	*/
	 
	$libre = true;
	if($UsuarioUsername->existeUsuarioByUsername($username)) {
		$libre = false;
	} 
 
	if($UsuarioEmail->existeUsuarioByEmail($email)) {
		if(!$libre)
			echo 'ocupado';
		else
			echo 'email';
	}
	else
	{
		if($libre)
			echo 'libre';
		else
			echo 'username';
	}
	 
?>