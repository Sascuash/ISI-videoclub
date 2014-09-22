<?php
	include ("php/classVideo.php");
	$video=new classVideo();
	session_start();

	if ($_POST["btnSeleccionar"]=="Seleccionar") {
		$_SESSION["idVideoclub"]=$_POST["selVideoclub"];
		header("location: alta.php");
	}

	if ($_POST["CrearVideoclub"]=="CrearVideoclub") {
		$txtNuevoGerente=$_POST["txtNuevoGerente"];
		$txtNuevoaCiudad=$_POST["txtNuevoaCiudad"];
		$txtNuevaDireccion=$_POST["txtNuevaDireccion"];
		$txtNuevoCP=$_POST["txtNuevoCP"];

		$idVideo=$video->insertaVideoclub($txtNuevoGerente, $txtNuevoaCiudad, $txtNuevaDireccion, $txtNuevoCP);
		$_SESSION["idVideoclub"]=$idVideo;
		?>
		<script type="text/javascript">
			alert("Videoclub insertado");
		</script>
		<?php
	}

?>

<?php include ("header.php"); ?>

 	<h1>Para comenzar el&iacute;ge un videoclub:</h1>
 	<h4>Podr&aacute;s alquilar pel&iacute;culas del videoclub seleccionado.</h4>
 	<div class="row-fluid">
		<div class="span4">

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
 		<div class="span4">
 			<h3>Nuevo videoclub:</h3>
 			<form method="post" action="">
				<p>
 					<label>Nombre gerente:</label>
 					<input type="text" name="txtNuevoGerente" value="" id="txtNuevoGerente"/>
 				</p>
 				<p>
 					<label>Nombre ciudad:</label>
 					<input type="text" name="txtNuevoaCiudad" value="" id="txtNuevoaCiudad"/>
 				</p>
 				<p>
 					<label>Direccion:</label>
 					<input type="text" name="txtNuevaDireccion" value="" id="txtNuevaDireccion"/>
 				</p>
 				<p>
 					<label>Codigo postal:</label>
 					<input type="text" name="txtNuevoCP" value="" id="txtNuevoCP"/>
 				</p>
 				<p>
 					<label>&nbsp;</label>
 					<input class="btn btn-success" type="submit" value="CrearVideoclub" id="CrearVideoclub" name="CrearVideoclub"/>
 				</p>
 			</form>
 		</div>
 		<div class="span4">
 			<h3>Alta administrador:</h3>
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