<?php
	include '../config/conexion.php';

	$codigo_Id = $_GET["Id_c"];
	$base->query("DELETE FROM comic WHERE Id_c=$codigo_Id");
	$base->query("DELETE FROM capitulos WHERE Id_comic=$codigo_Id");
	$base->query("DELETE FROM hojas WHERE Id_capitulo=$codigo_Id");
	header("location: ../admin/eliminar.php");
?>
