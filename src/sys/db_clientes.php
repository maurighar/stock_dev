<?php
require_once("connect_db.php");

###########################################################
#
#   clientes
#
###########################################################
class Db_clientes extends Db_conect_pdo {
    private $id;
    private $nombre;
    private $cuit;
    private $email;
	private $telefono;

	public function __construct($id = 0,
			$nombre = '',
			$cuit = '',
			$email = '',
			$telefono = ''){

		$this->id = $id;
		$this->nombre = $nombre;
		$this->cuit = $cuit;
		$this->email = $email;
		$this->telefono = $telefono;

		parent::__construct();
	}

	###########################################################
	#   Setters
	###########################################################

    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setcuit($cuit){
        $this->cuit = $cuit;
    }

    public function setEmail($email){
        $this->email = $email;
    }

	public function settelefono($telefono){
        $this->telefono = $telefono;
    }

	###########################################################
	#   Getters
	###########################################################
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getcuit(){
        return $this->cuit;
    }

    public function getEmail(){
        return $this->email;
    }

	public function gettelefono(){
        return $this->telefono;
    }


	###########################################################
	#   Insertar
	###########################################################
    public function insertarDatos(){
        try {
            $stm = $this->conn->prepare("INSERT INTO clientes (nombre, cuit, email, telefono) VALUES (?,?,?,?)");
            $stm->execute([$this->nombre, $this->cuit, $this->email, $this->telefono]);
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
            $stm = $this->conn->prepare("UPDATE clientes SET nombre = ?, cuit = ?, email = ?, telefono = ? WHERE id = ?");
            $stm->execute([$this->nombre, $this->cuit, $this->email, $this->telefono, $this->id]);
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
            $stm = $this->conn->prepare("DELETE FROM clientes WHERE id = ?");
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
			$stm = $this->conn->prepare("SELECT * FROM clientes;");
			$stm->execute();
			return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
	}

	public function getOne(){
        try {
            $stm = $this->conn->prepare("SELECT * FROM clientes WHERE id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
    }

    public function getByEmail(){
        try {
            $stm = $this->conn->prepare("SELECT * FROM clientes WHERE email = ?");
            $stm->execute([$this->email]);
            return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
    }
}

