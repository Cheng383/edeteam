<?php include '../config/conexion.php'; 
		include '../config/functions.php';?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
		$nombre=$_GET['Cap_url'];
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
								<form action="buscar" method="get" class="navbar-form navbar-right" role="search" >
									<div class="search">
										<input type="text" placeholder="Buscar..." name="q">
										<button><span class="glyphicon glyphicon-search"></span></button>
									</div>
								</form>
							</li>
							<li>
										<?php 
										session_start();
								if(!isset($_SESSION['usuario'])){
											include '../page/btn-login.php';
												}else{ ?>
													<div class="dpdwmr">
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
												<?php } ?>
								?>	
							</li>
							
					</div>
				</div>
			</nav>
		</header>
<?php
	try{
		include '../config/conexion.php';
		$id = $_GET['Id_cap'];
		
		$tamano=1;
		if(isset($_GET['pagina'])){
			if($_GET['pagina']==1){
				header('location: capitulo/"'.$id.'"');
			}else{
				$page = $_GET['pagina'];
			}
		}else{
			$page=1;
		}
		$inicia = ($page-1)*$tamano;

		$sql = "SELECT capitulos.Id_cap,capitulos.Nombre_cap,hojas.Pagina,hojas.Id_capitulo,hojas.H_url FROM hojas INNER JOIN capitulos ON hojas.Id_capitulo = capitulos.Id_cap WHERE Id_cap = '" . $id . "'";
		$resultado = $base->prepare($sql);
		$resultado->execute(array());
		if ($crow=$resultado->fetch(PDO::FETCH_ASSOC)) {
			echo "<section class='container main'>
				<div class='row'>
					<div class='col-md-9 content-principal'>
						<div class='breadcrumb'>
							<h3>" . $crow['Nombre_cap'] ."</h3>
						</div>
						<article class='post clearfix'>
							<div class='box-cap'>
							<nav aria-label='Page navigation'>
											  <ul class='pagination'>";
		}
		$no_filas = $resultado->rowCount();
		$total_page = ceil($no_filas/$tamano);
		if($total_page==0){
			echo "<h1>Aun no hay paginas disponibles</h1>";
		}
		$resultado->closeCursor();

		$sql_limite = "SELECT capitulos.Id_cap,capitulos.Nombre_cap,capitulos.Cap_url,hojas.Pagina,hojas.Id_capitulo,hojas.H_url FROM hojas INNER JOIN capitulos ON hojas.Id_capitulo = capitulos.Id_cap WHERE Pagina='".$_GET['Pagina']."' AND Id_capitulo='".$_GET['Id_cap']."' LIMIT $inicia,$tamano";
		$resultado = $base->prepare($sql_limite);
		$resultado->execute(array());
		if($crow=$resultado->fetch(PDO::FETCH_ASSOC)) {
			echo"<img class='paper-img img-responsive'  src='". $crow['H_url'] ."'>";
		}
		//Paginacion
		for($i=1; $i<=$total_page; $i++){
			echo"<li class='";
			if ($_GET['Pagina']==$i){
				echo "active"; 
			}
			echo"'><a href='../".space($crow['Cap_url'])."".$crow['Id_cap']."-".$i . "'>".$i."</a></li>";
		}
		$resultado->closeCursor();
		$sqlnext = "SELECT * FROM capitulos";
		$resultado= $base->prepare($sqlnext);
		$resultado->execute(array());
		if($crow=$resultado->fetch(PDO::FETCH_ASSOC)){
		echo "
			<li><a href=''></a></li>
			</ul>
			</nav></div>
			</article>";
					}
	}catch(Exception $e){
		echo "Falló la conexión con la base de datos: " . $e->getMessage();
	}
	include 'aside.php';
	include 'footer.php';
?>