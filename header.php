<html>
	<head>
 		<title>Selección de videoclub</title>
 		<meta name="viewport" content="width=device-width, initial-scale=1.0">
      	<!-- Bootstrap -->
      	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
      	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

      	<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header" style="margin-top:14px;">
			    <font size=6>Videoclub</font>&emsp;
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav" style="margin-top:4px;">
		        <li class="active"><a href="index.php">Inicio</a></li>
				<li><a href="login.php">Login</a></li>
				<li class="active"><a href="alta.php">Alta</a></li>
				<li><a href="alquiler.php">Alquiler</a></li>
				<li class="active"><a href="consultaUsuario.php">Consulta</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

	</head>
	<body style="margin-left:5%; margin-right:5%;">
		<div class="row">
			<?php
			    echo '<p>';
				if (isset($_SESSION["idSocio"])) {
					echo 'Socio actual: '.$_SESSION["idSocio"].' ';
				}
				echo ' ';
				if (isset($_SESSION["idVideoclub"])) {
					echo 'Videoclub actual: '.$_SESSION["idVideoclub"].' ';
				}
				echo '</p>';
			?>
		</div>
		