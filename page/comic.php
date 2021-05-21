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
						<a href="../index" class="navbar-brand"><img src="../img/logo1.png"></a>
					</div>
					<!-- MENU -->
					<div class="collapse navbar-collapse" id="navegacion-sg">
					<ul class="nav navbar-nav pull-right">
							<li class="active"><a href="../index">Inicio</a></li>
							<li><a href="../pages/lista-de-comics">Lista de comics</a></li>
							<li>
								<form action="../busqueda/buscar" method="get" class="navbar-form navbar-right" role="search" >
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
											<a class="hidden-sm hidden-md hidden-lg" href="../login/login">Iniciar sesion</a>
<a class="hidden-sm hidden-md hidden-lg" href="../login/login">Registrate</a>
<div class="dpdwmr hidden-xs">
	<button onclick="myFunction()" class="btn btn-info btn-button">Login</button>
	<div id="myDropdown" class="dropdown-content arrow">
	    <div class="dpdw-title">
	    	Iniciar Sesion
	    </div>
	    <div class="form-group">
	    	<a href="../login/login"><input type="button" class="btn btn-info btn-dpdw" value="Iniciar sesion"></a>
	   	</div>
	   	<a href="../login/registro"><input type="button" class="btn btn-primary btn-dpdw" value="Registrate"></a>
	</div>
</div>
											<?php 
												}else{ ?>
													<a class="hidden-sm hidden-md hidden-lg" href="../admin/administracion">Administracion</a>
<a class="hidden-sm hidden-md hidden-lg" href="../page/perfil">Perfil</a>
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
		<a href="../admin/administracion" class="btn btn-success btn-dpdw">Administración</a>
	</div>
	<div class="form-group">
		<a href="../page/perfil" class="btn btn-success btn-dpdw">Perfil</a>
	</div>
	<a href="../form/logout"><input type="button" class="btn btn-primary btn-dpdw" value="Cerrar Sesion"></a>
	</div>
												
								?>	
								<?php } ?>
							</li>
							
					</div>
				</div>
			</nav>
		</header>
<?php
if(isset($_GET['Id_c'])){
	try {

		include '../config/conexion.php';
		$Id = $_GET['Id_c'];
		$nombre = $_GET['Nombre'];
		
		
		$sql = "SELECT * FROM comic WHERE Id_c='". $Id ."'"AND" Nombre='".$nombre."'";
		$serie_info = $base->query($sql);
		if($crow=$serie_info->fetch(PDO::FETCH_ASSOC)){
			echo "<section class='container main'>
						<div class='row'>
							<div class='col-md-9 content-principal'>
								<article class='post clearfix'>
									<a href='' class='thumb pull-left'>
										<img src='../images/portadas/". $crow['Imagen'] ."'>					
									</a>
									<h1><a href='' class='breadcrumb'>". $crow['Nombre'] ."</a></h1>
									<h6><span>Autor: </span><a href=''>". $crow['NombreAutor'] ."</a></h6>
									<p class='post-content text-justify'>". $crow['Sinopsis'] ."</p>						
									</article>";
		
			echo"<div class='scroll'>
					<div class='panel panel-default''>
						<table class='table'>
							<div class='panel-heading'>Lista de Capitulos</div>";
			$lista_cap = $base->query("SELECT comic.Nombre,capitulos.Id_cap,capitulos.Nombre_cap,capitulos.Cap_url,capitulos.Id_comic FROM capitulos INNER JOIN comic ON capitulos.Id_comic = comic.Id_c  WHERE Id_comic ='" . $Id. "' ORDER BY capitulos.Nombre_cap DESC")->fetchAll(PDO::FETCH_OBJ);
			foreach ($lista_cap as $cap) {
							echo"<tr>
									<td>" . $cap->Nombre_cap . "</td>
									<td><a href='../page/capitulo?Id_cap=" . $cap->Id_cap . "'>Leer</a></td>
								</tr>";
			}
			echo "</table>
					</div>
				</div>";
		}
	}catch(Exception $e){
		die('Error' . $e->getMessage());
		echo "Linea del error " . $e->getLine();
	}
	include '../page/aside.php';
	include '../page/footer.php';
	}else{
		header("location:  ../index");
	}
?>