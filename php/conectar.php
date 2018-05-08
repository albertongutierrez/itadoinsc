<?php
	require('conexion.php');
	$mysqli= new mysqli($host,$user,$pw,$bd);///conectandoce al servidor
	// $mysqli::set_charset ('utf8');
	mysqli_set_charset($mysqli,"utf8");
	if (mysqli_connect_errno()){
		echo "conexion fallida: ",mysqli_connect_errno();
		exit();
	}
	$llave=$llavec;
?>