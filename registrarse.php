<?php
include_once("cabecera.php");
include_once("menu.php");
?>

<section id="section-registrar">


<form action="control/register.php" method="POST">
<h1>Crear Cuenta</h1>

<label for="Nombre">Nombre</label><br>
<input id="ingresar-datos" type="text" name="Nombre" required></br> </br> 

<label for="ApellidoP">Apellido Paterno</label><br>
<input id="ingresar-datos" type="text" name="ApellidoP" required></br></br> 

<label for="ApellidoM">Apellido Materno</label><br>
<input id="ingresar-datos" type="text" name="ApellidoM" required></br></br> 

<label for="Tel">Tel&eacute;fono de casa</label><br>
<input id="ingresar-datos" type="tel" name="Tel" required></br> </br> 

<label for="Dir">Direcci&oacute;n</label><br>
<input id="ingresar-datos" type="text" name="Dir" required></br> </br> 

<label for="Email">Correo Electr&oacute;nico</label><br>
<input id="ingresar-datos" type="email" name="Email" required></br> </br>

<label for="Contrasena">Contrase&ntilde;a</label><br>
<input id="ingresar-datos" type="password" name="Contrasena" required></br> </br>

<input id="mandar-datos" type="submit" value="Crear">
<br><br>
</form>
</section>


<?php
include_once("pie.html");
?>