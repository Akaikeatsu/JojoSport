<?php
include_once('conectar.php');
class Usuario{
	private $nClave;
	private $sPassword;
	private $sNombre;
	private $sApaterno;
	private $sAmaterno;
	private $nTelefono;
	private $sDireccion;
    private $sEmail;
  
	private $sTipo="";

	function setClave($dato){
		$this->nClave = $dato;
	}
	function getClave(){
		return $this->nClave;
	}
	
	function setNombre($dato){
		$this->sNombre= $dato;
	}
	function getNombre(){
		return $this->sNombre;
	}
	function setApePaterno($dato){
		$this->sApaterno = $dato;
	}
	function getApePaterno(){
		return $this->sApaterno;
	}
	function setApeMaterno($dato){
		$this->sAmaterno = $dato;
	}
	function getApeMaterno(){
		return $this->sAmaterno;
	}
	function setTelefono($dato){
		$this->nTelefono = $dato;
	}
	function getTelefono(){
		return $this->nTelefono;
	}
	function setDireccion($dato){
		$this->sDireccion = $dato;
	}
	function getDireccion(){
		return $this->sDireccion;
	}
	function setPassword($dato){
		$this->sPassword = $dato;
	}
	function getPassword(){
		return $this->sPassword;
	}
	function setEmail($dato){
		$this->sEmail = $dato;
	}
	function getEmail(){
		return $this->sEmail;
	}
	function setTipo($dato){
		$this->sTipo = $dato;
	}
	function getTipo(){
		return $this->sTipo;
	}


	function buscarUser(){
		$oConexion = new conexion();
		$oSearch = true;
		if($oConexion->conecta()){
			$sQuery = "SELECT * FROM Usuario WHERE sContrasenia = '".$this->sPassword."' AND sEmail = '".$this->sEmail."'";
			$oDatos = $oConexion->ejecutaConsulta($sQuery);
			if($oDatos){
				$this->nClave = $oDatos[0][0];
				$this->sPassword = $oDatos[0][1];
				$this->sNombre = $oDatos[0][2];
				$this->sApaterno = $oDatos[0][3];
				$this->sAmaterno = $oDatos[0][4];
				$this->nTelefono = $oDatos[0][5];
				$this->sDireccion = $oDatos[0][6];
                $this->sEmail =$oDatos[0][7];
                $this->sTipo = "Cliente";
                //CONST CLIENTE = "Cliente";
                
				$oSearch = true;
			}else{
			   $sQuery = "SELECT * FROM Administrador WHERE sContrasenia = '".$this->sPassword."' AND sEmail = '".$this->sEmail."'";
			   $oDatos = $oConexion->ejecutaConsulta($sQuery);
			   if($oDatos){
			   	$this->nClave = $oDatos[0][0];
				$this->sPassword = $oDatos[0][1];
				$this->sNombre = $oDatos[0][2];
				$this->sApaterno = $oDatos[0][3];
				$this->sAmaterno = $oDatos[0][4];
                $this->sEmail = $oDatos[0][5];
                $this->sTipo = "Administrador";
               // CONST ADMIN = "Administrador";
			   	$oSearch = true;
			   }else{
			   	$oSearch =false;
			   }
			}
		}else
			$oSearch =false;
		return $oSearch;
	}

	function buscarClave(){
		$oConexion = new conexion();
		$oSearch = null;
		if($oConexion->conecta()){
			if($this->sTipo == 'admin'){
				$sQuery = "SELECT * FROM Administrador WHERE nCveAdmin = '".$this->nClave."'";
				$oDatos = $oConexion->ejecutaConsulta($sQuery);
				if($oDatos){
				 		$this->nClave = $oDatos[0][0];
			 			$this->sPassword = $oDatos[0][1];
			 			$this->sNombre = $oDatos[0][2];
			 			$this->sApaterno = $oDatos[0][3];
			 			$this->sAmaterno = $oDatos[0][4];
			 			$this->sEmail = $oDatos[0][5];
			 			$this->sTipo = "admin";
				 		$oSearch = true;
				}else{
				 		$oSearch =false;
				}
			}else{
				$sQuery = "SELECT * FROM Usuario WHERE nCveUsu = '".$this->nClave."'";
				$oDatos = $oConexion->ejecutaConsulta($sQuery);
				if($oDatos){
					$this->nClave = $oDatos[0][0];
					$this->sPassword = $oDatos[0][1];
					$this->sNombre = $oDatos[0][2];
					$this->sApaterno = $oDatos[0][3];
					$this->sAmaterno = $oDatos[0][4];
					$this->nTelefono = $oDatos[0][5];
					$this->sDireccion = $oDatos[0][6];
					$this->sEmail = $oDatos[0][7];
					$this->sTipo = "comprador";
					$oSearch = true;
				}
			}
		}else
			$oSearch =false;
		return $oSearch;
	}

	function modificar(){
		$oAccesoDatos=new conexion();
		$sQuery="";
		$nAfectados=-1;
			if ($this->sTipo == ''){
				throw new Exception("Usuario->modificar(): falta definir tipo de usuario");
			}else{
				if ($oAccesoDatos->conecta()){
					if($this->sTipo == 'admin'){
						$sQuery = "UPDATE Administrador SET nCveAdmin='".$this->nClave."',
						sContrasenia='".$this->sPassword."',sNombre='".$this->sNombre."',
						sApePaterno='".$this->sApaterno."',sApeMaterno='".$this->sAmaterno."',
						sEmail='".$this->sEmail."' WHERE nCveAdmin='".$this->nClave."'";
					}else{
						$sQuery = "UPDATE Usuario SET nCveUsu='".$this->nClave."',
						sContrasenia='".$this->sPassword."',sNombre='".$this->sNombre."',
						sApePaterno='".$this->sApaterno."',sApeMaterno='".$this->sAmaterno."',
						nTelefono='".$this->nTelefono."',sDireccion='".$this->sDireccion."',
						sEmail='".$this->sEmail."' WHERE nCveUsu='".$this->nClave."'";
					}
					$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
					$oAccesoDatos->desconecta();
				}
			}
		return $nAfectados;
	}
	function AllAdmnin(){
		$oConexion = new conexion();
		$oSearch = null;
		if($oConexion->conecta()){
			$sQuery = "SELECT * FROM Administrador";
			$oDatos = $oConexion->ejecutaConsulta($sQuery);
			if($oDatos){
				for ($i=0; $i < count($oDatos); $i++) {
					$sAdmin = new Usuario();
					$sAdmin->setClave($oDatos[$i][0]);
					$sAdmin->setNombre($oDatos[$i][2]);
					$sAdmin->setApePaterno($oDatos[$i][3]);
					$sAdmin->setApeMaterno($oDatos[$i][4]);
					$sAdmin->setEmail($oDatos[$i][5]);
					$sAdmin->setCompleto();
					$oSearch[$i] = $sAdmin;
				}
			}
		}
		return $oSearch;
	}
	function Eliminar(){
		$sQuery = "";

	}

	function Insertar(){
		$sQuery = "";
		if($this->sTipo == "admin"){
			$sQuery = "INSERT INTO Administrador
			(nCveAdmin,sContrasenia,sNombre,sApePaterno,sApeMaterno, sEmail) VALUES
			([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])";
		}
	}



	function InsertarCliente(){
		$oAccesoDatos=new conexion();
		$sQuery="";
		$nAfectados=-1;
				if ($oAccesoDatos->conecta()){
						$sQuery = "INSERT INTO Usuario (nCveUsu,sContrasenia,sNombre,sApePaterno,sApeMaterno,nTelefono,sDireccion,sEmail) 
						VALUES(null,'".$this->sPassword."','".$this->sNombre."','".$this->sApaterno."','".$this->sAmaterno."','".$this->nTelefono."','".$this->sDireccion."','".$this->sEmail."')";
					$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
					$oAccesoDatos->desconecta();
				}
			
		return $nAfectados;
	}




}
?>
