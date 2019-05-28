<!DOCTYPE html>
<?php
	session_start();
	if (@!$_SESSION['Nombre_profesor']) {
		header("Location:FormularioProf.html");
	} 
	?>


    <title>Docentes</title>
  


<?php

include("cabeceraProf.php");

?>