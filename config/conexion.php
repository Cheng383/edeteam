<?php
		$base=new PDO('mysql:host=localhost; dbname=db_comic', 'root', '');
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$base->exec("SET CHARACTER SET utf8");
		
?>
