<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
		function busqueda($busqueda){
		$busqueda = "<title>Resultados de la busqueda: " . ucwords($busqueda) . "</title>";
		echo $busqueda;
	}
		busqueda($_GET['q']); ?>
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
								<form action="buscar" method="get" class="navbar-form navbar-right" role="search" >
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
		if(isset($_GET['q'])) {
	try { 
		$base=new PDO('mysql:host=localhost; dbname=db_comic', 'root', '');
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$base->exec("SET CHARACTER SET utf8");
		$buscar = $_GET['q'];
		$sql = "SELECT * FROM comic WHERE Nombre = :nombre";
		$resultado = $base->prepare($sql);
		$resultado->execute(array(':nombre' => $buscar));
		$fila= $resultado->fetchAll(PDO::FETCH_OBJ);
		if ($buscar==null):
			echo "<section class='container main'>
				<div class='row'>
					<div class='col-md-9 content-principal'>
						<div class='breadcrumb'>
							<h3>Debes escribir algo</h3>
						</div>
					";
		elseif(count($fila)):
				echo "<section class='container main'>
							<div class='row'>
								<div class='col-md-9 content-principal'>
									<div class='breadcrumb'>
										<h3>Resultado de la busqueda: " . $buscar . "</h3>
									</div>";
				foreach ($fila as $registros) {
								echo "<article class='post clearfix'>
											<a href='../".$registros->Id_c."/".$registros->Nombre."' class='thumb pull-left'>
												<img src='../images/portadas/".$registros->Imagen."'>
											</a>
											<h2>
												<a href='../".$registros->Id_c."/".$registros->Nombre."'>". $registros->Nombre ."</a>
											</h2>
											<p class='post-content text-justify'>
												".$registros->Sinopsis."  
											</p>
											<div class='btn-content'>
												<a href='../".$registros->Id_c."/".$registros->Nombre."' class='btn btn-primary'>Leer mas...</a>
											</div>
									</article>";
					}
	else: 
		echo "<section class='container main'>
			<div class='row'>
				<div class='col-md-9 content-principal'>
					<div class='breadcrumb'>
						<h3>No se encontro:<strong> " .$buscar . "</strong></h3>
					</div>
				";
	endif;
	
	include '../page/aside.php';
	include '../page/footer.php';
	echo "</div>";
		}catch(Exception $e){
			die('Error' . $e->getMessage());
			echo "Linea del error " . $e->getLine();
}

	}else{
		header("location: ../index.php");
	}

?>