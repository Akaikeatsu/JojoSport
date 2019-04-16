<?php
include_once("../modelo/usuario.php");
session_start();
$sesion="";
$tipo="";
$sEmail="";
$sPwd="";	
$oUsuario = new usuario();
$nErr=-1;

	if (isset($_POST["Email"]) && !empty($_POST["Email"]) &&
		isset($_POST["Password"]) && !empty($_POST["Password"])){
		$sEmail = $_POST["Email"];
		$sPwd = $_POST["Password"];
		$oUsuario->setEmail($sEmail);
		$oUsuario->setPassword($sPwd);
		try{
			if ( $oUsuario->buscarUser()){
				$_SESSION["usuario"] = $oUsuario;
				$sesion=$_SESSION["usuario"];
				$tipo=$sesion->getTipo();
			}
		}catch(Exception $e){
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$nErr = ErroresAplic::ERROR_EN_BD;
		}
	}
	else
		$nErr = ErroresAplic::FALTAN_DATOS;
	
	if ($nErr == -1){
		if($tipo=="Cliente"){
			header("Location: ../index.php");
		}else if($tipo=="Administrador"){
            header("Location: ../jaja.php");
		}
	}
	else
		header("Location: ../error.php?nError=".$nErr);
	exit();
?>