<?php
include_once("cabecera.php");
include_once("menu.php");
?>

<section id="section-ingresar">


<form class="login" action="control/login.php" method="POST">
	<h1>Iniciar Sesi&oacute;n</h1>
	<label for="Email">Correo Electr&oacute;nico</label></br>
	<input id="ingresar-datos" type="email" name="Email" required></br> <br>
	<label for="Password">Contrase&ntilde;a</label></br> 
	<input id="ingresar-datos" type="password" name="Password" required></br> </br>
	<input id="mandar-datos" type="submit" value="Ingresar">
	<br><br><br>
	<a href="registrarse.php">&#191;No tienes cuenta? Reg&iacute;strate</a>
</form> 


</section>


<?php
include_once("pie.html");
?>