<?php 
try{
	include '../config/conexion.php';

	$nombre_User = htmlentities(addslashes($_POST['email']));
	$password = htmlentities(addslashes($_POST['pass']));
	$count = 0;

	//Consulta a la base de datos
	$sql = "SELECT * FROM usuarios WHERE Email = :email";

	$resultado = $base->prepare($sql);

	$resultado->execute(array(':email' => $nombre_User));
		while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
			if(password_verify($password, $registro['Password'])) {
				$count++;
			}

		}
		if ($count>0) {
			session_start();
			$_SESSION["usuario"] = $_POST["email"];
			header('location: ../page/perfil.php');
		}else{			
			header('location: ../login/login.php');
			
		}
		$resultado->closeCursor();
	}catch(exception $e){
		echo "linea" . $e->getMessage();
	}
?>