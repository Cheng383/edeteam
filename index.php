<?php require 'config/functions.php'; ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>EdenTeam con el arte subir un comic</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script type="text/javascript" src="js/dpdw.js"></script>
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
						<a href="index" class="navbar-brand"><img src="img/logo1.png"></a>
					</div>
					<!-- MENU -->
					<div class="collapse navbar-collapse" id="navegacion-mr">
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="index">Inicio</a></li>
							<li><a href="pages/lista-de-comics">Lista de comics</a></li>
							<li>
								<form action="busqueda/buscar" method="get" class="navbar-form navbar-right" role="search">
									<div class="search">
										<input type="text" placeholder="Buscar..." name="q">
										<button><img class="icon-search" src="img/buscar.png"></button>
									</div>
								</form>
							</li>	
							<li>
							<?php 
								session_start();
								if(!isset($_SESSION['usuario'])){
							?>
							<a class="hidden-sm hidden-md hidden-lg" href="login/login">Iniciar sesion</a>
							<a class="hidden-sm hidden-md hidden-lg" href="login/login">Registrate</a>
								<div class="dpdwmr hidden-xs">
									<button onclick="myFunction()" class="btn btn-info btn-button">Login</button>
									<div id="myDropdown" class="dropdown-content arrow">
	    								<div class="dpdw-title">
	    									Iniciar Sesion
	   									</div>
	    								<div class="form-group">
	    									<a href="login/login"><input type="button" class="btn btn-info btn-dpdw" value="Iniciar sesion"></a>
	   									</div>
	   									<a href="login/registro"><input type="button" class="btn btn-primary btn-dpdw" value="Registrate"></a>
									</div>
								</div>
								<?php 
									}else{ ?>
									<a class="hidden-sm hidden-md hidden-lg" href="admin/administracion">Administracion</a>
									<a class="hidden-sm hidden-md hidden-lg" href="page/perfil">Perfil</a>
									<a class="hidden-sm hidden-md hidden-lg" href="form/logout">Cerrar sesion</a>
								<div class="dpdwmr hidden-xs">
									<button onclick="myFunction()" class="btn btn-info btn-button">Opciones</button>
									<div id="myDropdown" class="dropdown-content arrow">
									<?php
										include 'config/conexion.php';
										$sql = "SELECT * FROM usuarios WHERE Email = '" . $_SESSION['usuario'] . "'";
										$perfil_info = $base->query($sql);
										if($crow=$perfil_info->fetch(PDO::FETCH_ASSOC)){
											echo "<div class='dpdw-title'>
	  											Bienvenido " . $crow['NombreUser'] . "
	  										</div>";
										}
									?>
	   									<div class="form-group">
	   										<a href="admin/administracion" class="btn btn-danger btn-dpdw">Administración</a>
										</div>
										<div class="form-group">
	   										<a href="page/perfil" class="btn btn-success btn-dpdw">Perfil</a>
										</div>
										<a href="form/logout"><input type="button" class="btn btn-primary btn-dpdw" value="Cerrar Sesion"></a>
									</div>
								</div>
								<?php } ?>
							
						

		 					</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

<section class="jumbotron hidden-md hidden-sm hidden-xs">
	<div class="container">
		<ul class="col-md-12 cover-list">
			<?php 
			try {
				include 'config/conexion.php';
				$sql="SELECT * FROM comic ORDER BY RAND() LIMIT 6";
				$resultado = $base->prepare($sql);
				$resultado->execute(array());
				while($crow=$resultado->fetch(PDO::FETCH_ASSOC)) {
					echo "<li class='list'><a href='".url($crow['Id_c'],$crow['Nombre'])."'><img class='img-jumbo' src='images/portadas/". $crow['Imagen'] ."'></a></li>";
				}
			} catch (Exception $e) {
				echo "Falló la conexi+on a la base de datos." . $e->getMessage();
			}
			
			?>
		</ul>
	</div>
</section>
<section class="container main">
	<div class="row">
		<div class="col-md-9 content-principal">
			<div class="breadcrumb">
				<h3>Ultimos comics publicados</h3>
			</div>
			<ul class="list-group">
<?php 
	try {
		include 'config/conexion.php';
		$caps_post = "SELECT * FROM capitulos ORDER BY capitulos.Id_cap DESC LIMIT 20";
		$resultado = $base->prepare($caps_post);
		$resultado->execute(array());
		while($crow=$resultado->fetch(PDO::FETCH_ASSOC)) {
			echo "<li class='list-group-item'><a class='_TitInCap' href='".urlCap($crow['Cap_url'],$crow['Id_cap'])."-1'>" . $crow['Nombre_cap'] ."</a></li>";
		}
		$resultado->closeCursor();
		echo "</ul>";
	} catch (Exception $e) {
		echo "Falló la conexión con la base de datos: " . $e->getMessage();
	}
 ?>
</div>
 <aside class="col-md-3 sidebar pull-right hidden-sm hidden-xs">
					<div class="breadcrumb">
						<h3>Anime Random</h3>
					</div>
					<div class="sidebar-post">
						<ul class="list-group">
							<?php 
								try {
								include 'config/conexion.php';
								$sql="SELECT * FROM comic ORDER BY RAND() LIMIT 1";
								$resultado = $base->prepare($sql);
								$resultado->execute(array());
								while($crow=$resultado->fetch(PDO::FETCH_ASSOC)) {
									echo "<div class='thumbnail'>
											<a href='". url($crow['Id_c'],$crow['Nombre']) ."'><img width='242' height='200' src='images/portadas/". $crow['Imagen'] ."'></a>
											<div class='caption'>
												<h3><a href='". url($crow['Id_c'],$crow['Nombre']) ."'>" . $crow['Nombre'] . "</a></h3>
											</div>
										</div>";
								}
							} catch (Exception $e) {
								echo "Falló la conexi+on a la base de datos." . $e->getMessage();
							}
							
							?>
						</ul>
					</div>
				</aside>
		</div>
	</section>
		<section class="container">
			<div class="row">	
				<div class='content-principal col-md-12'>
					<div class="breadcrumb">
						<h3>Ultimos Comics Publicados</h3>
					</div>
					<?php
						try {
							include 'config/conexion.php';
							$comic_post = "SELECT * FROM comic ORDER BY comic.Id_c DESC LIMIT 8";
							$resultado = $base->prepare($comic_post);
							$resultado->execute(array());

							while ($crow=$resultado->fetch(PDO::FETCH_ASSOC)) {
								echo "<div class='col-sm-6 col-md-3'>
										<div class='thumbnail'>
											<a href='". url($crow['Id_c'],$crow['Nombre']) ."'><img width='242' height='200' src='images/portadas/". $crow['Imagen'] ."'></a>
											<div class='caption'>
												<h3><a href='". url($crow['Id_c'],$crow['Nombre']) ."'>" . $crow['Nombre'] . "</a></h3>
											</div>
											<p><a href='". url($crow['Id_c'],$crow['Nombre']) ."' class='btn btn-info' role='button'>Leer mas...</a>
										</div>
									</div>
									  ";
							}
						} catch (Exception $e) {
							echo "Falló la conexión con la base de datos: " . $e->getMessage();
						}
					?>		
				</div>
			</div>
		</section>
	<footer class="footer">
		<div class="container">
			<p><strong><span>MrComic </span></strong>Ninguna imagen esta alojada en nuestros servidores.</p>
		</div>
	</footer>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	</body>
</html>
<?php ?>
