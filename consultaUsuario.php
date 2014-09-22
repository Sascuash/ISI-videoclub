<?php
	include ("php/classVideo.php");
	$video=new classVideo();
	session_start();
	$idReporte=0;
	if ($_POST["btnGenerar"]=="Generar") {
		// generamos el reporte a la fecha
		$idSocio=$_POST["selSocio"];
		$fechaActual=$_POST["txtMes"];
		$idReporte=$video->generaReporteMes($idSocio, $fechaActual);

		$reporte=$video->muestraReportes($idSocio);


	}
?>
<?php include ("header.php"); ?>
<?php
	// mostramos la alerta
	if ($idReporte==-2 && $_POST["btnGenerar"]=="Generar") {
		?>
		<script type="text/javascript">
			alert("No existen datos para generar el reporte para el mes numero <?php echo $fechaActual; ?>. ");
		</script>
		<?php
	}
	if ($idReporte==-1 && $_POST["btnGenerar"]=="Generar") {
		?>
		<script type="text/javascript">
			alert("Ya se ha generado el reporte para el mes numero <?php echo $fechaActual; ?>. ");
		</script>
		<?php
	} 
	if ($idReporte==0 && $_POST["btnGenerar"]=="Generar") {
		?>
		<script type="text/javascript">
			alert("Generado el reporte para el mes numero <?php echo $fechaActual; ?>");
		</script>
		<?php
	}
?>
	<form method="post" action="">
		<div class="row-fluid">
			<div class="span6">
				<h2>Seleccione el socio para obtener el reporte</h2>
 				<?php echo $video->listaSocios(); ?>
 				<p>
 				<label>Mes de Reporte</label>
 				<select name="txtMes">
 					<option value="1">Enero</option>
 					<option value="2">Febrero</option>
 					<option value="3">Marzo</option>
 					<option value="4">Abril</option>
 					<option value="5">Mayo</option>
 					<option value="6">Junio</option>
 					<option value="7">Julio</option>
 					<option value="8">Agosto</option>
 					<option value="9">Septiembre</option>
 					<option value="10">Octubre</option>
 					<option value="11">Noviembre</option>
 					<option value="12">Diciembre</option>

 				</select>
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