<?php

include_once("../modelo/ErroresAplic.php");
include_once("../modelo/usuario.php");
session_start();
$nErr=-1;
$sCve="";
$sNom="";

	if (isset($_SESSION["usuario"])){
		session_destroy();
	}
	
	header("Location: ../index.php");
	exit();
?>