<!DOCTYPE html>
<html lang="en">

<head>
    <title> Arqueo</title>
    <link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/scripRegArt.js"></script>
    <link rel="icon" href="http://localhost/Arqueos/Vista/img/arqueo.ico" type="image/x-icon">

</head>

<body>

    </div>
    <div class="container-fluid">

        <?php
        session_start();

        if (!isset($_SESSION['userLogin'])) {
            header('Location: login.php');
            exit;
        } {

            if ($_SESSION['cargoLogin'] != 'Auditoria' && $_SESSION['rolLogin'] != 'SuperAdministrador') {
                session_destroy();
                header('Location: ../../errores/403/index.html');
                exit;
            }
            include "Menu.php";

            include '../Controlador/controladorArqueo.php';
            $datos = new datos;

            $resultadoDatos = $datos->mirarDatos();
            $row = mysqli_fetch_array($resultadoDatos);


            // if (!empty($_POST['boton'])) {
            //     $accion = $_POST['boton'];
            //     if ($accion == "Modificar") {
            //         $ip = $_POST['ip'];
            //         $nombres = $_POST['nombres'];
            //         $documento = $_POST['documento '];
            //         $sucursal = $_POST['sucursal '];
            //         $supervisor = $_POST['supervisor'];
            //         $ventabruta = $_POST['ventabruta'];
            //         $modificarDatos = $datos->mirarDatos($ip, $nombres, $documento, $sucursal, $supervisor, $ventabruta, $_SESSION['userLogin']);
            //     }
            // }
        ?>

            <div class="table-wrapper">
                <?php if (empty($consultaM)) { ?>
                    <form action="buscador.php" method="post" name="ModArticulo" class="search-form">
                        <div class="form-group">
                            <label for="fechavisita" class="sr-only"></label>
                            <input type="date" name="fechavisitaM" class="form-control ">
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="boton" value="Consultar" class="btn btn-primary">
                        </div>
                    </form>
                <?php } ?>
                <div class="users-table">

                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th >supervisor</th>
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
                                <?php while ($row = mysqli_fetch_array($resultadoDatos)) : ?>
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
                                        <!-- manda la variable al buscar php -->
                                        <?php echo "<a href='verArqueo.php?documento=" . $row['documento'] . "' ><svg style='color:blue'  xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'>
				                        <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/>
				                        </svg></a>"; ?>
                                    </th>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </th>
        <?php
        }
        ?>
</body>

</html>