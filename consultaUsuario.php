<?php
	include ("php/classVideo.php");
	$video=new classVideo();
	session_start();
	
	if ($_POST["btnGenerar"]=="Generar") {
		// generamos el reporte a la fecha
		$idSocio=$_POST["selSocio"];
		$fechaActual=$_POST["txtFecha"];
		$video->generaReporte($idSocio, $fechaActual);
		$reporte=$video->muestraReportes($idSocio);

	}
?>
<?php include ("header.php"); ?>
	<form method="post" action="">
		<div class="row-fluid">
			<div class="span6">
				<h2>Seleccione el socio para obtener el reporte</h2>
 				<?php echo $video->listaSocios(); ?>
 				<p>
 				<label>Fecha de reporte</label>
 				<input type="text" name="txtFecha" id="txtFecha" value="<?php echo date("Y-m-d"); ?>">
 				</p>
 				<input class="btn btn-primary" type="submit" name="btnGenerar" id="btnGenerar" value="Generar"/>
 			</div>
 			<div class="span6">
 				<?php
 				if ($reporte) {
 					echo '<h3>Reporte de alquiler para el usuario '.$video->obtieneNombreSocio($idSocio).'</h3>';
 					echo $reporte;
 				}
 				?>
 			</div>
 		</div>
	</form>
 	
<?php include ("footer.php"); ?>