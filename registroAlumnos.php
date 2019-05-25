<?php

	$nombre=$_POST['nombre'];
	$mail=$_POST['correo'];
	$pass= $_POST['pass'];
	$rpass=$_POST['rpass'];
	$grupo=$_POST['grupo'];
	$generacion=$_POST['generacion'];

	require("connect_db.php");
//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
$checkemail=mysqli_query($mysqli,"SELECT * FROM registroalumnos WHERE email='$mail'");
$check_mail=mysqli_num_rows($checkemail);
	if($pass==$rpass){
		if($check_mail>0){
			echo ' <script language="javascript">alert("Atencion, ya existe el mail designado para un usuario, verifique sus datos");</script> ';
			echo "<script>location.href='FormularioAlum.html'</script>";
		}else{
				//require("connect_db.php");
//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
				mysqli_query($mysqli,"INSERT INTO registroalumnos VALUES('','$nombre','$mail','$pass','$grupo','$generacion')");
			
				echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
				echo "<script>location.href='FormularioAlum.html'</script>";
				
			}
			
		}else{
			echo 'Las contraseñas son incorrectas';
			
		}

	
?>