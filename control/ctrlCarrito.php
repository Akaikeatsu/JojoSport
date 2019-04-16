<?php 
session_start();

if(isset($_GET["id_prod"]) && !empty($_GET["id_prod"])) {
	
	$_Product = array('id'=>$_GET["id_prod"], 'nombre'=>$_GET["nombre_prod"], 'precio'=>$_GET["precio_prod"], 'cantidad'=>$_GET["prod_qty"]);

	if(isset($_SESSION["products"])){ 
		array_push($_SESSION["products"], $_Product);			
	} else {
		$_SESSION["products"] = array();
		array_push($_SESSION["products"], $_Product);
	}

	
}
header("Location: ../carrito.php");
 ?>