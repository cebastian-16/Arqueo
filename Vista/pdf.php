<?php
session_start();

if (!isset($_SESSION['userLogin'])) {
	header('Location: login.php');
	exit;
} else {
	include '../Controlador/controladorArqueo.php';
	$datos = new datos;

	if (!empty($_GET['documento'])) {
		$documento = $_GET['documento'];
		$resultadoDato = $datos->Datos($documento);
		$row = mysqli_fetch_array($resultadoDato);

		if (empty($row)) {
			echo "<div class='alert alert-danger alert-dismissible'>";
			echo "  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
			echo "  <strong>Error!</strong> No se encontraron Registros";
			echo "	<a href='verArqueos.php?activo=" . $documento . "'><input type='button' class='btn btn-primary' value='insertar'></a> ";
			echo "</div>";
		}
	}


	require_once('./tcpdf/tcpdf.php');

	// Crear una instancia de TCPDF
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// Configurar información del documento
	$pdf->SetCreator(PDF_CREATOR);


	// Agregar una página
	$pdf->AddPage();

	$pdf->SetFont('times', 'B', 16);
	$pdf->Cell(0, 10, 'REPORTE ARQUEO', 0, 1, 'C');

	$pdf->SetFont('times', '', 12);
	$pdf->Cell(0, 10, 'Supervisor: ' . $row['supervisor'], 0, 1);
	$pdf->Cell(0, 10, 'Nombre del Supervisor: ' . $row['nombre_supervisor'], 0, 1);
	$pdf->Cell(0, 10, 'Documento: ' . $row['documento'], 0, 1);

	$pdf->Cell(0, 10, 'ip: ' . $row['ip'], 0, 1);
	$pdf->Cell(0, 10, 'nombres: ' . $row['nombres'], 0, 1);
	$pdf->Cell(0, 10, 'sucursal: ' . $row['sucursal'], 0, 1);

	$pdf->Cell(0, 10, 'ventabruta: ' . $row['ventabruta'], 0, 1);
	$pdf->Cell(0, 10, 'baseefectivo: ' . $row['baseefectivo'], 0, 1);
	$pdf->Cell(0, 10, 'totalingreso: ' . $row['totalingreso'], 0, 1);

	$pdf->Cell(0, 10, 'chancesabonados: ' . $row['chancesabonados'], 0, 1);
	$pdf->Cell(0, 10, 'chancespreimpresos: ' . $row['chancespreimpresos'], 0, 1);
	$pdf->Cell(0, 10, 'premiospagados: ' . $row['premiospagados'], 0, 1);

	$pdf->Cell(0, 10, 'efectivocajafuerte: ' . $row['efectivocajafuerte'], 0, 1);
	$pdf->Cell(0, 10, 'totalegresos: ' . $row['totalegresos'], 0, 1);
	$pdf->Cell(0, 10, 'totalbilletes: ' . $row['totalbilletes'], 0, 1);

	$pdf->Cell(0, 10, 'totalmonedas: ' . $row['totalmonedas'], 0, 1);
	$pdf->Cell(0, 10, 'totalarqueo: ' . $row['totalarqueo'], 0, 1);
	$pdf->Cell(0, 10, 'sobrantefaltante: ' . $row['sobrantefaltante'], 0, 1);

	$pdf->Cell(0, 10, 'canti_billete_cienmil: ' . $row['canti_billete_cienmil'], 0, 1);
	$pdf->Cell(0, 10, 'total_billete_cienmil: ' . $row['total_billete_cienmil'], 0, 1);
	$pdf->Cell(0, 10, 'canti_billete_cincuentamil: ' . $row['canti_billete_cincuentamil'], 0, 1);

	$pdf->Cell(0, 10, 'total_billete_cincuentamil: ' . $row['total_billete_cincuentamil'], 0, 1);
	$pdf->Cell(0, 10, 'canti_billete_veintemil: ' . $row['canti_billete_veintemil'], 0, 1);
	$pdf->Cell(0, 10, 'total_billete_veintemil: ' . $row['total_billete_veintemil'], 0, 1);

	$pdf->Cell(0, 10, 'canti_billete_diezmil: ' . $row['canti_billete_diezmil'], 0, 1);
	$pdf->Cell(0, 10, 'total_billete_diezmil: ' . $row['total_billete_diezmil'], 0, 1);
	$pdf->Cell(0, 10, 'canti_billete_cincomil: ' . $row['canti_billete_cincomil'], 0, 1);


	$pdf->Cell(0, 10, 'total_billete_cincomil: ' . $row['total_billete_cincomil'], 0, 1);
	$pdf->Cell(0, 10, 'canti_billete_dosmil: ' . $row['canti_billete_dosmil'], 0, 1);
	$pdf->Cell(0, 10, 'total_billete_dosmil: ' . $row['total_billete_dosmil'], 0, 1);


	$pdf->Cell(0, 10, 'canti_billete_mil: ' . $row['canti_billete_mil'], 0, 1);
	$pdf->Cell(0, 10, 'canti_billete_mil: ' . $row['canti_billete_mil'], 0, 1);
	$pdf->Cell(0, 10, 'canti_moneda_mil: ' . $row['canti_moneda_mil'], 0, 1);


	$pdf->Cell(0, 10, 'total_moneda_mil: ' . $row['total_moneda_mil'], 0, 1);
	$pdf->Cell(0, 10, 'canti_moneda_quinientos: ' . $row['canti_moneda_quinientos'], 0, 1);
	$pdf->Cell(0, 10, 'total_moneda_quinientos: ' . $row['total_moneda_quinientos'], 0, 1);


	$pdf->Cell(0, 10, 'canti_moneda_docientos: ' . $row['canti_moneda_docientos'], 0, 1);
	$pdf->Cell(0, 10, 'total_moneda_docientos: ' . $row['total_moneda_docientos'], 0, 1);
	$pdf->Cell(0, 10, 'canti_moneda_cien: ' . $row['canti_moneda_cien'], 0, 1);


	$pdf->Cell(0, 10, 'total_moneda_cien: ' . $row['total_moneda_cien'], 0, 1);
	$pdf->Cell(0, 10, 'canti_moneda_cincuenta: ' . $row['canti_moneda_cincuenta'], 0, 1);
	$pdf->Cell(0, 10, 'total_moneda_ciencuenta: ' . $row['total_moneda_ciencuenta'], 0, 1);

	$pdf->Cell(0, 10, 'total_efectivo: ' . $row['total_efectivo'], 0, 1);
	$pdf->Cell(0, 10, 'total_premios_pagados: ' . $row['total_premios_pagados'], 0, 1);
	$pdf->Cell(0, 10, 'entrega_colocador: ' . $row['entrega_colocador'], 0, 1);


	$pdf->Cell(0, 10, 'sobrantefaltante_caja: ' . $row['sobrantefaltante_caja'], 0, 1);
	$pdf->Cell(0, 10, 'colocador_cajafuerte: ' . $row['colocador_cajafuerte'], 0, 1);
	$pdf->Cell(0, 10, 'rollos_bnet: ' . $row['rollos_bnet'], 0, 1);


	$pdf->Cell(0, 10, 'rollos_fisicos: ' . $row['rollos_fisicos'], 0, 1);
	$pdf->Cell(0, 10, 'diferencia: ' . $row['diferencia'], 0, 1);


	$pdf->Cell(0, 10, 'requisito1: ' . $row['requisito1'], 0, 1);
	$pdf->Cell(0, 10, 'observacion1: ' . $row['observacion1'], 0, 1);

	$pdf->Cell(0, 10, 'requisito2: ' . $row['requisito2'], 0, 1);
	$pdf->Cell(0, 10, 'observacion2: ' . $row['observacion2'], 0, 1);


	$pdf->Cell(0, 10, 'requisito3: ' . $row['requisito3'], 0, 1);
	$pdf->Cell(0, 10, 'observacion3: ' . $row['observacion3'], 0, 1);

	$pdf->Cell(0, 10, 'requisito4: ' . $row['requisito4'], 0, 1);
	$pdf->Cell(0, 10, 'observacion4: ' . $row['observacion4'], 0, 1);


	$pdf->Cell(0, 10, 'requisito5: ' . $row['requisito5'], 0, 1);
	$pdf->Cell(0, 10, 'observacion5: ' . $row['observacion5'], 0, 1);

	$pdf->Cell(0, 10, 'requisito6: ' . $row['requisito6'], 0, 1);
	$pdf->Cell(0, 10, 'observacion6: ' . $row['observacion6'], 0, 1);


	$pdf->Cell(0, 10, 'requisito7: ' . $row['requisito7'], 0, 1);
	$pdf->Cell(0, 10, 'observacion7: ' . $row['observacion7'], 0, 1);

	$pdf->Cell(0, 10, 'requisito8: ' . $row['requisito8'], 0, 1);
	$pdf->Cell(0, 10, 'observacion8: ' . $row['observacion8'], 0, 1);


	$pdf->Cell(0, 10, 'requisito9: ' . $row['requisito9'], 0, 1);
	$pdf->Cell(0, 10, 'observacion9: ' . $row['observacion9'], 0, 1);

	$pdf->Cell(0, 10, 'requisito10: ' . $row['requisito10'], 0, 1);
	$pdf->Cell(0, 10, 'observacion10: ' . $row['observacion10'], 0, 1);

	$pdf->Cell(0, 10, 'requisito11: ' . $row['requisito11'], 0, 1);
	$pdf->Cell(0, 10, 'observacion11: ' . $row['observacion11'], 0, 1);

	$pdf->Cell(0, 10, 'requisito12: ' . $row['requisito12'], 0, 1);
	$pdf->Cell(0, 10, 'observacion12: ' . $row['observacion12'], 0, 1);

	$pdf->Cell(0, 10, 'requisito13: ' . $row['requisito13'], 0, 1);
	$pdf->Cell(0, 10, 'observacion13: ' . $row['observacion13'], 0, 1);

	$pdf->Cell(0, 10, 'requisito14: ' . $row['requisito14'], 0, 1);
	$pdf->Cell(0, 10, 'observacion14: ' . $row['observacion14'], 0, 1);

	$pdf->Cell(0, 10, 'requisito15: ' . $row['requisito15'], 0, 1);
	$pdf->Cell(0, 10, 'observacion15: ' . $row['observacion15'], 0, 1);

	$pdf->Cell(0, 10, 'requisito16: ' . $row['requisito16'], 0, 1);
	$pdf->Cell(0, 10, 'observacion16: ' . $row['observacion16'], 0, 1);

	$pdf->Cell(0, 10, 'requisito17: ' . $row['requisito17'], 0, 1);
	$pdf->Cell(0, 10, 'observacion17: ' . $row['observacion17'], 0, 1);

	$pdf->Cell(0, 10, 'requisito18: ' . $row['requisito18'], 0, 1);
	$pdf->Cell(0, 10, 'observacion18: ' . $row['observacion18'], 0, 1);

	$pdf->Cell(0, 10, 'requisito19: ' . $row['requisito19'], 0, 1);
	$pdf->Cell(0, 10, 'observacion19: ' . $row['observacion19'], 0, 1);

	$pdf->Cell(0, 10, 'requisito20: ' . $row['requisito20'], 0, 1);
	$pdf->Cell(0, 10, 'observacion20: ' . $row['observacion20'], 0, 1);

	$pdf->Cell(0, 10, 'requisito21: ' . $row['requisito21'], 0, 1);
	$pdf->Cell(0, 10, 'observacion21: ' . $row['observacion21'], 0, 1);

	$pdf->Cell(0, 10, 'requisito22: ' . $row['requisito22'], 0, 1);
	$pdf->Cell(0, 10, 'observacion22: ' . $row['observacion22'], 0, 1);

	$pdf->Cell(0, 10, 'requisito23: ' . $row['requisito23'], 0, 1);
	$pdf->Cell(0, 10, 'observacion23: ' . $row['observacion23'], 0, 1);

	$pdf->Cell(0, 10, 'requisito24: ' . $row['requisito24'], 0, 1);
	$pdf->Cell(0, 10, 'observacion24: ' . $row['observacion24'], 0, 1);

	$pdf->Cell(0, 10, 'requisito25: ' . $row['requisito25'], 0, 1);
	$pdf->Cell(0, 10, 'observacion25: ' . $row['observacion25'], 0, 1);

	$pdf->Cell(0, 10, 'requisito26: ' . $row['requisito26'], 0, 1);
	$pdf->Cell(0, 10, 'observacion26: ' . $row['observacion26'], 0, 1);

	$pdf->Cell(0, 10, 'requisito27: ' . $row['requisito27'], 0, 1);
	$pdf->Cell(0, 10, 'observacion27: ' . $row['observacion27'], 0, 1);

	$pdf->Cell(0, 10, 'requisito28: ' . $row['requisito28'], 0, 1);
	$pdf->Cell(0, 10, 'observacion28: ' . $row['observacion28'], 0, 1);

	$pdf->Cell(0, 10, 'requisito29: ' . $row['requisito29'], 0, 1);
	$pdf->Cell(0, 10, 'requisito30: ' . $row['requisito30'], 0, 1);

	$pdf->Cell(0, 10, 'fechavisita: ' . $row['fechavisita'], 0, 1);
	$pdf->Cell(0, 10, 'horavisita: ' . $row['horavisita'], 0, 1);


	$pdf->Cell(0, 10, 'latitud: ' . $row['latitud'], 0, 1);
	$pdf->Cell(0, 10, 'longitud: ' . $row['longitud'], 0, 1);

	if (!empty($row['firma_auditoria']) && $row['firma_colocadora']) {
		$width = 50; // Nuevo ancho de la imagen
		$height = 50; // Nuevo alto de la imagen

		$pdf->Cell(0, 10, 'firma auditoria: ', 0, 1);
		$image_data1 = base64_decode(preg_replace('#^data:image/[^;]+;base64,#', '', base64_encode($row['firma_auditoria'])));
		// Agregar una imagen al PDF
		$pdf->Image('@' . $image_data1, 10, $pdf->GetY(), $width, $height, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);

		$espacio = 50;
		$pdf->SetY($pdf->GetY() + $espacio);


		$pdf->Cell(0, 10, 'firma colocadora: ', 0, 1); 
		// Decodificar la imagen en base64
		$image_data = base64_decode(preg_replace('#^data:image/[^;]+;base64,#', '', base64_encode($row['firma_colocadora'])));
		// Agregar una imagen al PDF
		$pdf->Image('@' . $image_data, 10, $pdf->GetY(), $width, $height, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
	}

	// Generar el PDF y mostrarlo en el navegador
	$pdf->Output('Reporte_Arqueo.pdf', 'D');
}
