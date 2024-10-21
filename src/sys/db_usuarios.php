<?php
require_once("connect_db.php");

###########################################################
#
#   usuarios
#
###########################################################
class Db_usuarios extends Db_conect_pdo {
    private $id;
    private $nombre;
    private $apellido;
    private $email;
	private $password;

	public function __construct($id = 0,
			$nombre = '',
			$apellido = '',
			$email = '',
			$password = ''){

		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->email = $email;
		$this->password = $password;

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

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setEmail($email){
        $this->email = $email;
    }

	public function setPassword($password){
        $this->password = $password;
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

    public function getApellido(){
        return $this->apellido;
    }

    public function getEmail(){
        return $this->email;
    }

	public function getPassword(){
        return $this->password;
    }


	###########################################################
	#   Insertar
	###########################################################
    public function insertarDatos(){
        try {
            $pass_encript = password_hash($this->password, PASSWORD_DEFAULT);
            $stm = $this->conn->prepare("INSERT INTO usuarios (nombre, apellido, email, password) VALUES (?,?,?,?)");
            $stm->execute([$this->nombre, $this->apellido, $this->email, $pass_encript]);
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
            $stm = $this->conn->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, password = ? WHERE id = ?");
            $stm->execute([$this->nombre, $this->apellido, $this->email, $this->password, $this->id]);
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
            $stm = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
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
			$stm = $this->conn->prepare("SELECT * FROM usuarios;");
			$stm->execute();
			return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
	}

	public function getOne(){
        try {
            $stm = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
    }

    public function getByEmail(){
        try {
            $stm = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stm->execute([$this->email]);
            return $stm->fetchAll();

		}catch(PDOException $e){
			return  $e->getMessage();
		}
    }
}

