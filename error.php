<?php
/*************************************************************/
/* Archivo:  error.php
 * Objetivo: manejo de errores
 * Autor:    BAOZ
 *************************************************************/
session_start();
include_once("modelo/usuario.php");
include_once("modelo/ErroresAplic.php");
include_once("cabecera.php");
include_once("menu.php");
$oErr = new ErroresAplic();
?>
        <section>
			<h1>Error</h1>
			<h4>
				<?php 
					if (isset($_REQUEST["nError"])){
						$oErr->setError($_REQUEST["nError"]);
						echo $oErr->getTextoError();
					}else{
						echo "Otro error";
					}
				?>
			</h4>
			<?php
				if (isset($_SESSION["usuario"])){
			?>
				<a href="index.php">Regresar al inicio</a>
			<?php
				}else{
			?>
				<a href="index.php">Regresar al inicio</a>
			<?php
				}
			?>
		</section>
<?php
include_once("pie.html");
?>