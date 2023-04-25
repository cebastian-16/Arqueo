<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/style.css" rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
    <link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>



    <div class="container-fluid">
        <?php
        session_start();



        if (!isset($_SESSION['userLogin'])) {
            header('Location: login.php');
            exit;
        } else {

            if ($_SESSION['cargoLogin'] != 'Auditoria' && $_SESSION['rolLogin'] != 'SuperAdministrador') {
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
                    $modificarDatos = $datos->consultar($ip, $nombres, $documento, $sucursal, $supervisor, $ventabruta, $_SESSION['userLogin']);
                }
                if ($accion == "Consultar") {
                    $fechavisitaM = $_POST['fechavisitaM'];
                    $resultadoArqueo = $articulo->consultarArqueo($fechavisitaM);
                    $consultaM = mysqli_fetch_array($resultadoArqueo);

                    if (empty($consultaM)) {
                        echo "<div class='alert alert-danger alert-dismissible'>";
                        echo "  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                        echo "  <a href='index.php?'><h3><strong>Error!</strong> No se encontraron registros volver al inicio</h3>";
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
                                <tr>
                                    <div class="table-wrapper">
                                        <?php if (empty($consultaM)) { ?>
                                            <form action="buscador.php" method="post" name="ModArticulo" class="search-form">
                                                <div class="form-group">
                                                    <label for="placa" class="sr-only"></label>
                                                    <input class='form-control' name='fechavisitaM' type='date'>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <input type="submit" name="boton" value="Consultar" class="btn btn-primary">
                                                </div>
                                            </form>

                                        <?php } ?>
                                        <th>supervisor</th>
                                        <th>nombre completo</th>
                                        <th>ip</th>
                                        <th>nombres</th>
                                        <th>documento</th>
                                        <th>sucursal</th>
                                        <th>venta bruta</th>
                                        <th>base efectivo</th>
                                        <th>total ingreso</th>
                                        <th>fecha visita</th>
                                        <th>hora visita</th>
                                        <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php while ($consultaM = mysqli_fetch_array($resultadoArqueo)) : ?>

                                        <th>
                                            <?= $consultaM['supervisor'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['nombre_supervisor'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['ip'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['nombres'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['documento'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['sucursal'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['ventabruta'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['baseefectivo'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['totalingreso'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['fechavisita'] ?>
                                        </th>
                                        <th>
                                            <?= $consultaM['horavisita'] ?>
                                        </th>
                                        <th>
                                            <?php echo "<a href='verArqueo.php?documento=" . $consultaM['documento'] . "' ><svg style='color:blue'  xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'>
				                        <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/>
				                        </svg></a>"; ?>
                                        </th>
                                </tr>

                            <?php endwhile; ?>
                            </tbody>

                        </table>

                    </div>


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
            $("#placa").val("hola");
        }
    </script>
</body>

</html>