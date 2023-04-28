<nav class="navbar navbar-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
        <?php
        if ($_SESSION['sedeStock'] == "Servired") {
          echo "<img style='height: 68px; width: 153px;' src='img/ganeJamundi.png'>";
        } else {
          echo "<img style='height: 68px; width: 153px;' src='img/ganeYumbo.png'>";
        }
        ?>

      </a>
    </div>
    <ul class="nav navbar-nav">
      <?php if ($_SESSION['cargoLogin'] == 'Auditoria' || $_SESSION['cargoLogin'] == 'Auditoria'  || $_SESSION['rolLogin'] == 'Administrador') { ?>

        <?php if ($_SESSION['rolLogin'] == 'SuperAdministrador') { ?>

      <?php
        }
      } ?>
    </ul>
    <div class="navbar-header navbar-right">
      <div class="navbar-brand session">
        <?php echo $_SESSION['userLogin'] ?>
        <a href="cerrars.php">
          <span class="hola">CERAR</span>
        </a>
      </div>
    </div>
  </div>
</nav>