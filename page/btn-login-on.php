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
		<a href="admin/administracion" class="btn btn-success btn-dpdw">Administración</a>
	</div>
	<div class="form-group">
		<a href="incluir/perfil" class="btn btn-success btn-dpdw">Perfil</a>
	</div>
	<a href="form/logout"><input type="button" class="btn btn-primary btn-dpdw" value="Cerrar Sesion"></a>
	</div>
	</div>