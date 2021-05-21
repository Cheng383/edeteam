<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Inicia Sesion | Mr Comics</title>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div>
		<div class="logo">
			<a href="../index.php">
				<img src="../img/logo1.png">
			</a>
		</div>
		<div class="log">
			<form action="../form/registro.php" enctype="multipart/form-data" method="post">
				<h2>Registrate</h2>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email" name="email">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Nombre de Usuario" name="nombreUsuario">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Nombre de Autor" name="autor">
				</div>
				<div class="form-group">
					<input type="file" class="form-control" name="imagen">
					<h5>Tamaño recomendado (200x260)</h5>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" name="pass">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" class="form-control">Registrarse</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>