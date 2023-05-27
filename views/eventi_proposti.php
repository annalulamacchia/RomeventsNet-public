<!DOCTYPE html>
<?php
session_start();
?>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\css\bootstrap.css" />
  <script src="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\js\bootstrap.bundle.js"
    type="application/javascript"></script>
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <link rel="stylesheet" href="..\css\eventi.css">
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px">
</head>

<body class="text-center">

  <!--Navbar superiore-->
  <?php include 'navbar.php'; ?>

  <div class="row mx-auto my-2">
    <form name="filter" method="POST" action="" class="d-inline-flex" enctype="multipart/form-data">
      <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11"> </div>
      <ul class="nav-item p-0 m-0 col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
        <ul class="navbar-nav p-1">
          <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="../imgs/icons/filter-filled-tool-symbol.png" height="25px" width="25px">
            </a>
            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
              <li>
                <div name="ordina" type="button" class="dropdown-item">Ordina per:</div>
              </li>
              <li>
                <input name="ord_artista" type="submit" value="Nome" class="select1 dropdown-item ms-3"></input>
              </li>
              <li>
                <input name="ord_data" type="submit" value="Data" class="select1 dropdown-item ms-3"></input>
              </li>
              <li>
                <input name="ord_luogo" type="submit" value="Luogo" class="select1 dropdown-item ms-3"></input>
              </li>
              <li>
                <input name="ord_tipo" type="submit" value="Tipo Evento" class="select1 dropdown-item ms-3"></input>
              </li>
              <li>
                <input type="submit" name="Tutti" value="Elimina filtri" class="select1 dropdown-item ms-3"></input>
              </li>
            </ul>
        </ul>
      </ul>
    </form>
  </div>

  <!--Parte dinamica-->
  <?php
  //connessione al database
  $eventi_prop = new PDO('sqlite:../db/databaseREN');
  if (isset($_POST['ord_artista'])) {
    $sql = "SELECT* FROM Eventi_Proposti ORDER BY nome";
    unset($_POST['ord_artista']);
  } else if (isset($_POST['ord_data'])) {
    $sql = "SELECT* FROM Eventi_Proposti  ORDER BY substr (data,0,2) and substr(data,3,5) and substr(data,6,10) ASC";
    unset($_POST['ord_data']);
  } else if (isset($_POST['ord_luogo'])) {
    $sql = "SELECT* FROM Eventi_Proposti ORDER BY luogo";
    unset($_POST['ord_luogo']);
  } else if (isset($_POST['ord_tipo'])) {
    $sql = "SELECT* FROM Eventi_Proposti ORDER BY tipo_evento";
    unset($_POST['ord_tipo']);
  } else if (isset($_POST['Tutti'])) {
    $sql = "SELECT* FROM Eventi_Proposti";
    unset($_POST['Tutti']);
  } else {
    $sql = "SELECT* FROM Eventi_Proposti";
  }
  $resultset = $eventi_prop->query($sql);
  foreach ($resultset as $record) {
    ?>
    <div class="card1 col-xxs-11">
      <img alt="" class="img1" src="<?php echo $record['locandina']; ?>">
      <div class="textBox">
        <span class="span1">
          <?php
          if ($record['instagram'] != "") {
            ?>
            <a href="https://www.instagram.com/<?php echo $record['instagram'];
            echo "/"; ?>" target="_blank">
              <img src="..\imgs\icons\instagram.png" height="22px" width="22px">
            </a>
            <?php
          }
          ?>
        </span>
        <div class="textContent">
          <div class="h1 h1-xxs">
            <?php echo $record['nome']; ?>
          </div>
        </div>
        <div class="h2 h2-xxs">
          <?php echo $record['tipo_evento']; ?>
        </div>
        <div class="row">
          <div class="col-2 my-auto mx-auto">
            <img src="..\imgs\icons\placeholder.png" width="25px" height="25px">
          </div>
          <div class="p p-xxs col-9 mx-auto my-auto">
            <?php echo $record['luogo']; ?>
          </div>
        </div>
        <div class="row">
          <div class="col-2 my-auto mx-auto">
            <img src="..\imgs\icons\schedule.png" class="align-text-center" width="25px" height="25px">
          </div>
          <div class="p p-xxs col-9 mx-auto my-auto">
            <?php echo $record['data']; ?>
          </div>
        </div>
        <div class="row">
          <div class="col-2 my-auto mx-auto">
            <img src="..\imgs\icons\clock.png" class="align-text-center" width="25px" height="25px">
          </div>
          <div class="p p-xxs col-9 mx-auto my-auto">
            <?php echo $record['orario']; ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  <?php } ?>
  <div class="mb-3"></div>
</body>
<?php include 'footer.html'; ?>

</html>