<!DOCTYPE html>
<?php
	session_start();
	if (@!$_SESSION['Nombre']) {
		header("Location:FormularioAlum.html");
	} 
	?>


    <title>Alumnos</title>
  


<?php

include("cabecera.php");

?>