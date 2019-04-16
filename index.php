<?php
//session_start();
include_once("cabecera.php");
include_once("menu.php");

?>
<section id="section-portada" class="slider">
	<ul>
    <li><img id="portada" src="media/portada1.jpg" alt=""></li>
    <li><img id="portada" src="media/portada2.jpg" alt=""></li>
    <li><img id="portada" src="media/portada3.png" alt=""></li>
    <li><img id="portada" src="media/portada4.jpg" alt=""></li>
	</ul>
</section>
<?php
$_GLOBALS["tipo"] = "none";
include_once("control/explore.php");
?>
<section id="catalogo">
  <h1>Recomendaciones destacadas</h1>
  <?php
    $aux = array_reverse($producto);
    for ($i=0; $i < 9 ; $i++) { ?>
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