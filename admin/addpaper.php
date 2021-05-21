<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Agregar Hojas - Administracion</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<script type="text/javascript" src="../js/dpdw.js"></script>
	</head>
	<body>
		<?php 
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('location: ../login/login.');
	}
?>
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
							<li class="active"><a href="../index">Inicio</a></li>
							<li><a href="../pages/lista-de-comics">Lista de comics</a></li>
							<li>
								<form action="../busqueda/buscar" method="get" class="navbar-form navbar-right" role="search">
									<div class="search">
										<input type="text" placeholder="Buscar..." name="q">
										<button><img class="icon-search" src="../img/buscar.png"></button>
									</div>
								</form>
							</li>
							<li>
		 						<a class="hidden-sm hidden-md hidden-lg" href="../admin/administracion">Administracion</a>
								<a class="hidden-sm hidden-md hidden-lg" href="i../ncluir/perfil">Perfil</a>
								<a class="hidden-sm hidden-md hidden-lg" href="../form/logout">Cerrar sesion</a>
		 						<div class="dpdwmr hidden-xs">
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
	   										<a href="../admin/administracion" class="btn btn-danger btn-dpdw">Administración</a>
										</div>
										<div class="form-group">
	   										<a href="../incluir/perfil" class="btn btn-success btn-dpdw">Perfil</a>
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
		<section class="container main">
			<div class="row">
				<div class="col-md-9 panel-upload">
					<div class="breadcrumb">
						<h3>Agregar una Hoja</h3>
					</div>
					<form action="../form/insertpaper.php" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<input type="text" name="pagina" placeholder="Escribe el numero de la pagina" class="form-control">
						</div>
						<div class="form-group">
								<?php	
						try {
							include '../config/conexion.php';
							$sql = "SELECT * FROM capitulos";
							$lista_cap = $base->query($sql);
							echo "<select name='opciones' class='form-control'>";
							while ($rowCap=$lista_cap->fetch(PDO::FETCH_ASSOC)) {
								echo "<option value='". $rowCap['Id_cap'] ."'>". $rowCap['Nombre_cap'] ."";
							}
							echo "</select>";							
						} catch (Exception $e) {
							echo "Fallo la conexion";
							echo "Error en la linea: " .  $e->getMessage();
						}
						?>
						</div>
						<div class="form-group">
							<input type="text" name="url" class="form-control" placeholder="URL de la imagen">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary pull-right">Subir</button>
						</div>
					</form>
				</div>
				<aside class="col-md-3 sidebar-upload pull-right hidden-sm hidden-xs">
					<div class="breadcrumb">
						<h3>Opciones</h3>
					</div>
					<div class="sidebar-post">
						<div class="list-group">
							<a href="../admin/administracion" class="list-group-item">
   								Administracion
							</a>
							<a href="../admin/upload" class="list-group-item active">Subir Comic</a>
							<a href="../admin/mi-lista" class="list-group-item">Lista de Comics</a>
							<a href="../admin/eliminar" class="list-group-item">Eliminar Comics</a>
						</div>
					</div>
				</aside>
			</div>
		</section>
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