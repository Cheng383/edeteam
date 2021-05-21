<?php
		$insert_nombre= $_POST["nombre"];
		$insert_id= $_POST["opciones"];
		$insert_url = $_POST["url"];
		try {
			$base=new PDO('mysql:host=localhost; dbname=db_comic', 'root', '');
			$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$base->exec("SET CHARACTER SET utf8");

			$sql="INSERT INTO capitulos (Nombre_cap, Id_comic, Cap_url) VALUES (:nombre, :id, :url)";
			
			$resultado=$base->prepare($sql);
			$resultado->execute(array(":nombre"=>$insert_nombre, ":id" =>$insert_id, ":url"=>$insert_url));
			$resultado->closeCursor();
		}catch(Exception $e){
			echo "Linea del error " . $e->getLine();
		}finally{
			$base=null;
		}
		header("location: ../admin/addcap.php");
?>