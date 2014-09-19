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
		<div class="span6">
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
 		<div class="span6">
 			<h3>Socio Existente:</h3>
 			<p>
				<?php echo $video->listaSocios(); ?>
			</p>
 			<p>
 				<label>&nbsp;</label>
 				<input class="btn btn-primary" type="submit" value="Seleccionar" id="btnSeleccionar" name="btnSeleccionar"/>
 			</p>
 		</div>
 	</form>
<?php include ("footer.php"); ?>
