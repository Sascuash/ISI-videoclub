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

	<div class="row-fluid">
		<div class="span6">
			<form method="post" action="">
				<h2>Listado de peliculas</h2>
				<p>
					<?php echo $video->listaPeliculas(); ?>
				</p>
 				<input type="hidden" id="oculta" value="" />
 				<p>
 					<label>&nbsp;</label>
 					<input type="button" value="Guardar" id="btnEnviar" name="btnEnviar"></input>
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
 		</div>
 		<div class="span4">
 			<h2>Carrito</h2>
 			<table id="myTable">
			 
			</table>
 		</div>
 	</div>

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
	    // Find a &lt;table&gt; element with id="myTable":
		var table = document.getElementById("myTable");
		// Create an empty &lt;tr&gt; element and add it to the 1st position of the table:
		var row = table.insertRow(0);
		// Insert new cells (&lt;td&gt; elements) at the 1st and 2nd position of the "new" &lt;tr&gt; element:
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		// Add some text to the new cells:
		cell1.innerHTML = selPelicula.value;
		cell2.innerHTML = "26";
	}

</script>


<div class="example_code notranslate">

