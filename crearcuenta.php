<!doctype html>
<html lang="en">
  <head>
    <title>Create account on database</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
<body>

<div class="container">

	<?php

	include 'conexionbd.php';

	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_select_db($dbname, $conn);
	// checar conexion
	if (!$conn) {
		die("Connection failed: " . mysql_connect_error());
	}
	
	// consulta para comprobar si el correo electronico ya existe 
	$checkEmail = "SELECT * FROM alumno WHERE email = '$_POST[email]' ";
	//variable $resultado mantener los datos de conexión y la consulta
	// $result = $conn-> mysqli_query($checkEmail);
	$result = mysql_query($checkEmail, $conn);
	// Variable $count hold the result of the query.mantener el resultado de la consulta
	$count = mysql_num_rows($result);

	// If count == 1 Eso significa que el correo ya esta en la base de datos.
	if ($count == 1) {
	echo "<div class='alert alert-warning mt-4' role='alert'>
					<p>That email is already in our database.</p>
					<p><a href='login.html'>Please login here</a></p>
				</div>";
	} else {	
	
	/*
	If the email don't exist, the data from the form is sended to the
	database and the account is created. si el correo no existe los datos del formulario se envian a la bd y se crea la cuenta.
	*/
	$name= $_POST['name'];
	$email= $_POST['email'];
	$pass= $_POST['password'];
	
	// The password_hash() function convert the password in a hash before send it to the database.la funcion password convierte la contraseña en un hash antes de enviarla a la bd

	
	// Query to send Name, Email and Password hash to the database.consulta para enviar hash de nombre,correo y contraseña ala bd
	$query = "INSERT INTO alumno (name, email, password) VALUES ('$name', '$email', '$pass')";

	if (mysql_query($checkEmail, $conn)) {
		echo "<div class='alert alert-success mt-4' role='alert'><h3>Your account has been created.</h3>
		<a class='btn btn-outline-primary' href='index.html' role='button'>Login</a></div>";		
		} else {
			echo "Error: " . $query . "<br>" . mysql_error($conn);
		}	
	}	
	mysql_close($conn);
	?>
</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>