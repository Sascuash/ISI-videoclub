<html>
	<head>
 		<title>Selección de videoclub</title>
 		<meta name="viewport" content="width=device-width, initial-scale=1.0">
      	<!-- Bootstrap -->
      	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">

      	<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
			    <font size=6>Videoclub</font>
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a href="index.php">Inicio</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="alta.php">Alta</a></li>
				<li><a href="alquiler.php">Alquiler</a></li>
				<li><a href="consultaUsuario.php">Consulta</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

	</head>
	<body style="margin-left:5%; margin-right:5%;">
		<?php
			if (isset($_SESSION["idSocio"])) {
				echo '<p>Socio actual: '.$_SESSION["idSocio"].'</p>';
			}
			if (isset($_SESSION["idVideoclub"])) {
				echo '<p>Videoclub actual: '.$_SESSION["idVideoclub"].'</p>';
			}
		?>
		