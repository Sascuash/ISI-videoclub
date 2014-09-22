<?php
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
	    	if (date("Y-m-d",$fechaDevolucion)<=date("Y-m-d",$fechaRecogida)) {
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

	    public function listaPeliculas() {
	    	$this->mysqlConnect();
	    	$sql="SELECT * FROM video_pelicula ORDER BY nombre ASC";
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

	    public function listaVideoclubs() {
	    	$this->mysqlConnect();
	    	$sql="SELECT * FROM video_videoclub ORDER BY calle ASC";
	    	$datos=mysql_query($sql);
	    	$salida='<select id="selVideoclub" name="selVideoclub">';
	    	while ($fila=mysql_fetch_array($datos)) {
	    		$salida.='<option value="'.$fila["id"].'">'.$fila["calle"].'</option>';
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
	    				$salida.='<td>'.$fila["fecha_generacion"].'</td>';
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