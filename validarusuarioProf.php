<meta charset="UTF-8">

<?php

session_start();
require("conexion.php");

$username=$_POST['mail'];
$pass=$_POST['pass'];
	
$sql=mysqli_query($mysqli,"SELECT * FROM registroprofesores WHERE email='$username'");
if($f=mysqli_fetch_assoc($sql)){
	if($pass==$f['password_prof'])
	
	{
		$_SESSION['id_Registro_Profesores']=$f['id_Registro_Profesores'];
		$_SESSION['Nombre_profesor']=$f['Nombre_profesor'];
		

		header("Location:accesoProf.php");
	}
	
	else{
		echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
	
		echo "<script>location.href='FormularioProf.html'</script>";
	}
}

else{
	
	echo '<script>alert("ESTE USUARIO NO EXISTE, PORFAVOR REGISTRESE PARA PODER INGRESAR")</script> ';
	
	echo "<script>location.href='FormularioProf.html'</script>";	

}

	
?>