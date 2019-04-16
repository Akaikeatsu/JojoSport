<?php
  include_once("conectar.php");

   class producto{
     
   	private $nCveProd;
   	private $sNomProducto;
   	private $nPrecio;
   	private $sTallas;
   	private $sTamanos;
   	private $sColores;
   	private $sTipo;
   	private $sEquipo;
   	private $sDisciplina;
   	private $nCantidad;
   	private $sGenero;
   	private $sImg;
      private $nFecha;
      private $sEstado;

   	function setClave($valor){
   		$this->nCveProd = $valor;
   	}
   	function setNombre($valor){
   		$this->sNomProducto = $valor;
   	}
   	function setPrecio($valor){
   		$this->nPrecio = $valor;
   	}
   	function setTalla($valor){
   		$this->sTallas = $valor;
   	}
   	function setSize($valor){
   		$this->sTamanos = $valor;
   	}
   	function setColor($valor){
   		$this->sColores = $valor;
   	}
   	function setTipo($valor){
   		$this->sTipo = $valor;
   	}
   	function setEquipo($valor){
   		$this->sEquipo = $valor;
   	}
   	function setDisciplina($valor){
   		$this->sDisciplina = $valor;
   	}
   	function setCantidad($valor){
   		$this->nCantidad = $valor;
   	}
   	function setGenero($valor){
   		$this->sGenero = $valor;
   	}
   	function setImagen($valor){
   		$this->sImg = $valor;
   	}
      function setFecha($valor){
         $this->nFecha = $valor;
      }
      function setEstado($valor){
         $this->sEstado = $valor;
      }

   	function getClave(){
   		return $this->nCveProd;
   	}
   	function getNombre(){
   		return $this->sNomProducto;
   	}
   	function getPrecio(){
   		return $this->nPrecio;
   	}
   	function getTalla(){
   		return $this->sTallas;
   	}
   	function getSize(){
   		return $this->sTamanos;
   	}
   	function getColor(){
   		return $this->sColores;
   	}
   	function getTipo(){
   		return $this->sTipo;
   	}
   	function getEquipo(){
   		return $this->sEquipo;
   	}
   	function getDisciplina(){
   		return $this->sDisciplina;
   	}
   	function getCantidad(){
   		return $this->nCantidad;
   	}
   	function getGenero(){
   		return $this->sGenero;
   	}
   	function getImagen(){
   		return $this->sImg;
   	}
   	function getFecha(){
         return $this->nFecha;
      }
      function getEstado(){
         return $this->sEstado;
      }


      function buscarGenero($genero){
         $oConexion = new conexion();
         $arrayPro = null;
         $sQuery= "select * from Productos where sGenero='".$genero."'";
         $oConexion->conecta();
         $Obtenido = $oConexion->ejecutaConsulta($sQuery);
         for($i = 0; $i <count($Obtenido); $i++){
            $datos = new producto();
            $datos->setClave($Obtenido[$i][0]);
            $datos->setNombre($Obtenido[$i][1]);
            $datos->setPrecio($Obtenido[$i][2]);
            $datos->setTalla($Obtenido[$i][3]);
            $datos->setSize($Obtenido[$i][4]);
            $datos->setColor($Obtenido[$i][5]);
            $datos->setTipo($Obtenido[$i][6]);
            $datos->setEquipo($Obtenido[$i][7]);
            $datos->setDisciplina($Obtenido[$i][8]);
            $datos->setCantidad($Obtenido[$i][9]);
            $datos->setGenero($Obtenido[$i][10]);
            $datos->setImagen($Obtenido[$i][11]);
            $arrayPro[$i] = $datos;
         }
         //print_r($Obtenido);
         return $arrayPro;
      }

      function buscar($sQuery){
         $oConexion = new conexion();
         $arrayPro = null;
         if ($oConexion->conecta()) {
            try {
               $Obtenido = $oConexion->ejecutaConsulta($sQuery);
            } catch (\Throwable $th) {
               return $arrayPro;
            }
            for($i = 0; $i <count($Obtenido); $i++){
               $datos = new producto();
               $datos->setClave($Obtenido[$i][0]);
               $datos->setNombre($Obtenido[$i][1]);
               $datos->setPrecio($Obtenido[$i][2]);
               $datos->setTalla($Obtenido[$i][3]);
               $datos->setSize($Obtenido[$i][4]);
               $datos->setColor($Obtenido[$i][5]);
               $datos->setTipo($Obtenido[$i][6]);
               $datos->setEquipo($Obtenido[$i][7]);
               $datos->setDisciplina($Obtenido[$i][8]);
               $datos->setCantidad($Obtenido[$i][9]);
               $datos->setGenero($Obtenido[$i][10]);
               $datos->setImagen($Obtenido[$i][11]);
               $arrayPro[$i] = $datos;
            }
            
         }
         return $arrayPro;
      }

      function buscarClave($clave){
         $oConexion = new conexion();
         $Producto = null;
         $oConexion->conecta();
         $sQuery = "SELECT * FROM Productos WHERE nCveProd=".$clave;
         $Obtenido = $oConexion->ejecutaConsulta($sQuery);
         if($Obtenido){
            $datos = new producto();
            $datos->setClave($Obtenido[0][0]);
            $datos->setNombre($Obtenido[0][1]);
            $datos->setPrecio($Obtenido[0][2]);
            $datos->setTalla($Obtenido[0][3]);
            $datos->setSize($Obtenido[0][4]);
            $datos->setColor($Obtenido[0][5]);
            $datos->setTipo($Obtenido[0][6]);
            $datos->setEquipo($Obtenido[0][7]);
            $datos->setDisciplina($Obtenido[0][8]);
            $datos->setCantidad($Obtenido[0][9]);
            $datos->setGenero($Obtenido[0][10]);
            $datos->setImagen($Obtenido[0][11]);
            $Producto = $datos;
         }
         return $Producto;
      }

      function Historial($clave){
         if(!empty($clave)){
            $oConexion = new conexion();
            $Productos = null;
            $sQuery ="SELECT sNomProducto,sEquipo,c.nCantidad,sImg,c.dFecha,sEstado,nPrecio FROM Productos p INNER JOIN Compras c on p.nCveProd=c.nCveProd INNER JOIN Usuario u on u.nCveUsu=c.nCveUsu and u.nCveUsu='".$clave."' ORDER BY c.dFecha DESC";
            if($oConexion->conecta()){
               $Obtenido = $oConexion->ejecutaConsulta($sQuery);
               if($Obtenido){
                  for($i=0; $i<count($Obtenido);$i++){
                     $datos = new producto();
                     $datos->setClave($Obtenido[0][0]);
                     $datos->setNombre($Obtenido[0][1]);
                     $datos->setPrecio($Obtenido[0][2]);
                     $datos->setTalla($Obtenido[0][3]);
                     $datos->setSize($Obtenido[0][4]);
                     $datos->setColor($Obtenido[0][5]);
                     $datos->setTipo($Obtenido[0][6]);
                     $datos->setEquipo($Obtenido[0][7]);
                     $datos->setDisciplina($Obtenido[0][8]);
                     $datos->setCantidad($Obtenido[0][9]);
                     $datos->setGenero($Obtenido[0][10]);
                     $datos->setImagen($Obtenido[0][11]);
                     $Productos[$i] = $datos;
                  }
               }
            }
         }
         return $Productos;
      }

      function buscarEquipo($equipo){
         $oConexion = new conexion();
         $arrayPro = null;
         $sQuery = 'select * from Productos where sEquipo='.$equipo;
         if ($oConexion->conecta()) {
            $Obtenido = $oConexion->ejecutaConsulta($sQuery);
            for($i = 0; $i <count($Obtenido); $i++){
               $datos = new producto();
               $datos->setClave($Obtenido[$i][0]);
               $datos->setNombre($Obtenido[$i][1]);
               $datos->setPrecio($Obtenido[$i][2]);
               $datos->setTalla($Obtenido[$i][3]);
               $datos->setSize($Obtenido[$i][4]);
               $datos->setColor($Obtenido[$i][5]);
               $datos->setTipo($Obtenido[$i][6]);
               $datos->setEquipo($Obtenido[$i][7]);
               $datos->setDisciplina($Obtenido[$i][8]);
               $datos->setCantidad($Obtenido[$i][9]);
               $datos->setGenero($Obtenido[$i][10]);
               $datos->setImagen($Obtenido[$i][11]);
               $arrayPro[$i] = $datos;
            }
         }
         return $arrayPro;
      }

      function buscarDisciplina($disciplina){
         $oConexion = new conexion();
         $arrayPro = null;
         $sQuery = 'select * from Productos where sDisciplina='.$disciplina;
         if ($oConexion->conecta()) {
            $Obtenido = $oConexion->ejecutaConsulta($sQuery);
            for($i = 0; $i <count($Obtenido); $i++){
               $datos = new producto();
               $datos->setClave($Obtenido[$i][0]);
               $datos->setNombre($Obtenido[$i][1]);
               $datos->setPrecio($Obtenido[$i][2]);
               $datos->setTalla($Obtenido[$i][3]);
               $datos->setSize($Obtenido[$i][4]);
               $datos->setColor($Obtenido[$i][5]);
               $datos->setTipo($Obtenido[$i][6]);
               $datos->setEquipo($Obtenido[$i][7]);
               $datos->setDisciplina($Obtenido[$i][8]);
               $datos->setCantidad($Obtenido[$i][9]);
               $datos->setGenero($Obtenido[$i][10]);
               $datos->setImagen($Obtenido[$i][11]);
               $arrayPro[$i] = $datos;
            }
         }
         return $arrayPro;
      }



   }
?>