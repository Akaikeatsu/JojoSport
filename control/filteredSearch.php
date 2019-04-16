<?php
include_once("modelo/producto.php");
$sError = "";
$objProducto= new producto();
$objEquipo = null;
$sCadJson = "";
$equipo="";
	
	//Verificar que llegaron los datos
	if (isset($_REQUEST["equipo"]) && !empty($_REQUEST["equipo"])){
		$equipo=$_REQUEST["equipo"];
			try{
				$objEquipo = $objProducto->buscarEquipo($equipo);
				//Almacenar el objeto
				$_REQUEST["equipoEncontrado"] = $objEquipo;
			}catch(Exception $e){
				$sError = $e->getMessage();
				error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			}
	}else{
		$sError = "Faltan datos entrada";
	}
	
	if (empty ($sError)){
		$sCadJson = '{
						"successful": true,
						"equipos":{
							"sNombre": "'.$objEquipo->getNombre().'",
							"sPrecio": "'.$objEquipo->getPrecio().'",
							"sTalla": "'.$objEquipo->getTalla().'",
                            "sSize": "'.$objEquipo->getSize().'",
                            "sColor": "'.$objEquipo->getColor().'",
                            "sTipo": "'.$objEquipo->getTipo().'",
                            "sEquipo": "'.$objEquipo->getEquipo().'",
                            "sDisciplina": "'.$objEquipo->getDisiplina().'",
                            "sCantidad": "'.$objEquipo->getCantidad().'",
                            "sGenero": "'.$objEquipo->getGenero().'",
                            "sImagen": "'.$objEquipo->getImagen().'"
						}
					}';
	}else{
		$sCadJson = '{
						"successful": false,
						"equipos":{
							"sNombre": "'.$sError.'",
							"sPrecio": "",
							"sTalla": "",
                            "sSize": "",
                            "sColor": "",
                            "sTipo": "",
                            "sEquipo": "",
                            "sDisciplina": "",
                            "sCantidad": "",
                            "sGenero": "",
                            "sImagen": ""
						}
					}';
	}
	header('Content-type: application/json');
	echo $sCadJson;
?>