<?php
class datos
{
	public $conn;

	public function __construct()
	{
		require_once '../Modelo/conexion.php';
		$conectar = new conectar($_SESSION['sedeStock']);
		$this->conn = $conectar->conexion();
	}


	public function mirarDatos()

	{

		if ($_SESSION['sedeStock'] == "Multired") {

			$mirarDatos = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, 'Mayor de edad') AS nombre_supervisor, s.ip, s.nombres, s.documento, s.sucursal, s.ventabruta, s.baseefectivo, s.totalingreso, s.fechavisita,  s.horavisita
			FROM appseguimientos.registro_arqueo_servired s
			INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login LIMIT 6";
			$resultadoDatos = mysqli_query($this->conn, $mirarDatos);
			return $resultadoDatos;
		}

		if ($_SESSION['sedeStock'] == "Servired") {

			$mirarDatos = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, 'Mayor de edad') AS nombre_supervisor, s.ip, s.nombres, s.documento, s.sucursal, s.ventabruta, s.baseefectivo, s.totalingreso, s.fechavisita,  s.horavisita
				FROM appseguimiento.registro_arqueo_servired s
				INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login LIMIT 6";
			$resultadoDatos = mysqli_query($this->conn, $mirarDatos);
			return $resultadoDatos;
		}
	}


	public function Datos($documento)
	{
		if ($_SESSION['sedeStock'] == "Multired") {

			$Datos = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, 'Mayor de edad') AS nombre_supervisor, s.ip, s.nombres, s.documento, s.sucursal,s.ventabruta, s.baseefectivo, s.totalingreso, s.chancesabonados, s.chancespreimpresos,s.premiospagados,s.efectivocajafuerte, s.totalegresos, s.totalbilletes, s.totalmonedas, s.totalarqueo, s.sobrantefaltante, 
		s.canti_billete_cienmil, s.total_billete_cienmil, s.canti_billete_cincuentamil, s.total_billete_cincuentamil, s.canti_billete_veintemil, s.total_billete_veintemil, s.canti_billete_diezmil, s.total_billete_diezmil, s.canti_billete_cincomil, s.total_billete_cincomil, s.canti_billete_dosmil, s.total_billete_dosmil, s.canti_billete_mil, s.total_billete_mil, 
		s.canti_moneda_mil, s.total_moneda_mil, s.canti_moneda_quinientos, s.total_moneda_quinientos, s.canti_moneda_docientos, s.total_moneda_docientos, s.canti_moneda_cien, s.total_moneda_cien, s.canti_moneda_cincuenta, s.total_moneda_ciencuenta, 
		s.total_efectivo, s.total_premios_pagados, s.entrega_colocador, s.sobrantefaltante_caja, s.colocador_cajafuerte, s.rollos_bnet, s.rollos_fisicos, s.diferencia, s.requisito1, s.observacion1, s.requisito2, s.observacion2, s.requisito3, s.observacion3, s.requisito4, s.observacion4, s.requisito5, s.observacion5, s.requisito6, s.observacion6, s.requisito7, 
		s.observacion7, s.requisito8, s.observacion8, s.requisito9, s.observacion9, s.requisito10, s.observacion10, s.requisito11, s.observacion11, s.requisito12, s.observacion12, s.requisito13, s.observacion13, s.requisito14, s.observacion14, s.requisito15, s.observacion15, s.requisito16, s.observacion16, s.requisito17, s.observacion17, s.requisito18, s.observacion18, 
		s.requisito19, s.observacion19, s.requisito20, s.observacion20, s.requisito21, s.observacion21, s.requisito22, s.observacion22, s.requisito23, s.observacion23, s.requisito24, s.observacion24, s.requisito25, s.observacion25, s.requisito26, 
		s.observacion26, s.requisito27, s.observacion27, s.requisito28, s.observacion28, s.requisito29, s.requisito30, s.fechavisita, s.horavisita, s.latitud, s.longitud
		FROM appseguimientos.registro_arqueo_servired s
		INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login WHERE s.documento='$documento'";
			$resultadoDato = mysqli_query($this->conn, $Datos);
			return $resultadoDato;
		}
		if ($_SESSION['sedeStock'] == "Servired") {

			$Datos = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, 'Mayor de edad') AS nombre_supervisor, s.ip, s.nombres, s.documento, s.sucursal,s.ventabruta, s.baseefectivo, s.totalingreso, s.chancesabonados, s.chancespreimpresos,s.premiospagados,s.efectivocajafuerte, s.totalegresos, s.totalbilletes, s.totalmonedas, s.totalarqueo, s.sobrantefaltante, 
		s.canti_billete_cienmil, s.total_billete_cienmil, s.canti_billete_cincuentamil, s.total_billete_cincuentamil, s.canti_billete_veintemil, s.total_billete_veintemil, s.canti_billete_diezmil, s.total_billete_diezmil, s.canti_billete_cincomil, s.total_billete_cincomil, s.canti_billete_dosmil, s.total_billete_dosmil, s.canti_billete_mil, s.total_billete_mil, 
		s.canti_moneda_mil, s.total_moneda_mil, s.canti_moneda_quinientos, s.total_moneda_quinientos, s.canti_moneda_docientos, s.total_moneda_docientos, s.canti_moneda_cien, s.total_moneda_cien, s.canti_moneda_cincuenta, s.total_moneda_ciencuenta, 
		s.total_efectivo, s.total_premios_pagados, s.entrega_colocador, s.sobrantefaltante_caja, s.colocador_cajafuerte, s.rollos_bnet, s.rollos_fisicos, s.diferencia, s.requisito1, s.observacion1, s.requisito2, s.observacion2, s.requisito3, s.observacion3, s.requisito4, s.observacion4, s.requisito5, s.observacion5, s.requisito6, s.observacion6, s.requisito7, 
		s.observacion7, s.requisito8, s.observacion8, s.requisito9, s.observacion9, s.requisito10, s.observacion10, s.requisito11, s.observacion11, s.requisito12, s.observacion12, s.requisito13, s.observacion13, s.requisito14, s.observacion14, s.requisito15, s.observacion15, s.requisito16, s.observacion16, s.requisito17, s.observacion17, s.requisito18, s.observacion18, 
		s.requisito19, s.observacion19, s.requisito20, s.observacion20, s.requisito21, s.observacion21, s.requisito22, s.observacion22, s.requisito23, s.observacion23, s.requisito24, s.observacion24, s.requisito25, s.observacion25, s.requisito26, 
		s.observacion26, s.requisito27, s.observacion27, s.requisito28, s.observacion28, s.requisito29, s.requisito30, s.fechavisita, s.horavisita, s.latitud, s.longitud
		FROM appseguimiento.registro_arqueo_servired s
		INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login WHERE s.documento='$documento'";
			$resultadoDato = mysqli_query($this->conn, $Datos);
			return $resultadoDato;
		}
	}


	public function consultarArqueo($fechavisitaM)
	{
		if ($_SESSION['sedeStock'] == "Multired") {

			$consultarArqueo = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, 'Mayor de edad') AS nombre_supervisor, s.ip, s.nombres, s.documento, s.sucursal, s.ventabruta, s.baseefectivo, s.totalingreso, s.fechavisita,  s.horavisita
			FROM appseguimientos.registro_arqueo_servired s
			INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login WHERE s.fechavisita = '" . $fechavisitaM . "'";
			$resultadoArqueo = mysqli_query($this->conn, $consultarArqueo);
			return $resultadoArqueo;
		}

		if ($_SESSION['sedeStock'] == "Servired") {

			$consultarArqueo = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, 'Mayor de edad') AS nombre_supervisor, s.ip, s.nombres, s.documento, s.sucursal, s.ventabruta, s.baseefectivo, s.totalingreso, s.fechavisita,  s.horavisita
			FROM appseguimiento.registro_arqueo_servired s
			INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login WHERE s.fechavisita = '" . $fechavisitaM . "'";
			$resultadoArqueo = mysqli_query($this->conn, $consultarArqueo);
			return $resultadoArqueo;
		}
	}


	// public function consultar($ip, $nombres, $documento, $sucursal, $supervisor, $ventabruta)
	// {
	// 	$sql = "SELECT `ip` , `nombres`, `documento`, `sucursal`, `supervisor`, `ventabruta`, baseefectivo, totalingreso, fechavisita,	horavisita ";

	// 	$resultado = mysqli_query($this->conn, $sql);
	// 	if ($resultado == TRUE) {

	// 		echo "<div class='alert alert-success alert-dismissible'>";
	// 		echo "  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
	// 		echo "  <strong>Excelente!</strong> Se encontro.";
	// 		echo "</div>";
	// 	} else {
	// 		echo "<div class='alert alert-danger alert-dismissible'>";
	// 		echo "  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
	// 		echo "  <strong>Error!</strong> " . mysqli_error($this->conn) . $sql;
	// 		echo "</div>";
	// 	}
	// }
}
