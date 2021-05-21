<?php 
	
	$email = $_POST["email"];
	$nombre_usuario = $_POST["nombreUsuario"];
	$autor = $_POST['autor'];
	$nombre_imagen = $_FILES["imagen"]["name"];
	$tipo_imagen = $_FILES["imagen"]["type"];
	$size_imagen = $_FILES["imagen"]["size"];
	if($size_imagen<=5000000) {
		if ($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/png" || $tipo_imagen=="image/gif") {
			
			//ruta imagen
			$carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/mrcomics/images/perfil/";
			//mover imagen del directorio temporal a directorio escogido
			move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino.$nombre_imagen);
		}
	}

	$pass = $_POST['pass'];
	//Encriptado
	$pass_encrypt = password_hash($pass, PASSWORD_DEFAULT, array('cost' =>9));


	try {
		//Consulta a la base de datos
		include '../config/conexion.php';
		$consulta="INSERT INTO usuarios(Email, NombreUser, Autor, Imagen_user, Password) VALUES (:email, :nombreUsuario, :autor, :imagenUser, :pass)";

		$resultado=$base->prepare($consulta);
		$resultado->execute(array(':email' => $email, ':nombreUsuario' => $nombre_usuario, ':autor' => $autor, ':imagenUser' => $nombre_imagen, ':pass' => $pass_encrypt));
		$resultado->closeCursor();
	}catch(exception $e){
		echo "Error en la linea: " . $e->getMessage();
	}
	header('location: ../login/regis_ok.php');
?>