<?php

// setcookie(name, value, expire, path, domain, secure);
function makingCookies($userData){
	$iduser=$userData['iduser'];
	$username=$userData['username'];
    $rol=$userData['rol'];
	//$center=$userData['center'];

	
	setcookie("iduser", $iduser, time()+3*60*600);	// User Name 
	setcookie("username", $username, time()+3*60*600);	// User Name 
	//setcookie("center", $center, time()+3*60*600); // Insitute */
	setcookie("rol", $rol, time()+3*60*600);	// User Name 
}

function deleteCookies(){
	unset($_COOKIE["iduser"]);
	unset($_COOKIE["username"]);
	//unset($_COOKIE["center"]);
    unset($_COOKIE["rol"]);
	
}

?>