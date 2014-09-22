<?php
	include ("php/classVideo.php");
	$video=new classVideo();
	session_start();

	if ($_POST["btnEnviar"]=="Guardar") {
		$socio=$_POST["txtSocio"];
		$edad=$_POST["txtEdad"];
		
		$idSocioInsertado=$video->insertaSocio($socio, $edad, $idVideoclub, 0, "", "");
		$_SESSION["idSocio"]=$idSocioInsertado;
		header("location: alquiler.php");

	}
	if ($_POST["btnSeleccionar"]=="Seleccionar") {
		$_SESSION["idSocio"]=$_POST["selSocio"];
		header("location: alquiler.php");
	}

	if ($_POST["CrearVideoclub"]=="CrearVideoclub") {
		$txtNuevoGerente=$_POST["txtNuevoGerente"];
		$txtNuevoaCiudad=$_POST["txtNuevoaCiudad"];
		$txtNuevaDireccion=$_POST["txtNuevaDireccion"];
		$txtNuevoCP=$_POST["txtNuevoCP"];

		$video->insertaVideoclub($txtNuevoGerente, $txtNuevoaCiudad, $txtNuevaDireccion, $txtNuevoCP);

		?>
		<script type="text/javascript">
			alert("Videoclub insertado");
		</script>
		<?php
	}

?>
<?php include ("header.php"); ?>
	<form method="post" action="">
		<?php
			if ($idSocioInsertado>0) {
				?>
				<script type="text/javascript">
				alert("Se ha creado un socio con id: <?php echo $idSocioInsertado; ?>");
				</script>
				<?php
			}
		?>
 	<h2>Alta de Socios</h2>
 	<div class="row-fluid">
		<div class="span4">
 		<h3>Nuevo Socio:</h3>
 		
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
 		<div class="span4">
 			<h3>Socio Existente:</h3>
 			<p>
				<?php echo $video->listaSocios(); ?>
			</p>
 			<p>
 				<label>&nbsp;</label>
 				<input class="btn btn-primary" type="submit" value="Seleccionar" id="btnSeleccionar" name="btnSeleccionar"/>
 			</p>
 		</div>
 		<!--
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
 		//-->
 	</form>
<?php include ("footer.php"); ?>
