<?php
include_once('modelo/producto.php');
$oProductos = new producto();

$clv="";

if (isset($_GET["clv"]) && !empty($_GET["clv"])){
    $clv =$_GET["clv"];
}

 	$producto = $oProductos->buscarClave($clv);
?>