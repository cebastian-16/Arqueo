<?php

	class conectarUsuarios{
		public $servername = 'localhost';
		public $database = "Gane";
		public $username = "root";
		public $password = "";

		function conexionUsuarios(){
			$connUsuarios = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
			return $connUsuarios;
		}
	}
