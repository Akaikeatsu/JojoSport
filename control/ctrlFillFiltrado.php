<?php
	include_once("../modelo/producto.php");
	include_once("../modelo/ErroresAplic.php");
    $sCve = "";
    $nErr = -1;
    $oEquipo= new producto();
    $arrEquipo = null;
    $oDisciplina= new producto();
    $arrDisciplina = null;
    $sCadJson="";
    $oErr = new ErroresAplic();
    /*
    if (isset($_POST["sCve"]) && !empty($_POST["sCve"]) ){
        $sCve = $_POST["sCve"];
    }else{
        $nErr=ErroresAplic::FALTAN_DATOS;
    }
    */
	try{
        $arrEquipo=$oEquipo->buscar("SELECT * FROM Productos GROUP BY sEquipo");
        $arrDisciplina=$oDisciplina->buscar("SELECT * FROM Productos GROUP BY sDisciplina");
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
            "arrEquipo":[';
			
			foreach($arrEquipo as $oEquipo){
				$sCadJson=$sCadJson.'{"sEquipo":"'.$oEquipo->getEquipo().'"},';
				}
			//Sobraunacoma,eliminarla
			$sCadJson=substr($sCadJson,0,strlen($sCadJson)-1);
			//Colocarcierredearregloydeobjeto
            $sCadJson=$sCadJson.'],
            "arrDisciplina":[';
			
			foreach($arrDisciplina as $oDisciplina){
				$sCadJson=$sCadJson.'{"sDisciplina":"'.$oDisciplina->getDisciplina().'"},';
				}
			//Sobraunacoma,eliminarla
			$sCadJson=substr($sCadJson,0,strlen($sCadJson)-1);
			//Colocarcierredearregloydeobjeto
			$sCadJson=$sCadJson.']
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
