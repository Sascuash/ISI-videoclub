<?php
	$videoHeader=new classVideo();
	session_start();
?>
<html>
	<head>
 		<title>Selección de videoclub</title>
 		<meta name="viewport" content="width=device-width, initial-scale=1.0">
      	<!-- Bootstrap -->
      	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
      	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
      	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

      	<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header" style="margin-top:14px;margin-bottom:5px;">
			    <font size=6>Videoclub</font>&emsp;
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-left" style="margin-top:4px;">
		        <li class="active"><a href="index.php">Inicio</a></li>
				<li><a href="alta.php">Alta</a></li>
				<li class="active"><a href="alquiler.php">Alquiler</a></li>
				<li><a href="consultaUsuario.php">Consulta</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right" style="margin-top:4px;">
		      	<?php
			    echo '<li class="active"><a>';
				if (isset($_SESSION["idSocio"])) {
					echo 'Socio actual: '.$videoHeader->obtieneNombreSocio($_SESSION["idSocio"]).' ';
				}
				echo '&emsp;&emsp;';
				if (isset($_SESSION["idVideoclub"])) {
					echo 'Videoclub actual: '.$videoHeader->obtieneNombreVideoclub($_SESSION["idVideoclub"]).' ';
				}
				echo '</a></li>';
			?>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

	</head>
	<body style="margin-left:5%; margin-right:5%;">

		