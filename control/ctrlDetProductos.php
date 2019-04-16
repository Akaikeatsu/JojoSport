<?php
	include_once("../modelo/producto.php");
	include_once("../modelo/ErroresAplic.php");
    $sCve = "";
    $nErr = -1;
    $oProd= new producto();
    
    $sCadJson="";
    $oErr = new ErroresAplic();
    
    if (isset($_POST["sCve"]) && !empty($_POST["sCve"]) ){
        $sCve = $_POST["sCve"];
    }else{
        $nErr=ErroresAplic::FALTAN_DATOS;
    }
	try{
		$oProd=$oProd->buscarClave($sCve);
	}catch(Exception $e){
		//Enviarelerrorespecíficoalabitácoradephp(dentrodephp\logs\php_error_log
		//error_log($e->getFile()."".$e->getLine()."".$e->getMessage(),0);
		$nErr=ErroresAplic::ERROR_EN_BD;
	}

	if($nErr==-1){
        $sCadJson=
        '{
            "success":true,
            "sSit":"ok",
            "oProducto":{"nCveProd":'.$sCve.',
                "sNomProducto":"'.$oProd->getNombre().'",
                "nPrecio":'.$oProd->getPrecio().',
                "sTallas":"'.$oProd->getTalla().'",
                "sTamanos":"'.$oProd->getSize().'",
                "sColores":"'.$oProd->getColor().'",
                "sTipo":"'.$oProd->getTipo().'",
                "sEquipo":"'.$oProd->getEquipo().'",
                "sDisciplina":"'.$oProd->getDisciplina().'",
                "nCantidad":'.$oProd->getCantidad().',
                "sGenero":"'.$oProd->getGenero().'",
                "sImg":"'.$oProd->getImagen().'"}
        }';
	}else{
		$oErr->setError($nErr);
		$sCadJson=
		'{
			"success":false,
			"sSit":"'.$oErr->getTextoError().'",
			"arrProductos":"'.$sCve.'"
		}';
	}
	header('Content-type:application/json');
	echo $sCadJson;
?>
