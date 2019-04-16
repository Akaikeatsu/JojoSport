<nav>
<?php
  if(isset($_SESSION["usuario"])){
    $oUsu = $_SESSION["usuario"];
    $sTipo = $oUsu->getTipo();
    if($sTipo=="Administrador"){  
?>
      <ul>    
        <li><a href="mostrar.php">ALTAS</a></li>
        <li><a href="mostrar.php">BAJAS</a></li>
        <li><a href="mostrar.php">C&Aacute;MBIOS</a></li>
        <li><a href="mostrar.php">CONSULTAS</a></li>
      </ul>
<?php 
    } else {
?>
      <ul>
        <li><a href="tabProducto.php">CATALOGO COMPLETO</a></li>   
        <li><a href="productosTipo.php?mtipo=balon">BALONES</a></li>
        <li><a href="productosTipo.php?mtipo=souvenir">SOUVENIRS</a></li>
      </ul>
<?php      
    }
  } else {  
?>
  <ul>
  <li><a href="tabProducto.php">CATALOGO COMPLETO</a></li>    
    <li><a href="productosTipo.php?mtipo=balon">BALONES</a></li>
    <li><a href="productosTipo.php?mtipo=souvenir">SOUVENIRS</a></li>
  </ul>
<?php 
  } 
?>
</nav>