<?php include '../config/conexion.php';
	include '../config/functions.php';
 ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
		$nombre=$_GET['Nombre'];
		titulo($nombre); ?>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<script type="text/javascript" src="../js/dpdw.js"></script>
	</head>
	<body>

		<header>
			<!--Jumbotron-->
			
			<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-mr">
						<span class="sr-only">Desplegar Menu / Ocultar Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
						<a href="../index.php" class="navbar-brand"><img src="../img/logo1.png"></a>
					</div>
					<!-- MENU -->
					<div class="collapse navbar-collapse" id="navegacion-sg">
					<ul class="nav navbar-nav pull-right">
							<li class="active"><a href="../index.php">Inicio</a></li>
							<li><a href="../pages/lista-de-comics.php">Lista de comics</a></li>
							<li>
								<form action="buscar.php" method="get" class="navbar-form navbar-right" role="search" >
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
											?>
											<a class="hidden-sm hidden-md hidden-lg" href="../login/login.php">Iniciar sesion</a>
<a class="hidden-sm hidden-md hidden-lg" href="../login/login.php">Registrate</a>
<div class="dpdwmr hidden-xs">
	<button onclick="myFunction()" class="btn btn-info btn-button">Login</button>
	<div id="myDropdown" class="dropdown-content arrow">
	    <div class="dpdw-title">
	    	Iniciar Sesion
	    </div>
	    <div class="form-group">
	    	<a href="../login/login.php"><input type="button" class="btn btn-info btn-dpdw" value="Iniciar sesion"></a>
	   	</div>
	   	<a href="../login/registro.php"><input type="button" class="btn btn-primary btn-dpdw" value="Registrate"></a>
	</div>
</div>
											<?php 
												}else{ ?>
													<a class="hidden-sm hidden-md hidden-lg" href="../admin/administracion.php">Administracion</a>
<a class="hidden-sm hidden-md hidden-lg" href="../page/perfil.php">Perfil</a>
<a class="hidden-sm hidden-md hidden-lg" href="../form/logout.php">Cerrar sesion</a>
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
		<a href="../admin/administracion.php" class="btn btn-success btn-dpdw">Administración</a>
	</div>
	<div class="form-group">
		<a href="../page/perfil.php" class="btn btn-success btn-dpdw">Perfil</a>
	</div>
	<a href="../form/logout.php"><input type="button" class="btn btn-primary btn-dpdw" value="Cerrar Sesion"></a>
	</div>
												
								?>	
								<?php } ?>
							</li>
							
					</div>
				</div>
			</nav>
		</header>