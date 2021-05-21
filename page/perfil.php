<!DOCTYPE html>
<html lang="es">
	<head>
		<title> | Mr comic</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<script type="text/javascript" src="../js/dpdw.js"></script>
	</head>
	<body>
<?php 
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('location: ../login/login');
	}
?>
		<header>
			<!--Jumbotron-->
			
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapase" data-target="#navegacion-mr">
							<span class="sr-only">Deplegar / Ocultar menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="../index.php" class="navbar-brand"><img src="../img/logo1.png"></a>
					</div>
					<!-- MENU -->
					<div class="collapse navbar-collapse" id="navegacion-mr">
						
						<ul class="nav navbar-nav pull-right">
							<li class="active"><a href="../index">Inicio</a></li>
							<li><a href="../pages/lista-de-comics">Lista de comics</a></li>
							<li>
								<form action="../busqueda/buscar" method="get" class="navbar-form navbar-right" role="search" >
									<div class="search">
										<input type="text" placeholder="Buscar..." name="q">
										<button><span class="glyphicon glyphicon-search"></span></button>
									</div>
								</form>
							</li>
							
							<li>
		 						<div class="dpdwmr">
									<button onclick="myFunction()" class="btn btn-info btn-button">opciones</button>
									<div id="myDropdown" class="dropdown-content arrow">
										<?php
											include '../config/conexion.php';
											$sql = "SELECT * FROM usuarios WHERE Email = '" . $_SESSION['usuario'] . "'";
											$perfil_info = $base->query($sql);

											if($crow=$perfil_info->fetch(PDO::FETCH_ASSOC)){
												echo "<div class='dpdw-title'>
	  												Bienvenido " . $crow['NombreUser'] . "
	  											</div>";
											}
										?>
										
	   									<div class="form-group">
	   										<a href="../admin/administracion" class="btn btn-danger btn-dpdw">Administración</a>
										</div>
										<div class="form-group">
	   										<a href="../page/perfil" class="btn btn-success btn-dpdw">Perfil</a>
										</div>
										<a href="../form/logout"><input type="button" class="btn btn-primary btn-dpdw" value="Cerrar Sesion"></a>
									</div>
								</div>

		 					</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
<?php
	try {
		require '../config/conexion.php';
		require '../config/functions.php';
		$sql = "SELECT * FROM usuarios WHERE Email = '" . $_SESSION['usuario'] . "'";
		$perfil_info = $base->query($sql);

			if($crow=$perfil_info->fetch(PDO::FETCH_ASSOC)){
				echo "<section class='container main'>
							<div class='row'>
								<div class='col-md-9 content-principal'>
									<article class='post clearfix'>
										<a class='thumb thumbnail pull-left'>
											<img src='../images/perfil/". $crow['Imagen_user'] ."'>					
										</a>
										<h1><a  class='breadcrumb'>". $crow['NombreUser'] ."</a></h1>
										<h6><span>Autor: </span><a>". $crow['Autor'] ."</a></h6>
										<p class='post-content text-justify'></p>						
										</article>";
			
		
		echo "<div class='panel '>
	<table class='table'>
							<tr>
								<th>Nombre del Comic</th>
								<th>Autor</th>
								<th>Generos</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>";
							$lista_cap = $base->query("SELECT usuarios.Autor,comic.Id_c,comic.Nombre,comic.Id_autor,comic.Generos,comic.Estado FROM usuarios INNER JOIN  comic ON usuarios.Id =  comic.Id_autor WHERE  Id = '" . $crow['Id'] . "' ")->fetchAll(PDO::FETCH_OBJ);
							

							foreach ($lista_cap as $cap) {							
								
							echo "<tr>
								<td>". $cap->Nombre . "</td>
								<td>". $cap->Autor . "</td>
								<td>". $cap->Generos . "</td>
								<td>". $cap->Estado . "</td>
								<td><a href='../". url($cap->Id_c,$cap->Nombre)."'><span class='glyphicon glyphicon-eye-open'></span></a></a></td>
							</tr> ";
						}
					}
		}catch(Exception $e){
			die('Error' . $e->getMessage());
			echo "Linea del error " . $e->getLine();
	}

?>
</table>
					</div>
						
						
<?php 	include '../page/aside.php';
	include '../page/footer.php'; ?>