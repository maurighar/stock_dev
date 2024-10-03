<?php

class Db_conect_pdo {
	protected $pdo;
	public $resultado;
	public $driver;

	public function __construct() {
		try {
			$this->pdo = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$this->driver = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

		}catch(PDOException $e){
			echo 'Error de conexión: ' . $e->getMessage() . '<br/>';
			exit();
		}
	}
	
}

class Db_pdo_movimientos extends Db_conect_pdo {

	public function __construct(){
		parent::__construct();
	}

	public function get_movimientos(){
		/**
		 * 
		 * La funcion devuelve falso si la consulta no 
		 * trae ningun dato de la tabla
		 * 
		 */
		$sql = "SELECT * 
			FROM finanzas.movimientos 
			ORDER BY fecha DESC, detalle;";

		$this->resultado = $this->pdo->query($sql);

		if ($this->resultado->rowCount() === 0){
			return false;
		}

		return true;
	}

	public function get_tipo_x_mes($año){

		$sql = "SELECT tipo, MONTH(fecha) AS mes, SUM(round(ingreso)) AS ingreso, 
					SUM(round(egreso)) AS egreso
				FROM Finanzas.movimientos
				WHERE year(fecha) = $año
				GROUP BY tipo, MONTH(fecha)
				ORDER BY tipo, MONTH(fecha);";

		$this->resultado = $this->pdo->query($sql);

		if ($this->resultado->rowCount() === 0){
			return false;
		}
		return true;
	}

	public function get_tipo($tipo){
		$sql = "SELECT tipo, MONTH(fecha) AS months, year(fecha) AS years, 
					SUM(round(ingreso)) AS ingreso, 
					SUM(round(egreso)) AS egreso
				FROM Finanzas.movimientos
				WHERE tipo = '$tipo'
				GROUP BY tipo, year(fecha), MONTH(fecha)
				ORDER BY tipo, fecha DESC;";

		$this->resultado = $this->pdo->query($sql);

		if ($this->resultado->rowCount() === 0){
			return false;
		}
		return true;
	}
}


class Db_pdo_tipos extends Db_conect_pdo {
	// CREATE TABLE `tipo` (
	// 	`tipo` VARCHAR(8) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	// 	`detalle` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	// 	`cuenta` VARCHAR(8) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	// 	PRIMARY KEY (`tipo`) USING BTREE
	// )
	// COLLATE='utf8_general_ci'
	// ENGINE=InnoDB
	// ;

	public function __construct(){
		parent::__construct();
	}

	public function get_tipos(){
		$sql = "SELECT * 
			FROM finanzas.tipo 
			ORDER BY tipo DESC, detalle;";

		$this->resultado = $this->pdo->query($sql);

		if ($this->resultado->rowCount() === 0){
			return false;
		}

		return true;
	}

	public function get_detalle($tipo){
		$sql = "SELECT detalle 
			FROM finanzas.tipo 
			WHERE tipo = '$tipo';";

		$this->resultado = $this->pdo->query($sql);
		$row = $this->resultado->fetch(PDO::FETCH_ASSOC);

		if (isset($row)){
			return $row['detalle'];
			
		}

		return 'No encontrado el tipo.';
	}
}