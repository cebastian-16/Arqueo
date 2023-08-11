<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ver Arqueo</title>
    <link rel='stylesheet prefetch' href='CSS/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="CSS/estilo.css">
    <script type="text/javascript" src="js/scripRegArt.js"></script>
    <link rel="icon" href="http://172.20.1.92/Arqueos/Vista/img/arqueo.ico" type="image/x-icon">
</head>

<body>
    <div class="container">

        <?php
        session_start();

        if ($_SESSION['cargoLogin'] != 'Auditoria' && $_SESSION['cargoLogin'] != 'Auxiliar Auditoria' && $_SESSION['cargoLogin'] != 'Auxiliar Comercial' && $_SESSION['rolLogin'] != 'SuperAdministrador' && $_SESSION['rolLogin'] != 'Administrador' && $_SESSION['procesoLogin'] != 'TIC' && $_SESSION['procesoLogin'] != 'Comercial') {
            session_destroy();
            header('Location: ../../errores/403/index.html');
            exit;
        }

        if (!isset($_SESSION['userLogin'])) {
            header('Location: login.php');
            exit;
        } else {

            include "Menu.php";
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
                            <h2>ARQUEO</b></h2>
                        </div>
                        <div class="col-sm-8">
                            <a href="pdf.php?documento=<?= $row['documento'] ?>" >
                                <button type="button" class="btn btn-success" style="margin-top: 0px !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="blue" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                            </svg>
                        </button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php if (empty($row)) { ?>
                    <div class="row">
                        <a href="index1.php">
                            <input type='button' value='volver' class="btn btn-primary">
                        </a>
                    </div>
                <?php } ?>
                <?php if (!empty($row)) { ?>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>supervisor:</label>
                            <?php echo "<input class='form-control' disabled value='" . $row['supervisor'] . "' name='supervisor ' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                        </div>
                        <form action="verArqueo.php" method="post" name="formDatos">
                            <div class="form-group col-md-3">
                                <label>Nombre Del Supervisor:</label>
                                <?php echo "<input class='form-control' disabled value='" . $row["nombre_supervisor"] . "' name='ip' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{1,40}' required> "; ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label>documento:</label>
                                <?php echo "<input class='form-control' style='display:none;' value='" . $row["documento"] . "' name='documento' type='text'>" ?>
                                <?php echo "<input class='form-control' disabled value='" . $row["documento"] . "' type='text'>" ?>
                            </div>
                            <form action="verArqueo.php" method="post" name="formDatos">
                                <div class="form-group col-md-3">
                                    <label>ip:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["ip"] . "' name='ip' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{1,40}' required> "; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>nombres:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["nombres"] . "' name='nombres' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{1,40}' required> "; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>sucursal:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row['sucursal'] . "' name='sucursal' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ventabruta:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["ventabruta"] . "' name='ventabruta' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>base efectivo:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["baseefectivo"] . "' name='baseefectivo' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{1,40}' required> "; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total ingreso:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["totalingreso"] . "' name='totalingreso' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>chances abonados:</label>
                                    <?php echo "<input class='form-control'   disabled value='" . $row["chancesabonados"] . "' name='chancesabonados' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>chances preimpresos:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["chancespreimpresos"] . "' name='memoria' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>premios pagados:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["premiospagados"] . "' name='almacenamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>efectivo caja fuerte:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["efectivocajafuerte"] . "' name='direccion' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total egresos:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["totalegresos"] . "' name='mac' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billetes:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["totalbilletes"] . "' name='ultimo_mantenimiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total monedas:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["totalmonedas"] . "' name='proximo_mantenimiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total arqueo</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["totalarqueo"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>sobrante faltante:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["sobrantefaltante"] . "' name='fecha_compra' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad billetes de cienmil:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["canti_billete_cienmil"] . "' name='V_CPU' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billetes de cienmil:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["total_billete_cienmil"] . "' name='V_MEM' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad billetes de cincuentamil:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["canti_billete_cincuentamil"] . "' name='V_DISCO' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billete de cincuentamil:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["total_billete_cincuentamil"] . "' name='V_FINAL' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad billetes de veintemil:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["canti_billete_veintemil"] . "' name='descripcion' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{1,40}' required> "; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billetes de veintemil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row['total_billete_veintemil'] . "' name='tipo_id' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad billetes de diezmil:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row['canti_billete_diezmil'] . "' name='ubicacion_id ' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billetes de diezmil:</label>
                                    <?php echo "<input class='form-control' disabled value='" . $row["total_billete_diezmil"] . "' name='observacion' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad billetes de cincomil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["canti_billete_cincomil"] . "' name='SISTEMAOPERATIVO' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{1,40}' required> "; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billetes de cincomil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_billete_cincomil"] . "' name='CPU' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad billetes de dosmil:</label>
                                    <?php echo "<input class='form-control'   disabled value='" . $row["canti_billete_dosmil"] . "' name='cache' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billete de dosmil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_billete_dosmil"] . "' name='memoria' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad billetes de mil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["canti_billete_mil"] . "' name='almacenamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total billetes de mil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_billete_mil"] . "' name='direccion' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad monedas de mil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["canti_moneda_mil"] . "' name='mac' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total monedas de mil:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_moneda_mil"] . "' name='ultimo_mantenimiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad monedasde quinientos:</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["canti_moneda_quinientos"] . "' name='proximo_mantenimiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total monedas de quinientos</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_moneda_quinientos"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad monedas de docientos</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["canti_moneda_docientos"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total monedas de docientos</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_moneda_docientos"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>cantidad monedas de cien</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["canti_moneda_cien"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total monedas de cien</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_moneda_cien"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>canti monedas de cincuenta</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["canti_moneda_cincuenta"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total monedas de ciencuenta</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_moneda_ciencuenta"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total efectivo</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_efectivo"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>total premioss de pagados</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["total_premios_pagados"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>entrega colocador</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["entrega_colocador"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>sobrante faltante de caja</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["sobrantefaltante_caja"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>colocador caja fuerte</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["colocador_cajafuerte"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>rollos bnet</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["rollos_bnet"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>rollos fisicos</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["rollos_fisicos"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>diferencia</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["diferencia"] . "' name='año_lanzamiento' type='int' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 1</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito1"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 1</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion1"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 2</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito2"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 2</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion2"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 3</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito3"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 3</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion3"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 4</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito4"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 4</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion4"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 5</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito5"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 5</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion5"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 6 </label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito6"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 6</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion6"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 7</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito7"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 7</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion7"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 8</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito8"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 8</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion8"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 9</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito9"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 9</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion9"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 10</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito10"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 10</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion10"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 11</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito11"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 11</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion11"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 12</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito12"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 12</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion12"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 13</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito13"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 13</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion13"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 14</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito14"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 14</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion14"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 15</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito15"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 15</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion15"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 16 </label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito16"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 16</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion16"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 17</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito17"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 17</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion17"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 18</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito18"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>observacion 18</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion18"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 19</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito9"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 19</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion19"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 20</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito20"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 20</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion20"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 21</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito21"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 21</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion21"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 22</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito22"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 22</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion22"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 23</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito23"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 23</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion23"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 24</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito24"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 24</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion24"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 25</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito25"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 25</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion25"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 26 </label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito26"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 26</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion26"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 27</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito27"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 27</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion27"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 28</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito28"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>observacion 28</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["observacion28"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 29</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito29"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>requisito 30</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["requisito30"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>fecha visita</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["fechavisita"] . "' name='año_lanzamiento' type='date' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>hora visita</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["horavisita"] . "' name='año_lanzamiento' type='text' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>latitud</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["latitud"] . "' name='año_lanzamiento' type='' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>longitud</label>
                                    <?php echo "<input class='form-control'  disabled value='" . $row["longitud"] . "' name='año_lanzamiento' type='' pattern='[a-zA-ZÀ-ÿ\u00f1\u00d1\0-9 ]{0,120}'>"; ?>
                                </div>



                                
                                <div class="form-group col-md-3">
                                    <label>Firma Auditor</label>
                                    <img src="data:image/PNG;base64,<?php  echo base64_encode($row['firma_auditoria']); ?>" style= "width: 70%; height: 10%;">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Firma Colocadora</label>
                                    <img src="data:image/PNG;base64,<?php  echo base64_encode($row['firma_colocadora']); ?>" style= "width: 70%; height: 10%;">
                                </div>



                                <div class="form-group col-md-12">
                                    <a href='index1.php'><input type='button' value='Volver' class="btn btn-primary"></a>
                                </div>
                            </form>
                    </div>
                <?php
                }
            }
            ?>

            </div>
            <script type="text/javascript" src='js/jquery.min.js'></script>
            <script type="text/javascript" src='js/bootstrap.min.js'></script>
            <script type="text/javascript">
                function hola() {
                    $("#id").val("hola");
                }
            </script>
</body>

</html>