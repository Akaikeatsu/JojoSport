<?php
include_once('modelo/producto.php');
include_once('modelo/ErroresAplic.php');

$oProductos = new producto();
$nErr=-1;
if (isset($_GLOBALS["tipo"]) && $_GLOBALS["tipo"]!="none") {
		$type = $_GLOBALS["tipo"];
		$sQuery= "SELECT * FROM Productos WHERE sTipo='$type'";
		$producto = $oProductos->buscar($sQuery);
		if(is_null(array_reverse($producto)))
			$nErr = ErroresAplic::FALTAN_DATOS;
		 
	}else {
	$sQuery= "SELECT * FROM Productos";
 	$producto = $oProductos->buscar($sQuery);
}
	if ($nErr != -1)
	header("Location:error.php?nError=".$nErr);	
?>