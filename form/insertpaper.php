<?php
		$insert_pagina= $_POST["pagina"];
		$insert_id= $_POST["opciones"];
		$insert_url = $_POST["url"];
		try {
			$base=new PDO('mysql:host=localhost; dbname=db_comic', 'root', '');
			$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$base->exec("SET CHARACTER SET utf8");

			$sql="INSERT INTO hojas (Pagina, Id_capitulo, H_url) VALUES (:pagina, :id, :url)";
			
			$resultado=$base->prepare($sql);
			$resultado->execute(array(":pagina"=>$insert_pagina, ":id" =>$insert_id, ":url"=>$insert_url));
			$resultado->closeCursor();
		}catch(Exception $e){
			echo "Linea del error " . $e->getLine();
		}finally{
			$base=null;
		}
		header("location: ../admin/addpaper.php");
?>