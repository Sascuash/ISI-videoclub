<?php
	include ("php/classVideo.php");
	$video=new classVideo();
	session_start();

	if ($_POST["btnSeleccionar"]=="Seleccionar") {
		$_SESSION["idVideoclub"]=$_POST["selVideoclub"];
		header("location: alta.php");
	}
?>

<?php include ("header.php"); ?>

 	<h1>Para comenzar el&iacute;ge un videoclub:</h1>
 	<h4>Podr&aacute;s alquilar pel&iacute;culas del videoclub seleccionado.</h4>
 	<div class="row-fluid">
		<div class="span6">

 			<h2>Elegir Videoclub</h2>
 			<form method="post" action="">
				<h4><img src="img/video.png" alt="videoclub" class="img-circle">&emsp;Listado de videoclubs:</h4>
				<p>
					<?php echo $video->listaVideoclubs(); ?>
				</p>
 				
 				<p>
 					<label>&nbsp;</label>
 					<input class="btn btn-primary" type="submit" value="Seleccionar" id="btnSeleccionar" name="btnSeleccionar"/>
 				</p>
 			</form>
 		</div>
 		<div class="span6">
 			<h2>Alta administrador:</h2>
 			<p>
 				<label>Nombre</label>
 				<input type="text" name="txtSocio" value="" id="txtSocio"/>
 			</p>
 			<p>
 				<label>Edad</label>
 				<input type="text" name="txtEdad" value="" id="txtEdad"/>
 			</p>
 			<p>
 				<label>&nbsp;</label>
 				<input class="btn btn-success" type="submit" value="Guardar" id="btnEnviar" name="btnEnviar"/>
 			</p>
 		</div>
 	</div>

<?php include ("footer.php"); ?>