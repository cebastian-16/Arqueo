<?php
session_start();

if (!isset($_SESSION['userLogin'])) {
    header('Location: login.php');
    exit;
} {

    if ($_SESSION['cargoLogin'] != 'Auditoria' && $_SESSION['cargoLogin'] != 'Auxiliar Auditoria' && $_SESSION['cargoLogin'] != 'Auxiliar Comercial' && $_SESSION['rolLogin'] != 'SuperAdministrador' && $_SESSION['rolLogin'] != 'Administrador' && $_SESSION['procesoLogin'] != 'TIC' && $_SESSION['procesoLogin'] != 'Comercial') {
        session_destroy();
        header('Location: ../../errores/403/index.html');
        exit;
    }

    require_once '../Modelo/conexion.php';
    include "Menu.php";

    $conectar = new conectar($_SESSION['sedeStock']);
    $conexion = $conectar->conexion();


    if($_SESSION['sedeStock'] == "Multired") {

        // Configuración de la paginación
        $resultadosPorPagina = 10; // Número de resultados por página
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página actual, obtenida del parámetro "pagina" en la URL

        $totalResultadosConsulta = "SELECT COUNT(*) AS total FROM appseguimientos.registro_arqueo_servired";
        $totalResultados = $conexion->query($totalResultadosConsulta);
        $resultado = $totalResultados->fetch_assoc();
        $totalPaginas = ceil($resultado['total'] / $resultadosPorPagina);

        // Calcular el índice inicial y final de los resultados a mostrar en la página actual
        $indiceInicio = ($paginaActual - 1) * $resultadosPorPagina;
        $consultaDatos = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, '') AS nombre_supervisor, s.*
        FROM appseguimientos.registro_arqueo_servired s
        INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login
        LIMIT $indiceInicio, $resultadosPorPagina";
        $sentencia = $conexion->prepare($consultaDatos);
        $sentencia->execute();
        $resultadoDatos = $sentencia->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    if ($_SESSION['sedeStock'] == "Servired") {
        // Configuración de la paginación
        $resultadosPorPagina = 6; // Número de resultados por página
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página actual, obtenida del parámetro "pagina" en la URL

        $totalResultadosConsulta = "SELECT COUNT(*) AS total FROM appseguimiento.registro_arqueo_servired";
        $totalResultados = $conexion->query($totalResultadosConsulta);
        $resultado = $totalResultados->fetch_assoc();
        $totalPaginas = ceil($resultado['total'] / $resultadosPorPagina);

        

        // Calcular el índice inicial y final de los resultados a mostrar en la página actual
        $indiceInicio = ($paginaActual - 1) * $resultadosPorPagina;
        $consultaDatos = "SELECT s.supervisor, IF(s.supervisor = b.login, b.nombre, '') AS nombre_supervisor, s.*
        FROM appseguimiento.registro_arqueo_servired s
        INNER JOIN bdpersonas.tbusuario b ON s.supervisor = b.login 
        LIMIT $indiceInicio, $resultadosPorPagina";
        $sentencia = $conexion->prepare($consultaDatos);
        $sentencia->execute();
        $resultadoDatos = $sentencia->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
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
    <div class="container-fluid">

        <div class="table-wrapper">

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

            <div class="users-table">
                <table class="table-bordered">
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
                                    <?php foreach ($resultadoDatos as $row) : ?>
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
                                            <img src="data:image/PNG;base64,<?php  echo base64_encode($row['firma_auditoria']); ?>" style= "width: 70%; height: 10%;">
                                        </th>
                                        <th>
                                            <img src="data:image/PNG;base64,<?php  echo base64_encode($row['firma_colocadora']); ?>" style= "width: 70%; height: 10%;">
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
            </th>
        </div>

        <!-- Paginación -->
        <div class="paginacion">
            <div aria-label="Page navigation example">
                <?php if ($totalPaginas > 1) : ?>
                    <ul class="pagination">
                        <?php if ($paginaActual > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?= ($paginaActual - 1) ?>">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = max(1, $paginaActual - 2); $i <= min($paginaActual + 2, $totalPaginas); $i++) : ?>
                            <li class="page-item <?= ($paginaActual == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($paginaActual < $totalPaginas) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?= ($paginaActual + 1) ?>">Siguiente</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>

</body>

</html>