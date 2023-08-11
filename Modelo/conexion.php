<?php

class conectar
{
	public $servername = 'localhost';
	public $database = "appseguimiento";
	public $username = "root";
	public $password = "";
	private $bd = "";

	public function __construct($bd)
	{
		$this->bd = $bd;
	}


	function conexion()
	{
		if ($this->bd == "Multired") {
			$this->database="appseguimiento";
		}else if($this->bd == "Servired"){
			$this->database="appseguimiento";
		}
		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
		return $conn;
	}

}
