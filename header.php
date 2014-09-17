<html>
	<head>
 		<title>Selección de videoclub</title>
 		<meta name="viewport" content="width=device-width, initial-scale=1.0">
      	<!-- Bootstrap -->
      	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<h1>Videoclub</h1>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="alta.php">Alta</a></li>
			<li><a href="alquiler.php">Alquiler</a></li>
			<li><a href="consultaUsuario.php">Consulta</a></li>
		</ul>
		<?php
			if (isset($_SESSION["idSocio"])) {
				echo '<p>Socio actual: '.$_SESSION["idSocio"].'</p>';
			}
			if (isset($_SESSION["idVideoclub"])) {
				echo '<p>Videoclub actual: '.$_SESSION["idVideoclub"].'</p>';
			}
		?>
		