<!DOCTYPE html>
<html>

<head>

    <head>
        <meta charset="UTF-8">
        <title>Buscar Arqueo</title>
        <link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/scripRegArt.js"></script>
        <link rel="icon" href="http://localhost/Arqueos/Vista/img/arqueo.ico" type="image/x-icon">
    </head>
</head>

<body>
    <div class="container-fluid">
        <?php
        session_start();
        if (!isset($_SESSION['userLogin'])) {
            header('Location: login.php');
            exit;
        } else {
            if ($_SESSION['cargoLogin'] != 'Auditoria' && $_SESSION['cargoLogin'] != 'Auxiliar Auditoria' && $_SESSION['cargoLogin'] != 'Auxiliar Comercial' && $_SESSION['rolLogin'] != 'SuperAdministrador' && $_SESSION['rolLogin'] != 'Administrador' && $_SESSION['procesoLogin'] != 'TIC' && $_SESSION['procesoLogin'] != 'Comercial') {
                session_destroy();
                header('Location: ../../errores/403/index.html');
                exit;
            }
            include "Menu.php";
            include '../Controlador/controladorArqueo.php';
            $articulo = new datos;

            if (!empty($_POST['boton'])) {
                $accion = $_POST['boton'];
                if ($accion == "Modificar") {
                    $fechavisitaM = $_POST['fechavisitaM'];
                    $ip = $_POST['ip'];
                    $nombres = $_POST['nombres'];
                    $documento = $_POST['documento '];
                    $sucursal = $_POST['sucursal '];
                    $supervisor = $_POST['supervisor'];
                    $ventabruta = $_POST['ventabruta'];
                    $modificarDatos = $datos->consultar($ip, $nombres, $documento, $sucursal, $supervisor, $ventabruta, $fechavisitaM, $_SESSION['userLogin']);
                }
                if ($accion == "Consultar") {
                    $fechavisitaM = $_POST['fechavisitaM'];
                    $resultadoArqueo = $articulo->consultarArqueo($fechavisitaM);
                    $consultaM = mysqli_fetch_array($resultadoArqueo);

                    if (empty($consultaM)) {
                        echo "<div class='alert alert-danger alert-dismissible'>";
                        echo "  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                        echo "  <a ><h4><strong>Error!</strong> No se encontraron registros </h4>";
                        echo "</div>";
                    }
                }
            }
        ?>

            <!-- recoge el dato que mandan desde el php index -->
            <?php if (!empty($consultaM)) { ?>
                <div class="table-wrapper">
                    <div class="users-table">
                        <table class="table-bordered">
                            <thead>
                                <th>Supervisor</th>
                                <th>Nombre Completo</th>
                                <th>IP</th>
                                <th>Nombres</th>
                                <th>Documento</th>
                                <th>Sucursal</th>
                                <th>Venta Bruta</th>
                                <th>Base Efectivo</th>
                                <th>Total Ingreso</th>
                                <th>Fecha Visita</th>
                                <th>Hora Visita</th>
                                <th>Firma Auditor</th>
                                <th>Firma Colocadora</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($resultadoArqueo as $row) : ?>
                                        <th>
                                            <?= $row['supervisor'] ?>
                                        </th>
                                        <th>
                                            <?= $row['nombre_supervisor'] ?>
                                        </th>
                                        <th>
                                            <?= $row['ip'] ?>
                                        </th>
                                        <th>
                                            <?= $row['nombres'] ?>
                                        </th>
                                        <th>
                                            <?= $row['documento'] ?>
                                        </th>
                                        <th>
                                            <?= $row['sucursal'] ?>
                                        </th>
                                        <th>
                                            <?= $row['ventabruta'] ?>
                                        </th>
                                        <th>
                                            <?= $row['baseefectivo'] ?>
                                        </th>
                                        <th>
                                            <?= $row['totalingreso'] ?>
                                        </th>
                                        <th>
                                            <?= $row['fechavisita'] ?>
                                        </th>
                                        <th>
                                            <?= $row['horavisita'] ?>
                                        </th>
                                        <th>
                                            <img src="data:image/PNG;base64,<?php echo base64_encode($row['firma_auditoria']); ?>" style="width: 70%; height: 10%;">
                                        </th>
                                        <th>
                                            <img src="data:image/PNG;base64,<?php echo base64_encode($row['firma_colocadora']); ?>" style="width: 70%; height: 10%;">
                                        </th>
                                        <th>
                                            <!-- manda la variable al buscar php -->
                                            <?php echo "<a href='verArqueo.php?documento=" . $row['documento'] . "' ><svg style='color:blue'  xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'>
				                        <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/>
				                        </svg></a>"; ?>
                                        </th>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="form-group col-md-12">
        <a href='index1.php'><input type='button' value='Volver' class="BOTON"></a>
    </div>
    <script type="text/javascript" src='js/jquery.min.js'></script>
    <script type="text/javascript" src='js/bootstrap.min.js'></script>
    <script type="text/javascript">
        function hola() {
            $("#placa").val("hola");
        }
    </script>
</body>

</html>