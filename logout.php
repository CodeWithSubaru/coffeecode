<?php
	require_once "./core/Init.php";
	include './functions/Sanitize.php';
	spl_autoload_register(fn ($class) => require_once './classes/' . $class . '.php');
	
	$user = new User();
	$user->logout();
?>