<?php
	include ("php/classVideo.php");
	$video=new classVideo();
	session_start();

	$lista=$_POST["oculta"];
	$pagoTotal=$_POST["precioTotal"];

	if ($_POST["btnAlquilar"]=="Alquilar" && count($lista)>0) {
		$recogida=$_POST["txtFechaRecogida"];
		$devolucion=$_POST["txtFechaDevolucion"];
		
		if ($video->insertaAlquiler($recogida, $devolucion, $pagoTotal, $_SESSION["idSocio"], $lista)!=-1){
			?>
			<script type="text/javascript">
				alert("Alquiler realizado");
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("La fecha de devolucion es incorrecta");
			</script>
			<?php
		}

	}

	if ($_POST["CrearPelicula"]=="CrearPelicula") {
		$nombreNueva=$_POST["txtNuevoNombre"];
		$directorNueva=$_POST["txtNuevoDirector"];
		$fechaNueva=$_POST["txtNuevaFecha"];
		$precioNueva=$_POST["txtNuevoPrecio"];

		if ($video->insertaPelicula($nombreNueva, $directorNueva, $fechaNueva, $precioNueva, $_SESSION["idVideoclub"])!=-1) {
			?>
			<script type="text/javascript">
				alert("Pelicula insertada");
			</script>
			<?php
		} else {
			?>
			<script type="text/javascript">
				alert("Pelicula ya existente");
			</script>
			<?php
		}

		
	}
?>

<?php include ("header.php"); ?>

	<div class="row-fluid">
		<div class="span4">
			<form method="post" action="">
				<h2>Listado de peliculas</h2>
				<p>
					<?php echo $video->listaPeliculas(); ?>
				</p>
 				<input type="hidden" id="oculta" value="" name="oculta"/>
 				<input type="hidden" id="precioTotal" value="" name="precioTotal"/>
 				<p>
 					<label>&nbsp;</label>
 					<input class="btn btn-info" type="button" value="Guardar" id="btnEnviar" name="btnEnviar"></input>
 				</p>
 				<h2>Alquiler</h2>
 				<p>
 					<label>Fecha Recogida</label>
 					<input type="text" name="txtFechaRecogida" value="<?php echo date("Y-m-d"); ?>" id="txtFechaRecogida"/>
 				</p>
 				<p>
 					<label>Fecha Devolucion</label>
 					<input type="text" name="txtFechaDevolucion" value="<?php $Date=date("Y-m-d"); echo date('Y-m-d', strtotime($Date. ' + 8 day')); ?>" id="txtFechaDevolucion"/>
 				</p>
 				<p>
 					<label>&nbsp;</label>
 					<input class="btn btn-success" type="submit" value="Alquilar" id="btnAlquilar" name="btnAlquilar"/>
 				</p>
 			</form>
 		</div>
 		<div class="span4">
 			<h2>Carrito (<span id="sumaParcial"></span>&euro;)</h2>
 			<table class="table table-condensed" id="myTable">
				<thead>
  				  <tr class="warning">
  				    <th>Pelicula</th>
  				    <th>precio</th>
  				  </tr>
  				</thead>
  				<tbody id="myTableBody">
  				</tbody>
			</table>
 		</div>
 		<div class="span4">
 			<h2>A&ntilde;adir Pelicula</h2>
 			<form method="post" action="">
				<p>
 					<label>Nombre pelicula:</label>
 					<input type="text" name="txtNuevoNombre" value="" id="txtNuevoNombre"/>
 				</p>
 				<p>
 					<label>Director pelicula:</label>
 					<input type="text" name="txtNuevoDirector" value="" id="txtNuevoDirector"/>
 				</p>
 				<p>
 					<label>Fecha Estreno</label>
 					<input type="text" name="txtNuevaFecha" value="<?php $Date=date("Y-m-d"); ?>" id="txtNuevaFecha"/>
 				</p>
 				<p>
 					<label>Precio pelicula:</label>
 					<input type="text" name="txtNuevoPrecio" value="" id="txtNuevoPrecio"/>
 				</p>
 				<p>
 					<label>&nbsp;</label>
 					<input class="btn btn-success" type="submit" value="CrearPelicula" id="CrearPelicula" name="CrearPelicula"/>
 				</p>
 			</form>
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
	var precioTotal = document.getElementById("precioTotal");
	var selPelicula = document.getElementById("selPelicula");
	var sumaParcial = document.getElementById("sumaParcial");

	precioTotal.value=parseFloat(0.0);
	sumaParcial.innerHTML=parseFloat(0.0);

	btnEnviar.onclick=function(){
      	oculta.value = oculta.value + selPelicula.value + "|";
	    // Find a &lt;table&gt; element with id="myTable":
		var table = document.getElementById("myTableBody");
		// Create an empty &lt;tr&gt; element and add it to the 1st position of the table:
		var row = table.insertRow(0);
		// Insert new cells (&lt;td&gt; elements) at the 1st and 2nd position of the "new" &lt;tr&gt; element:
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		// Add some text to the new cells:
		cell1.innerHTML = $("#selPelicula option:selected").text();
		cell2.innerHTML = $("#selPelicula option:selected").attr("rel");
		precioTotal.value = parseFloat(precioTotal.value)+parseFloat($("#selPelicula option:selected").attr("rel"));
		sumaParcial.innerHTML = parseFloat(sumaParcial.innerHTML)+parseFloat($("#selPelicula option:selected").attr("rel"));
	}

</script>


<div class="example_code notranslate">

