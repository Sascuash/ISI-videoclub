<?php
	include ("php/classVideo.php");
	$video=new classVideo();

	if ($_POST["btnEnviar"]=="Guardar") {
		$socio=$_POST["txtSocio"];
		$edad=$_POST["txtEdad"];
		
		$idSocioInsertado=$video->insertaSocio($socio, $edad, $idVideoclub, 0, "", "");

	}
?>
<?php include ("header.php"); ?>
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
 		<form method="post" action="">
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
 				<input type="submit" value="Guardar" id="btnEnviar" name="btnEnviar"/>
 			</p>
 		</form>

<?php include ("footer.php"); ?>
