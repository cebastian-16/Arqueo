<?php

	class conectarUsuarios{
		public $servername = 'localhost';
		public $database = "Gane";
		public $username = "cliente";
		public $password = "adminadmon";

		function conexionUsuarios(){
			$connUsuarios = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
			return $connUsuarios;
		}
	}
?>