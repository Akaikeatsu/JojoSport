<?php
include_once("modelo/usuario.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>JoJo's Sports</title>
        <meta charset="utf-8"/>
		<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="css/estilo.css" rel="stylesheet" type="text/css"/>
		<script src="js/varios.js"></script>
	</head>
	<body>
		<header>
        <?php
        if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
            $oUsu = $_SESSION["usuario"];
            $sTipo = $oUsu->getTipo();
                if($sTipo=="Cliente"){	?>
          			<div id="header-logo">
		   				<a href="index.php"><img id="logoJoJo" src="media/JoJo's Sports.png"></a>
           			</div>
          			<div id="buscador">
						<form class="search" action="productosTipo.php" method="post">
							<input type="search" name="mtipo"  placeholder="Ingresa el equipo o disciplina" id="busca" />
							<button type="submit">Buscar</button>
						</form>
          			</div>
             		<div id="menu-header">
						<ul>    
							<li><a href="control/logout.php"><img src="media/usuario.png">&nbsp;&nbsp;Cerrar Sesi&oacute;n</a></li>  
							<li><a href="carrito.php"><img src="media/carrito.png">&nbsp;&nbsp;Carrito</a></li>
						</ul>
                	</div>
	    <?php 	} else if($sTipo=="Administrador") { ?>
					<div id="header-logo">
		   				<a href=""><img id="logoJoJo" src="media/JoJo's Sports.png"></a>
           			</div>
        			<div id="menu-header">
						<ul>    
							<li><a href="control/logout.php"><img src="media/usuario.png">&nbsp;&nbsp;Cerrar Sesi&oacute;n</a></li>
						</ul>
                	</div>
      	<?php 	}
	    }else{	?>
	   		<div id="header-logo">
		   		<a href="index.php"><img id="logoJoJo" src="media/JoJo's Sports.png"></a>
           	</div>
           	<div id="buscador">
			   <form class="search" action="productosTipo.php" method="get">
							<input  type="search" name="mtipo"  placeholder="Ingresa el equipo o disciplina" id="busca" required/>
							<button type="submit">Buscar</button>
						</form>
          	</div>
            <div id="menu-header">
				<ul>    
					<li><a href="ingresar.php"><img src="media/usuario.png">&nbsp;&nbsp;Iniciar Sesi&oacute;n</a></li>
					<li><a href="#"><img src="media/carrito.png">&nbsp;&nbsp;Carrito</a></li>
				</ul>
            </div>
  <?php } ?>      
        </header>