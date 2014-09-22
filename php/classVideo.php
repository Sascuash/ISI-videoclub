<?php
	error_reporting(E_ERROR);
	class classVideo {
	
		private $dbHost="localhost";
		private $dbUsername="root";
		private $dbPassword="";
		private $dbNombre="isi";
		private $dbPref="video_";
/*	
		private $dbHost="mysql9.rl-host.com";
		private $dbUsername="patolin_isi";
		private $dbPassword="isi2014";
		private $dbNombre="patolin_isi";
		private $dbPref="video_";
*/
		private function mysqlConnect() {
	        mysql_connect($this->dbHost,$this->dbUsername,$this->dbPassword);
	        mysql_select_db($this->dbNombre) or die("Error de conexion con la base de datos");

	    }

	    public function insertaSocio($nombre, $edad, $idVideoclub, $codigo, $clave, $admin) {
	    	$this->mysqlConnect();
			$sql=sprintf("INSERT INTO ".$this->dbPref."socio (nombre, edad, id_videoclub, codigo, clave, admin) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
				mysql_escape_string($nombre),
				mysql_escape_string($edad),
				mysql_escape_string($idVideoclub),
				mysql_escape_string($codigo),
				mysql_escape_string($clave),
				mysql_escape_string($admin)
			);
			mysql_query($sql);	
			$idInsertado=mysql_insert_id();
			return $idInsertado;
	    }

	    public function insertaPelicula($nombre, $director, $fechaEstreno, $precio, $idVideoclub) {
	    	$this->mysqlConnect();

	    	// verificamos que no exista una pelicula con el mismo nombre
	    	$sql=sprintf("SELECT * FROM ".$this->dbPref."pelicula WHERE nombre='%s' AND id_videoclub='%s'",
	    		mysql_escape_string($nombre),
	    		mysql_escape_string($idVideoclub)
	    	);
	    	$datos=mysql_query($sql);
	    	if (mysql_num_rows($datos)>0) {
	    		// existe la pelicula
	    		return -1;
	    	}

			$sql=sprintf("INSERT INTO ".$this->dbPref."pelicula (nombre, director, fecha_estreno, precio, id_videoclub) VALUES ('%s', '%s', '%s', '%s', '%s')",
				mysql_escape_string($nombre),
				mysql_escape_string($director),
				mysql_escape_string($fechaEstreno),
				mysql_escape_string($precio),
				mysql_escape_string($idVideoclub)
			);
			mysql_query($sql);	
			$idInsertado=mysql_insert_id();
			return $idInsertado;	
	    }

	    public function insertaAlquiler($fechaRecogida, $fechaDevolucion, $pago, $idSocio, $idPeliculas) {
	    	$this->mysqlConnect();
	    	if (strtotime($fechaDevolucion)<=strtotime($fechaRecogida)) {
	    		return -1;
	    	}

			$sql=sprintf("INSERT INTO ".$this->dbPref."alquiler (fecha_recogida, fecha_devolucion, pago, id_socio, id_peliculas) VALUES ('%s', '%s', '%s', '%s', '%s')",
				mysql_escape_string($fechaRecogida),
				mysql_escape_string($fechaDevolucion),
				mysql_escape_string($pago),
				mysql_escape_string($idSocio),
				mysql_escape_string($idPeliculas)
			);
			mysql_query($sql);	
			$idInsertado=mysql_insert_id();
			return $idInsertado;	
	    }

	    public function insertaVideoclub($gerente, $ciudad, $calle, $codigoPostal){
	    	$this->mysqlConnect();
			$sql=sprintf("INSERT INTO ".$this->dbPref."videoclub (gerente, ciudad, calle, cp) VALUES ('%s', '%s', '%s', '%s')",
				mysql_escape_string($gerente),
				mysql_escape_string($ciudad),
				mysql_escape_string($calle),
				mysql_escape_string($codigoPostal)
			);
			mysql_query($sql);	
			$idInsertado=mysql_insert_id();
			return $idInsertado;	
	    }

	    public function listaPeliculas($idVideoclub=-1) {
	    	$this->mysqlConnect;
	    	if ($idVideoclub==-1) {
	    		$sql="SELECT * FROM video_pelicula ORDER BY nombre ASC";
	    	} else {
	    		$sql=sprintf("SELECT * FROM video_pelicula WHERE id_videoclub='%s' ORDER BY nombre ASC",
	    			mysql_escape_string($idVideoclub)
	    		);
	    	}

	    		    	
	    	$datos=mysql_query($sql);
	    	$salida='<select multiple id="selPelicula" name="selPelicula">';
	    	while ($fila=mysql_fetch_array($datos)) {
	    		$salida.='<option value="'.$fila["id"].'" rel="'.$fila["precio"].'">'.$fila["nombre"].'</option>';
	    	}
	    	$salida.="</select>";
	    	return $salida;
	    }

	    public function listaSocios() {
	    	$this->mysqlConnect();
	    	$sql="SELECT * FROM video_socio ORDER BY nombre ASC";
	    	$datos=mysql_query($sql);
	    	$salida='<select id="selSocio" name="selSocio">';
	    	while ($fila=mysql_fetch_array($datos)) {
	    		$salida.='<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
	    	}
	    	$salida.="</select>";
	    	return $salida;
	    }

	    public function listaVideoclubs($idVideoclubActual=-1) {
	    	$this->mysqlConnect();
	    	$sql="SELECT * FROM video_videoclub ORDER BY calle ASC";
	    	$datos=mysql_query($sql);
	    	$salida='<select id="selVideoclub" name="selVideoclub">';
	    	while ($fila=mysql_fetch_array($datos)) {
	    		if ($fila["id"]==$idVideoclubActual) {
	    			$textoSelect=" selected";
	    		} else {
	    			$textoSelect="";
	    		}
	    		$salida.='<option value="'.$fila["id"].'" '.$textoSelect.'>'.$fila["calle"].'</option>';
	    	}
	    	$salida.="</select>";
	    	return $salida;
	    }

	    public function generaReporte($idSocio, $fechaActual) {
	    	$this->mysqlConnect();
	    	// buscamos el ultimo reporte
	    	$sql=sprintf("SELECT * FROM ".$this->dbPref."estadistica WHERE id_socio='%s' ORDER BY id DESC LIMIT 0,1",
	    		mysql_escape_string($idSocio)
	    	); 
	    	$datos=mysql_query($sql);
	    	if (mysql_num_rows($datos)==1) {
	    		$fila=mysql_fetch_array($datos);
	    		$ultimoReporte=$fila["fecha_generacion"];
	    	} else {
	    		$ultimoReporte="1900-01-01";
	    	}

	    	// generamos el reporte en el rango de fechas
	    	$sql=sprintf("SELECT id, pago FROM ".$this->dbPref."alquiler WHERE id_socio='%s' AND fecha_recogida>'%s' AND fecha_recogida<='%s'",
	    		mysql_escape_string($idSocio),
	    		mysql_escape_string($ultimoReporte),
	    		mysql_escape_string($fechaActual)
	    	);
	    	
	    	$datos=mysql_query($sql);
	    	$totalPago=0;
	    	while ($fila=mysql_fetch_array($datos)) {
	    		$totalPago+=$fila["pago"];
	    	}

	    	// insertamos el total en estadistica
	    	$sql=sprintf("INSERT INTO ".$this->dbPref."estadistica (id_socio, fecha_generacion, total) VALUES ('%s', '%s', '%s')",
	    		mysql_escape_string($idSocio),
	    		mysql_escape_string($fechaActual),
	    		mysql_escape_string($totalPago)
	    	);
	    	mysql_query($sql);
	    	$idInsertado=mysql_insert_id();
			return $idInsertado;
	    }

	    public function generaReporteMes($idSocio, $mes) {
	    	$this->mysqlConnect();
	    	// buscamos el ultimo reporte
	    	$fechaInicio=date("Y")."-".$mes."-1";
	    	if ($mes==12) {
	    		$fechaFin=(date("Y")+1)."-1-1";	
	    	} else {
	    		$fechaFin=date("Y")."-".($mes+1)."-1";
	    	}
	    	$reporteGenerado=-1;

	    	$sql=sprintf("SELECT * FROM ".$this->dbPref."estadistica WHERE id_socio='%s' AND fecha_generacion>='%s' AND fecha_generacion<'%s'",
	    		mysql_escape_string($idSocio),
	    		mysql_escape_string($fechaInicio),
	    		mysql_escape_string($fechaFin)
	    	);
	    	$datos=mysql_query($sql);
	    	if (mysql_num_rows($datos)==1) {
	    		$reporteGenerado=-1;
	    	} else {
	    		// generamos el reporte en el rango de fechas
		    	$sql=sprintf("SELECT id, pago FROM ".$this->dbPref."alquiler WHERE id_socio='%s' AND fecha_recogida>='%s' AND fecha_recogida<'%s'",
		    		mysql_escape_string($idSocio),
		    		mysql_escape_string($fechaInicio),
		    		mysql_escape_string($fechaFin)
		    	);
		    	$datos=mysql_query($sql);
		    	$totalPago=0;
		    	while ($fila=mysql_fetch_array($datos)) {
		    		$totalPago+=$fila["pago"];
		    	}
		    	if ($totalPago>0) {
		    		// insertamos el total en estadistica
			    	$sql=sprintf("INSERT INTO ".$this->dbPref."estadistica (id_socio, fecha_generacion, total) VALUES ('%s', '%s', '%s')",
			    		mysql_escape_string($idSocio),
			    		mysql_escape_string($fechaInicio),
			    		mysql_escape_string($totalPago)
			    	);
			    	mysql_query($sql);
			    	$reporteGenerado=mysql_insert_id();	
		    	} else {
		    		$reporteGenerado=-2;
		    	}
		    	
					
	    	} 
	    	return $reporteGenerado;

	    	
	    }	

	    public function muestraReportes($idSocio) {
	    	$this->mysqlConnect();
	    	// buscamos el ultimo reporte
	    	$sql=sprintf("SELECT * FROM ".$this->dbPref."estadistica WHERE id_socio='%s' ORDER BY fecha_generacion ASC",
	    		mysql_escape_string($idSocio)
	    	); 
	    	$datos=mysql_query($sql);
	    	$salida="";
	    	if (mysql_num_rows($datos)==0) {
	    		$salida.='No existen datos para el socio seleccionado';
	    	} else {
	    		$valorTotal=0;
	    		$salida.='<table class="table table-condensed">';

	    			$salida.='<tr class="warning">';
	    				$salida.='<th>Fecha</th>';
	    				$salida.='<th>Valor</th>';
	    				$valorTotal+=$fila["total"];
	    			$salida.='</tr>';

	    		while ($fila=mysql_fetch_array($datos)) {
	    			$salida.='<tr>';
	    				$salida.='<td>'.substr($fila["fecha_generacion"],0,-3).'</td>';
	    				$salida.='<td>'.$fila["total"].'</td>';
	    				$valorTotal+=$fila["total"];
	    			$salida.='</tr>';
	    		}

	    		$salida.='<tr>';
	    			$salida.='<td>TOTAL</td>';
	    			$salida.='<td>'.number_format($valorTotal,2).'</td>';
	    		$salida.='</tr>';

	    		$salida.='</table>';
	    	}
	    	return $salida;
	    }


	    public function obtieneNombreSocio($idSocio) {
	    	$this->mysqlConnect();
	    	// buscamos el ultimo reporte
	    	$sql=sprintf("SELECT * FROM ".$this->dbPref."socio WHERE id='%s' LIMIT 0,1",
	    		mysql_escape_string($idSocio)
	    	); 
	    	$datos=mysql_query($sql);
	    	if (mysql_num_rows($datos)==1) {
	    		$fila=mysql_fetch_array($datos);
	    		$salida=$fila["nombre"];
	    	} else {
	    		$salida="";
	    	}
	    	return $salida;
	    }

	    public function obtieneNombreVideoclub($idVideo) {
	    	$this->mysqlConnect();
	    	// buscamos el ultimo reporte
	    	$sql=sprintf("SELECT * FROM ".$this->dbPref."videoclub WHERE id='%s' LIMIT 0,1",
	    		mysql_escape_string($idVideo)
	    	); 
	    	$datos=mysql_query($sql);
	    	if (mysql_num_rows($datos)==1) {
	    		$fila=mysql_fetch_array($datos);
	    		$salida=$fila["calle"];
	    	} else {
	    		$salida="";
	    	}
	    	return $salida;
	    }


	}
?>