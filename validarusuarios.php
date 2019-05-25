<meta charset="UTF-8">

<?php

session_start();
require("conexion.php");

$username=$_POST['mail'];
$pass=$_POST['pass'];
	
$sql=mysqli_query($mysqli,"SELECT * FROM registroalumnos WHERE email='$username'");
if($f=mysqli_fetch_assoc($sql)){
	if($pass==$f['password'])
	
	{
		$_SESSION['id_Registro_Alumnos']=$f['id_Registro_Alumnos'];
		$_SESSION['Nombre']=$f['Nombre'];
		

		header("Location:accesoAlum.php");
	}
	
	else{
		echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
	
		echo "<script>location.href='FormularioAlum.html'</script>";
	}
}

else{
	
	echo '<script>alert("ESTE USUARIO NO EXISTE, PORFAVOR REGISTRESE PARA PODER INGRESAR")</script> ';
	
	echo "<script>location.href='FormularioAlum.html'</script>";	

}

	
?>