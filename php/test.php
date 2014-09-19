<?php
	// funciones de prueba
	error_reporting(E_ALL);
	echo "Hola!";
	include ("classVideo.php");
	$video=new classVideo();

/*
	$id=$video->insertaSocio("pato", 36, 1, "usr", "12345", "1");
	echo "<br> socio insertado: ".$id;

	$id=$video->insertaPelicula("peli1", "director 1", "2014-09-15", "2.53", "2");
	echo "<br> pelicula insertada: ".$id;


	$id=$video->insertaAlquiler("2014-09-16", "2014-09-24", "2.54", "1", "234");
	echo "<br> alquiler insertada: ".$id;

	$id=$video->insertaVideoclub("gerente 1", "valencia", "Serpis #80", "44567");
	echo "<br> videoclub intertado: ".$id;
*/
	$id=$video->generaReporte(1, "2014-09-18");
	echo "<br> reporte intertado: ".$id;

?>