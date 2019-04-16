<?php
include_once("cabecera.php");
include_once("menu.php");
include_once("control/details.php");
//session_start();
$aux = $producto;
?>

<br>

<section id="infoProducto">


  <div id="imagenProducto">
  <img src="<?php echo $aux->getImagen();?>">
  </div>


  <div id="detallesProducto">
     <h1><?php echo $aux->getNombre();?></h1>

    <?php
        if(isset($_SESSION["usuario"])){ ?>
            <h2><?php echo "$".$aux->getPrecio(); ?></h2> 
       <?php
        }
    ?>
      
        <img src="media/tarjetas.png" alt=""><br> <br>
        <img src="media/auto.png" alt=""> <br><br>
        Talla:&nbsp;&nbsp;<?php echo $aux->getTalla();?><br><br>
        Tamaño:&nbsp;&nbsp;<?php echo $aux->getSize();?><br><br>
        Color:&nbsp;&nbsp;<?php echo $aux->getColor();?><br><br>
        Tipo:&nbsp;&nbsp;<?php echo $aux->getTipo();?><br><br>
        Equipo:&nbsp;&nbsp;<?php echo $aux->getEquipo();?><br><br>
        Disciplina:&nbsp;&nbsp;<?php echo $aux->getDisiplina();?><br><br>
        G&eacute;nero:&nbsp;&nbsp;<?php echo $aux->getGenero();?><br><br><br>
        
        <a href="">Agregar al Carrito</a>
        

  </div>

          
</section>
<?php
include_once("pie.html");
?>