<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Lista de comics</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<script type="text/javascript" src="../js/dpdw.js"></script>
	</head>
	<body>

		<header>
			<!--Jumbotron-->
			
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-mr">
							<span class="sr-only">Deplegar / Ocultar menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="../index" class="navbar-brand"><img src="../img/logo1.png"></a>
					</div>
					<!-- MENU -->
					<div class="collapse navbar-collapse" id="navegacion-mr">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="../index">Inicio</a></li>
							<li class="active"><a href="../pages/lista-de-comics">Lista de comics</a></li>
							<li>
								<form action="../busqueda/buscar" method="get" class="navbar-form navbar-right" role="search">
									<div class="search">
										<input type="text" placeholder="Buscar..." name="q">
										<button><img class="icon-search" src="../img/buscar.png"></button>
									</div>
								</form>
							</li>
										
							<li>
										<?php 
										session_start();
								if(!isset($_SESSION['usuario'])){
											include '../page/btn-login.php';
												}else{ ?> 
											<div class="dpdwmr hidden-sm hidden-xs">
												<button onclick="myFunction()" class="btn btn-info btn-button">Opciones</button>
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
													<a href="../admin/administracion" class="btn btn-success btn-dpdw">Administración</a>
												</div>
												<div class="form-group">
													<a href="../page/perfil" class="btn btn-success btn-dpdw">Perfil</a>
												</div>
												<a href="../form/logout"><input type="button" class="btn btn-primary btn-dpdw" value="Cerrar Sesion"></a>
												</div>
												</div>
													<?php 	}?>	

		 					</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<section class="container main">
			<div class="row">
				<div class="col-md-9 content-principal">
					<div class="breadcrumb">
						<h3>Lista completa de Comics</h3>
					</div>
					
					<?php
						include '../config/conexion.php';
						require '../config/functions.php';
						$sql = "SELECT * FROM comic";
						$perfil_info = $base->query($sql);

						while($crow=$perfil_info->fetch(PDO::FETCH_ASSOC)){
							echo "<article class='post clearfix'>
										<a href='../". url($crow['Id_c'],$crow['Nombre']) ."' class='thumb pull-left'>
											<img src='../images/portadas/". $crow['Imagen'] . "'>
										</a>
										<h2>
											<a href='../". url($crow['Id_c'],$crow['Nombre']) ."'>". $crow['Nombre'] . "</a>
										</h2>
										<p class='post-content text-justify'>
											". $crow['Sinopsis'] . "
										</p>
										<div class='btn-content'>
											<a href='../". url($crow['Id_c'],$crow['Nombre']) ."' class='btn btn-primary'>Leer mas...</a>
										</div></article>";
							}
					?>
				
					

		<?php 	include '../page/aside.php'; ?>
<footer class="footer">
			<div class="container">
				<p><span>MrComic </span> Todos los derechos reservados.</p>
			</div>
		</footer>
		<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	</body>
</html>