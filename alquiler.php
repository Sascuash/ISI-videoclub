<?php
	include ("php/classVideo.php");
	$video=new classVideo();
	session_start();

	print_r($_POST);
	$lista="";
	$pagoTotal=10;

	if ($_POST["btnAlquilar"]=="Alquilar" && count($lista)>0) {
		$recogida=$_POST["txtFechaRecogida"];
		$devolucion=$_POST["txtFechaDevolucion"];
		
		$video->insertaAlquiler($recogida, $devolucion, $pagoTotal, $_SESSION["idSocio"], $lista);

	}
?>

<?php include ("header.php"); ?>

	<form method="post" action="">
		<h2>Listado de peliculas</h2>
		<p>
			<?php echo $video->listaPeliculas(); ?>
		</p>
 		<input type="hidden" id="oculta" value="">
 		<p>
 			<label>&nbsp;</label>
 			<button value="Guardar" id="btnEnviar" name="btnEnviar">Guardar</button>
 		</p>

 		<h2>Alquiler</h2>
 		<p>
 			<label>Fecha Recogida</label>
 			<input type="text" name="txtFechaRecogida" value="" id="txtFechaRecogida"/>
 		</p>
 		<p>
 			<label>Fecha Devolucion</label>
 			<input type="text" name="txtFechaDevolucion" value="" id="txtFechaDevolucion"/>
 		</p>
 		<p>
 			<label>&nbsp;</label>
 			<input type="submit" value="Alquilar" id="btnAlquilar" name="btnAlquilar"/>
 		</p>

 	</form>

<?php include ("footer.php"); ?>

<script type="text/javascript">
	/**
		if ($_POST["btnEnviar"]=="Guardar") {
		$pelicula=$_POST["selPelicula"];
		$lista.=$pelicula."|";
	}
	**/

	var btnEnviar = document.getElementById("btnEnviar");
	var oculta = document.getElementById("oculta");
	var selPelicula = document.getElementById("selPelicula");

	btnEnviar.onclick=function(){
      oculta.value = oculta.value + "|" + selPelicula.value;
  	}

</script>

