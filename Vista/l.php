<?php
require('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
// Otros encabezados y configuraciones aquí...

ob_start(); // Iniciar el almacenamiento en búfer

// Tu código HTML aquí...
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="http://localhost/Arqueos/Vista/img/arqueo.ico" type="image/x-icon">
</head>

<body>


    <div class="container">

        <?php
        session_start();

        if (!isset($_SESSION['userLogin'])) {
            header('Location: login.php');
            exit;
        } else {

            include 'Menu2.php';
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

        ?>

            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2 class="center">Arqueo</h2>
                            <hr>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Supervisor: </label>
                        <?php echo $row['supervisor'] ?>
                    </div>
                  
                    <div class="form-group col-md-3">
                        <label>Dombre Del Supervisor: </label>
                        <?php echo $row['nombre_supervisor'] ?>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Documento:</label>
                        <?php echo "<input class='form-control' style='display:none;' value='" . $row["documento"] . "' name='documento' type='text'>" ?>
                        <?php echo $row["documento"] ?>
                    </div>
                    
                    <form action="verArqueo.php" method="post" name="formDatos">
                        <div class="form-group col-md-3">
                            <label>Ip: </label>
                            <?php echo $row["ip"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Nombres: </label>
                            <?php echo $row["nombres"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Sucursal: </label>
                            <?php echo $row['sucursal'] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Venta Bruta: </label>
                            <?php echo $row["ventabruta"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Base Efectivo: </label>
                            <?php echo $row["baseefectivo"] ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Total Ingreso: </label>
                            <?php echo $row["totalingreso"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Chances Abonados: </label>
                            <?php echo $row["chancesabonados"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Chances Preimpresos: </label>
                            <?php echo $row["chancespreimpresos"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Premios Pagados: </label>
                            <?php echo $row["premiospagados"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Efectivo Caja Cuerte: </label>
                            <?php echo $row["efectivocajafuerte"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Egresos: </label>
                            <?php echo $row["totalegresos"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Billetes: </label>
                            <?php echo $row["totalbilletes"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Monedas: </label>
                            <?php echo $row["totalmonedas"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Arqueo: </label>
                            <?php echo $row["totalarqueo"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sobrante Faltante: </label>
                            <?php echo $row["sobrantefaltante"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Billetes Fe Cienmil: </label>
                            <?php echo $row["canti_billete_cienmil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Billetes De Cienmil: </label>
                            <?php echo $row["total_billete_cienmil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Billetes De Cincuentamil: </label>
                            <?php echo $row["canti_billete_cincuentamil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Billete De Cincuentamil: </label>
                            <?php echo $row["total_billete_cincuentamil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Billetes De Veintemil: </label>
                            <?php echo $row["canti_billete_veintemil"] ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Total Billetes De Veintemil: </label>
                            <?php echo $row['total_billete_veintemil'] ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Cantidad Billetes De Diezmil: </label>
                            <?php echo $row['canti_billete_diezmil'] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Total Billetes De Diezmil: </label>
                            <?php echo $row["total_billete_diezmil"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Cantidad Billetes De Cincomil: </label>
                            <?php echo $row["canti_billete_cincomil"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Total Billetes De Cincomil: </label>
                            <?php echo $row["total_billete_cincomil"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Cantidad Billetes De Dosmil: </label>
                            <?php echo $row["canti_billete_dosmil"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Rotal Billete De Dosmil: </label>
                            <?php echo $row["total_billete_dosmil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Billetes De Mil: </label>
                            <?php echo $row["canti_billete_mil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Billetes De Mil: </label>
                            <?php echo $row["total_billete_mil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Monedas De Mil: </label>
                            <?php echo $row["canti_moneda_mil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Monedas De Mil: </label>
                            <?php echo $row["total_moneda_mil"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Monedas De Quinientos: </label>
                            <?php echo $row["canti_moneda_quinientos"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Monedas De Quinientos: </label>
                            <?php echo $row["total_moneda_quinientos"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Monedas De Docientos: </label>
                            <?php echo $row["canti_moneda_docientos"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Monedas De Docientos: </label>
                            <?php echo $row["total_moneda_docientos"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cantidad Monedas De Cien: </label>
                            <?php echo $row["canti_moneda_cien"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Monedas De Cien: </label>
                            <?php echo $row["total_moneda_cien"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Canti Monedas De Cincuenta: </label>
                            <?php echo $row["canti_moneda_cincuenta"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Monedas De Ciencuenta: </label>
                            <?php echo $row["total_moneda_ciencuenta"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Efectivo: </label>
                            <?php echo $row["total_efectivo"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Premios Pagados: </label>
                            <?php echo $row["total_premios_pagados"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Entrega Colocador: </label>
                            <?php echo $row["entrega_colocador"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sobrante Faltante De Caja: </label>
                            <?php echo $row["sobrantefaltante_caja"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Colocador Caja Fuerte: </label>
                            <?php echo $row["colocador_cajafuerte"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Rollos BNET: </label>
                            <?php echo $row["rollos_bnet"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Rollos Fisicos: </label>
                            <?php echo $row["rollos_fisicos"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Diferencia: </label>
                            <?php echo $row["diferencia"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Requisito 1: </label>
                            <?php echo $row["requisito1"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 1: </label>
                            <?php echo $row["observacion1"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 2: </label>
                            <?php echo $row["requisito2"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 2: </label>
                            <?php echo $row["observacion2"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 3: </label>
                            <?php echo $row["requisito3"] ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Observacion 3: </label>
                            <?php echo $row["observacion3"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 4: </label>
                            <?php echo $row["requisito4"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 4: </label>
                            <?php echo $row["observacion4"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 5: </label>
                            <?php echo $row["requisito5"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 5: </label>
                            <?php echo $row["observacion5"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Requisito 6 : </label>
                            <?php echo $row["requisito6"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 6: </label>
                            <?php echo $row["observacion6"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 7: </label>
                            <?php echo $row["requisito7"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 7: </label>
                            <?php echo $row["observacion7"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 8: </label>
                            <?php echo $row["requisito8"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Observacion 8: </label>
                            <?php echo $row["observacion8"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 9: </label>
                            <?php echo $row["requisito9"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 9:</label>
                            <?php echo $row["observacion9"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 10: </label>
                            <?php echo $row["requisito10"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 10: </label>
                            <?php echo $row["observacion10"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Requisito 11: </label>
                            <?php echo $row["requisito11"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 11: </label>
                            <?php echo $row["observacion11"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 12: </label>
                            <?php echo $row["requisito12"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 12: </label>
                            <?php echo $row["observacion12"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 13: </label>
                            <?php echo $row["requisito13"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Observacion 13: </label>
                            <?php echo $row["observacion13"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 14: </label>
                            <?php echo $row["requisito14"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 14: </label>
                            <?php echo $row["observacion14"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 15: </label>
                            <?php echo $row["requisito15"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 15: </label>
                            <?php echo $row["observacion15"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Requisito 16 : </label>
                            <?php echo $row["requisito16"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 16: </label>
                            <?php echo $row["observacion16"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 17: </label>
                            <?php echo $row["requisito17"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 17: </label>
                            <?php echo $row["observacion17"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 18: </label>
                            <?php echo $row["requisito18"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Observacion 18: </label>
                            <?php echo $row["observacion18"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 19: </label>
                            <?php echo $row["requisito19"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 19: </label>
                            <?php echo $row["observacion19"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 20: </label>
                            <?php echo $row["requisito20"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 20: </label>
                            <?php echo $row["observacion20"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Requisito 21: </label>
                            <?php echo $row["requisito21"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 21: </label>
                            <?php echo $row["observacion21"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 22: </label>
                            <?php echo $row["requisito22"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 22: </label>
                            <?php echo $row["observacion22"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 23: </label>
                            <?php echo $row["requisito23"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Observacion 23: </label>
                            <?php echo $row["observacion23"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 24: </label>
                            <?php echo $row["requisito24"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 24: </label>
                            <?php echo $row["observacion24"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 25: </label>
                            <?php echo $row["requisito25"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 25: </label>
                            <?php echo $row["observacion25"] ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Requisito 26: </label>
                            <?php echo $row["requisito26"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 26: </label>
                            <?php echo $row["observacion26"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 27: </label>
                            <?php echo $row["requisito27"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Observacion 27: </label>
                            <?php echo $row["observacion27"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 28: </label>
                            <?php echo $row["requisito28"] ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Observacion 28: </label>
                            <?php echo $row["observacion28"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 29: </label>
                            <?php echo $row["requisito29"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Requisito 30: </label>
                            <?php echo $row["requisito30"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>fecha visita: </label>
                            <?php echo $row["fechavisita"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>hora visita: </label>
                            <?php echo $row["horavisita"] ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label>latitud: </label>
                            <?php echo $row["latitud"] ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>longitud: </label>
                            <?php echo $row["longitud"] ?>
                        </div>


                    </form>
                </div>
            <?php
        }
            ?>

            </div>

</body>

</html>
<?php
$html = ob_get_clean(); // Obtener el contenido del búfer y limpiarlo

$pdf->SetXY(10, 1); // Establecer las coordenadas en la esquina superior izquierda
$pdf->MultiCell(0, 4, strip_tags($html));

$pdfContent = $pdf->Output('', 'S');

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Arqueo.pdf"');
header('Content-Length: ' . strlen($pdfContent));

echo $pdfContent; // Imprimir el contenido del PDF generado

?>