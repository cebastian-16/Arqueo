<?PHP
session_start();
if ($_SESSION['cargoLogin'] != 'Auditoria' && $_SESSION['cargoLogin'] != 'Auxiliar Auditoria' && $_SESSION['rolLogin'] != 'SuperAdministrador' && $_SESSION['procesoLogin'] != 'TIC') {
    session_destroy();
    header('Location: ../../errores/403/index.html');
    exit;
}

if (!isset($_SESSION['userLogin'])) {
    header('Location: ../../login-gane/view/login.php');
}

if ($_SESSION['sedeLogin'] == "Multired" || (isset($_GET["empresa"]) && $_GET["empresa"] == "Multired")) {
    $_SESSION['sedeStock'] = "Multired";
    header('Location: index.php');
}

if ($_SESSION['sedeLogin'] == "Servired" || (isset($_GET["empresa"]) && $_GET["empresa"] == "Servired")) {
    $_SESSION['sedeStock'] = "Servired";
    header('Location: index.php');
}


if ($_SESSION['sedeLogin'] == "Multired Y Servired") { //Cargar seleccion de empresa
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <title>Empresa</title>
    </head>

    <body style="background: linear-gradient(90deg, #3e4751 0%, #25303c 100%);">
        <div class="container-fluid">
            <div class="row" style="margin-top: 10%;">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body center">
                            <img src="./img/multired.png" class="img img-responsive">
                            GRUPO EMPRESARIAL MULTIRED
                            <a href="empresa.php?empresa=Multired">
                                <button type="button" class="btn btn-primary">Ingresar</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="./img/servired.png" class="img img-responsive">
                            GRUPO EMPRESARIAL SERVIRED
                            <a href="empresa.php?empresa=Servired">
                                <button type="button" class="btn btn-warning">Ingresar</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>