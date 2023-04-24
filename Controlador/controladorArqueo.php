<?php 
	class datos{
		public $conn;

		public function __construct(){
			require_once '../Modelo/conexion.php';
			$conectar=new conectar($_SESSION['sedeStock']);
			$this->conn=$conectar->conexion();
		}

		public function mirarDatos(){
			$mirarDatos = "SELECT * FROM `registro_arqueo_servired` limit 6 ";
            $resultadoDatos = mysqli_query( $this->conn, $mirarDatos );
			return $resultadoDatos;
		}

		public function Datos($documento){
			$Datos = "SELECT * FROM `registro_arqueo_servired` WHERE documento='$documento'";
            $resultadoDato = mysqli_query( $this->conn, $Datos );
			return $resultadoDato;
		}


		public function consultarArqueo($fechavisitaM){
			$consultarArqueo = "SELECT * FROM `registro_arqueo_servired` WHERE fechavisita = '".$fechavisitaM."'";
            $resultadoArqueo = mysqli_query( $this->conn, $consultarArqueo );
			return $resultadoArqueo;
		}


		public function consultar($ip, $nombres, $documento, $sucursal, $supervisor, $ventabruta){
			$sql = "SELECT `ip` , `nombres`, `documento`, `sucursal`, `supervisor`, `ventabruta`, baseefectivo, totalingreso, fechavisita,	horavisita ";
			
          	$resultado = mysqli_query( $this->conn, $sql );
          	if ($resultado==TRUE) {

		        echo "<div class='alert alert-success alert-dismissible'>";
				echo "  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				echo "  <strong>Excelente!</strong> Se encontro.";
				echo "</div>";

          	}else{
		        echo "<div class='alert alert-danger alert-dismissible'>";
				echo "  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				echo "  <strong>Error!</strong> ".mysqli_error($this->conn).$sql;
				echo "</div>";
          	}
		}

		
	}
