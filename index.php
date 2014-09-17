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

 		<?php echo '<p>Query para ver videoclubs registrados</p>'; ?>

 		<h2>Elegir Videoclub</h2>

 		<form method="post" action="">
			<h2>Listado de videoclubs</h2>
			<p>
				<?php echo $video->listaVideoclubs(); ?>
			</p>
 			
 			<p>
 				<label>&nbsp;</label>
 				<input type="submit" value="Seleccionar" id="btnSeleccionar" name="btnSeleccionar"/>
 			</p>
 		</form>

 		<h2>Alta administrador</h2>


<?php include ("footer.php"); ?>