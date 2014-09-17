<?php
	class classVideo {
		private $dbHost="mysql9.rl-host.com";
		private $dbUsername="patolin_isi";
		private $dbPassword="isi2014";
		private $dbNombre="patolin_isi";
		private $dbPref="video_";

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



	}
?>