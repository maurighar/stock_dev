<?php

class Db_conect_pdo {
	protected $conn;
	public $resultado;
	public $driver;

	protected function __construct() {
		try {
			$this->conn = new PDO('mysql:host=' . DB_HOST 
				. '; dbname=' . DB_NAME 
				. ';charset=utf8', DB_USER, DB_PASSWORD);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		}catch(PDOException $e){
			echo 'Error de conexión: ' . $e->getMessage() . '<br/>';
			exit();
		}
	}

	protected function mensajes_pdo($codigo, $mensaje){
		switch ($codigo) {
			case 23000:
				return 'Código duplicado';
				break;
			
			default:
				return $mensaje;
				break;
		}
	}
}

###########################################################
#
#   ARTICULOS
#
###########################################################
class Db_articulos extends Db_conect_pdo {
    private $id;
    private $codigo;
    private $descripcion;
    private $precio;
	private $cantidad;

	public function __construct($id = 0,
			$codigo = '',
			$descripcion = '',
			$precio = 0,
			$cantidad = 0){

		$this->id = $id;
		$this->codigo = $codigo;
		$this->descripcion = $descripcion;
		$this->precio = $precio;
		$this->cantidad = $cantidad;

		parent::__construct();
	}

	###########################################################
	#   Setters
	###########################################################

    public function setId($id){
        $this->id = $id;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

	public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

	###########################################################
	#   Getters
	###########################################################
    public function getId(){
        return $this->id;
    }

    public function getCcodigo(){
        return $this->codigo;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPrecio(){
        return $this->precio;
    }

	public function getCantidad(){
        return $this->cantidad;
    }


	###########################################################
	#   Insertar
	###########################################################
    public function insertarDatos(){
        try {
            $stm = $this->conn->prepare("INSERT INTO articulos (codigo, descripcion, precio, cantidad) VALUES (?,?,?,?)");
            $stm->execute([$this->codigo, $this->descripcion, $this->precio, $this->cantidad]);
            return true;

		}catch(PDOException $e){
			return $this->mensajes_pdo($e->getCode(), $e->getMessage());
		}
    }


	###########################################################
	#   Actualizar
	###########################################################
    public function actualizar(){
        try {
            $stm = $this->conn->prepare("UPDATE articulos SET codigo = ?, descripcion = ?, precio = ?, cantidad = ? WHERE id = ?");
            $stm->execute([$this->codigo, $this->descripcion, $this->precio, $this->cantidad, $this->id]);
            return true;

		}catch(PDOException $e){
			return $e->getMessage();
		}
    }
	
	###########################################################
	#   Eliminar
	###########################################################
    public function eliminar(){
        try {
            $stm = $this->conn->prepare("DELETE FROM articulos WHERE id = ?");
            $stm->execute([$this->id]);
            return true;

		}catch(PDOException $e){
			return $e->getMessage();
		}
    }

	###########################################################
	#   Lectura de datos
	###########################################################
	public function get_all(){
		try {
			$stm = $this->conn->prepare("SELECT * FROM articulos;");
			$stm->execute();
			return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
	}

	public function getOne(){
        try {
            $stm = $this->conn->prepare("SELECT * FROM articulos WHERE id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
    }

}

