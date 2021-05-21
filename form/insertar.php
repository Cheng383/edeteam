<?php
		$insert_nombre= $_POST["nombre"];
		$insert_autor= $_POST["autor"];
		$insert_genero= $_POST["genero"];
		$insert_estado= $_POST["estado"];
		$insert_sinopsis= $_POST["sinopsis"];
		$ID = $_POST["id"];

		$nombre_imagen = $_FILES["imagen"]["name"];
		$tipo_imagen = $_FILES["imagen"]["type"];
		$size_imagen = $_FILES["imagen"]["size"];
		if($size_imagen<=5000000) {
			if ($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/png" || $tipo_imagen=="image/gif") {
			
				//ruta imagen
				$carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/mrcomics/images/portadas/";
				//mover imagen del directorio temporal a directorio escogido
				move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino.$nombre_imagen);
			}
		}

		try {
			$base=new PDO('mysql:host=localhost; dbname=db_comic', 'root', '');
			$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$base->exec("SET CHARACTER SET utf8");

			$sql="INSERT INTO comic (Nombre, Id_autor, NombreAutor, Generos, Imagen, Estado, Sinopsis) VALUES (:nombre, :id, :autor, :generos, :imagen, :estado, :sinopsis)";
			
			$resultado=$base->prepare($sql);
			$resultado->execute(array(":nombre"=>$insert_nombre, ":id" =>$ID, ":autor"=>$insert_autor, ":generos"=>$insert_genero, ":imagen"=>$nombre_imagen, ":estado"=>$insert_estado, ":sinopsis"=>$insert_sinopsis));
			$resultado->closeCursor();
		}catch(Exception $e){
			echo "Linea del error " . $e->getLine();
		}finally{
			$base=null;
		}
		header("location: ../admin/upload.php");
?>