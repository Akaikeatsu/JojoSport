





<?php
  error_reporting(E_ALL);

  class conexion{
  	private $oConexion = null;

  	function conecta(){
  		$val = false;
  		try{
  			$this->oConexion = new PDO("mysql:host=localhost;dbname=deportes","root","",  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")); 
  			$val = true;
  		}catch(Exception $e){
			throw $e;
		}
		return $val;
  	}

  	function desconecta(){
  		$val =false;
  		if($this->oConexion != null){
  			$this->oConexion ==null;
  			$val =true;
  		}
  		return $val;
  	}

  	function ejecutaConsulta($consulta){		
  		$datos = null;
  		$Obtencion = null;
  		$i = 0;
  		$j = 0;
  		if ($consulta == null)
  			throw new Exception("Error en archivo conexion ---> La consulta esta vacia");
  		if ($this->oConexion == null)
  			throw new Exception("Error en conexion con la base de datos");
  		try{
  			$datos = $this->oConexion->query($consulta);
  		}catch(Exception $e){
  			throw $e;
  		}
  		if ($datos){
  			foreach ($datos as $linea) {
  				foreach($linea as $columna => $valColumna){
  					if(is_string($columna)){
  						$Obtencion[$i][$j] = $valColumna;
  					    $j++;
  					}
  				}
  				$j = 0;
  				$i++;
  			}
  		}
  		return $Obtencion;
  	}
    function ejecutarComando($psComando){
    $nAfectados = -1;
         if ($psComando == ""){
           throw new Exception("AccesoDatos->ejecutarComando: falta indicar el comando");
      }
      if ($this->oConexion == null){
        throw new Exception("AccesoDatos->ejecutarComando: falta conectar la base");
      }
      try{
             $nAfectados =$this->oConexion->exec($psComando);
      }catch(Exception $e){
        throw $e;
      }
      return $nAfectados;
    }
  }
?>