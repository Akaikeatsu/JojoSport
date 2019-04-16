<?php

include_once("../modelo/usuario.php");
session_start();
$oUsuario = new usuario();
$nErr=-1;

	if (isset($_POST["Nombre"]) && !empty($_POST["Nombre"]) &&
        isset($_POST["ApellidoP"]) && !empty($_POST["ApellidoP"]) &&
        isset($_POST["ApellidoM"]) && !empty($_POST["ApellidoM"]) &&
        isset($_POST["Tel"]) && !empty($_POST["Tel"]) &&
        isset($_POST["Dir"]) && !empty($_POST["Dir"]) &&
        isset($_POST["Email"]) && !empty($_POST["Email"]) &&
        isset($_POST["Contrasena"]) && !empty($_POST["Contrasena"])){

            $oUsuario->setNombre($_POST["Nombre"]);
            $oUsuario->setApePaterno($_POST["ApellidoP"]);
            $oUsuario->setApeMaterno($_POST["ApellidoM"]);
            $oUsuario->setTelefono($_POST["Tel"]);
            $oUsuario->setDireccion($_POST["Dir"]);
            $oUsuario->setPassword($_POST["Contrasena"]);
            $oUsuario->setEmail($_POST["Email"]);
     
            try{
                $aux=$oUsuario->InsertarCliente();
               
            }catch(Exception $e){
                error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
                $nErr = ErroresAplic::ERROR_EN_BD;
            }

	}
	else
		$nErr = ErroresAplic::FALTAN_DATOS;
	
	if ($nErr == -1)
		header("Location: ../ingresar.php");
	else
		header("Location: ../error.php?nError=".$nErr);
	exit();
?>