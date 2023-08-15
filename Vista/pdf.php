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

	class MYPDF extends TCPDF {

	
		public function Header() {
			$path = dirname( __FILE__ );
			$logo = $path.include "Menu.php";
	
			/**Logo Derecha */
			$bMargin = $this->getBreakMargin();
			$auto_page_break = $this->AutoPageBreak;
			$this->SetAutoPageBreak(false, 0);
			//$img_file = '/img/logo.png';
			$img_file = dirname( __FILE__ ) .'/img/logo.png';
			$this->Image($img_file, 30, 28, 20, 20, '', '', '', false, 30, '', false, false, 0);
			$this->SetAutoPageBreak($auto_page_break, $bMargin);
			$this->setPageMark();
	
			$this->Ln(20);
			/**Logo Izquierdo  $this->Image('src imagen', Eje X, Eje Y, Tamaño de la Imagen );*/ 
			$this->Image($logo, 180, 12, 15 );
	
			$this->SetFont('helvetica','B',8); //Tipo de fuente y tamaño de letra
			$this->SetXY(130, 29);
			$this->SetTextColor(34,68,136);
			$this->Write(0, 'Bogotá - Colombia '. date('d-m-Y h:i A'));
	
			$this->Ln(20);
			$this->SetFont('helvetica','B',18); //('helvetica','B',8)
			$this->Cell(30);
			$this->Cell(105,30, 'Comunidad WebDeveloper',0,0,'C');
			
			$this->Ln(5); //Salto de Linea
			$this->SetFont('helvetica','I',10);
			$this->Cell(10);
			$this->Cell(135,35, 'Bienvenidos ...!',0,0,'C');
	
		}

	}
	

	// Crear una instancia de TCPDF
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set header and footer fonts
	$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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


	$pdf->Cell(0, 10, '¿El punto de venta tiene puerta cerrada con candado y/o seguro?: ' . $row['requisito1'], 0, 1);
	$pdf->Cell(0, 10, 'observacion1: ' . $row['observacion1'], 0, 1);

	$pdf->Cell(0, 10, '¿Tiene elementos de aseo, sillas en buen estado?: ' . $row['requisito2'], 0, 1);
	$pdf->Cell(0, 10, 'observacion2: ' . $row['observacion2'], 0, 1);


	$pdf->Cell(0, 10, '¿Tiene aviso de videovigilancia y camaras?: ' . $row['requisito3'], 0, 1);
	$pdf->Cell(0, 10, 'observacion3: ' . $row['observacion3'], 0, 1);

	$pdf->Cell(0, 10, '¿El Colocador cuenta con prendas emblematicas y presentación adecuada?: ' . $row['requisito4'], 0, 1);
	$pdf->Cell(0, 10, 'observacion4: ' . $row['observacion4'], 0, 1);


	$pdf->Cell(0, 10, '¿El usuario del colocador corresponde a la cedula del mismo?: ' . $row['requisito5'], 0, 1);
	$pdf->Cell(0, 10, 'observacion5: ' . $row['observacion5'], 0, 1);

	$pdf->Cell(0, 10, '¿La versión del aplicativo BNET esta actualizada?: ' . $row['requisito6'], 0, 1);
	$pdf->Cell(0, 10, 'observacion6: ' . $row['observacion6'], 0, 1);


	$pdf->Cell(0, 10, '¿El colocador ofrece los productos y servicios comercializados por la empresa al 100%?: ' . $row['requisito7'], 0, 1);
	$pdf->Cell(0, 10, 'observacion7: ' . $row['observacion7'], 0, 1);

	$pdf->Cell(0, 10, '¿La publicidad exhibida en el punto de venta se encuentra actualizada?: ' . $row['requisito8'], 0, 1);
	$pdf->Cell(0, 10, 'observacion8: ' . $row['observacion8'], 0, 1);


	$pdf->Cell(0, 10, '¿El colocador solicita el documento de identificación al cliente?: ' . $row['requisito9'], 0, 1);
	$pdf->Cell(0, 10, 'observacion9: ' . $row['observacion9'], 0, 1);

	$pdf->Cell(0, 10, 'El uso del sistema biométrico esta activo?: ' . $row['requisito10'], 0, 1);
	$pdf->Cell(0, 10, 'observacion10: ' . $row['observacion10'], 0, 1);

	$pdf->Cell(0, 10, '¿El colocador conoce de Supervoucher, y esta en funcionamiento?: ' . $row['requisito11'], 0, 1);
	$pdf->Cell(0, 10, 'observacion11: ' . $row['observacion11'], 0, 1);

	$pdf->MultiCell(100, 10, '¿El Colocador conoce el procedimiento que debe realizar a remitentes y destinatarios menores de edad?: ' . $row['requisito12'], 0, 'L');
	$pdf->Cell(0, 10, 'observacion12: ' . $row['observacion12'], 0, 1);

	$pdf->MultiCell(0, 10, '¿El colocador conoce los reportes de operaciones en efectivo (R.O.E) firmas, huellas. (Transacciones =$10.000.000)?: ' . $row['requisito13'], 0, 1);
	$pdf->Cell(0, 10, 'observacion13: ' . $row['observacion13'], 0, 1);

	$pdf->MultiCell(0, 10, '¿Tiene aviso externo que indica Vigilado y Controlado Mintic y Colaborador Autorizado?: ' . $row['requisito14'], 0, 1);
	$pdf->Cell(0, 10, 'observacion14: ' . $row['observacion14'], 0, 1);

	$pdf->MultiCell(0, 10, '¿Tiene cuadro Banner con la marca SuperGIROS (aviso de canales de comunicación)?: ' . $row['requisito15'], 0, 1);
	$pdf->Cell(0, 10, 'observacion15: ' . $row['observacion15'], 0, 1);

	$pdf->MultiCell(0, 10, '¿Tiene afiche normativo visible o tarifario con las condiciones del servicio?: ' . $row['requisito16'], 0, 1);
	$pdf->Cell(0, 10, 'observacion16: ' . $row['observacion16'], 0, 1);

	$pdf->MultiCell(0, 10, '¿Cuenta con sticker tirilla electronica CRC?: ' . $row['requisito17'], 0, 1);
	$pdf->Cell(0, 10, 'observacion17: ' . $row['observacion17'], 0, 1);

	$pdf->MultiCell(0, 10, '¿Tiene normativa Giros Internacionales, camara o lector five y Sticker de pagos internacionales?: ' . $row['requisito18'], 0, 1);
	$pdf->Cell(0, 10, 'observacion18: ' . $row['observacion18'], 0, 1);

	$pdf->MultiCell(0, 10, '¿El Supervisor Comercial realiza las visitas constantemente, da buen trato y suministra los insumos a tiempo?  Cantidad de visitas del Supervisor Comercial al mes?: ' . $row['requisito19'], 0, 1);
	$pdf->Cell(0, 10, 'observacion19: ' . $row['observacion19'], 0, 1);

	$pdf->MultiCell(0, 10, '¿Las recargas efectuadas por el Colocador se trasmiten a través de la red propia de la empresa?: ' . $row['requisito20'], 0, 1);
	$pdf->Cell(0, 10, 'observacion20: ' . $row['observacion20'], 0, 1);

	$pdf->MultiCell(0, 10, '¿La lotería física tiene impreso el nombre de la empresa, de no ser asi reportar inmediatamente?: ' . $row['requisito21'], 0, 1);
	$pdf->Cell(0, 10, 'observacion21: ' . $row['observacion21'], 0, 1);

	$pdf->MultiCell(0, 10, '¿El punto de venta tiene caja fuerte y caja digital? el responsable tiene conocimiento sobre las bases de efectivo asignadas para caja auxiliar y caja digital?: ' . $row['requisito22'], 0, 1);
	$pdf->Cell(0, 10, 'observacion22: ' . $row['observacion22'], 0, 1);

	$pdf->MultiCell(0, 10, '¿Se cumple con los topes de efectivo establecidos para la caja digital  y caja auxiliar (ptos de venta con giros)?: ' . $row['requisito23'], 0, 1);
	$pdf->Cell(0, 10, 'observacion23: ' . $row['observacion23'], 0, 1);

	$pdf->MultiCell(0, 10, '¿El colocador tiene conocimiento sobre los montos máximos para pago de premios?: ' . $row['requisito24'], 0, 1);
	$pdf->Cell(0, 10, 'observacion24: ' . $row['observacion24'], 0, 1);

	$pdf->MultiCell(0, 10, '¿El colocador conoce los requisitos para pago de premios?: ' . $row['requisito25'], 0, 1);
	$pdf->Cell(0, 10, 'observacion25: ' . $row['observacion25'], 0, 1);

	$pdf->Cell(0, 10, '¿Tiene buzon de PQR, formato de gane y de giros?: ' . $row['requisito26'], 0, 1);
	$pdf->Cell(0, 10, 'observacion26: ' . $row['observacion26'], 0, 1);

	$pdf->MultiCell(0, 10, '¿El Colocador cuenta con las bases acerca del SARL, SARLAFT, SARO?: ' . $row['requisito27'], 0, 1);
	$pdf->Cell(0, 10, 'observacion27: ' . $row['observacion27'], 0, 1);

	$pdf->MultiCell(0, 10, '¿El Colocador conoce la definición de operación inusual y operación sospechosa?: ' . $row['requisito28'], 0, 1);
	$pdf->Cell(0, 10, 'observacion28: ' . $row['observacion28'], 0, 1);

	$pdf->Cell(0, 10, 'VERIFICACION INSUMOS PARA PREVENCION DE COVID 19: ' . $row['requisito29'], 0, 1);
	$pdf->Cell(0, 10, '¿Tapabocas?: ' . $row['requisito30'], 0, 1);

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
	$pdf->Output();
}
