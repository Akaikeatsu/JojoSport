<?php
$_GLOBALS["tipo"] = $_GET["mtipo"];
include_once("cabecera.php");
include_once("menu.php");
include_once("control/explore.php");
//session_start();
?>

<section id="catalogo">
<h1>Recomendaciones destacadas</h1>
<?php
    $aux = array_reverse($producto);
    for ($i=0; $i < count($aux) ; $i++) {
?>
        <div id="productoMuestra">
            <img src="<?php echo $aux[$i]->getImagen();?>"> <br>
            <label id="nombre"> <?php echo $aux[$i]->getNombre();?></label><br>
            Equipo:&nbsp;&nbsp;<?php echo $aux[$i]->getEquipo();?><br>
            Disciplina:&nbsp;&nbsp;<?php echo $aux[$i]->getDisciplina();?><br>
<?php
            if(isset($_SESSION["usuario"])){
                echo "$".$aux[$i]->getPrecio();
            }
?>

            <br><br>
            <label id="detalles"> <a href="detalleProducto.php?clv=<?php echo $aux[$i]->getClave();?>">Detalles</a> </label>
        </div>
<?php
    }
?>
<p>Después de visitar las páginas de detalles de productos, consulta aquí para volver fácilmente a las páginas que te han interesado.</p>  
</section>
<?php
include_once("pie.html");
?>