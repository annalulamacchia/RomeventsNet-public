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
  <link rel="stylesheet" href="..\css\eventi.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
</head>

<body class="text-center mx-auto">
  <!--Navbar superiore-->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" type="button" href="../views/index.php">
        <img src="..\imgs\icons\coliseum_128px.png" alt="" width="40" height="40"
          class="d-inline-block align-text-center"> RomeventsNet
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item mx-auto">
            <ul class="input-group w-auto">
              <form class="d-flex" name="search" method="GET" action="search.php" enctype="multipart/form-data">
                <input type="search" name="nome" class="form-control rounded form-control-lg pe-sm-5"
                  placeholder="Ricerca artisti o eventi" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn" id="search" name="cerca">
                  <img src="../imgs/icons/search.png" height="25px" width="25px">
                </button>
              </form>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown m-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false"> Menu
            </a>
            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
              <li>
                <a class="dropdown-item" type="button" href="../views/concerti.php"> Concerti </a>
              </li>
              <li>
                <a class="dropdown-item" type="button" href="../views/mostre.php"> Mostre </a>
              </li>
              <li>
                <a class="dropdown-item" type="button" href="../views/teatri.php"> Spettacoli Teatrali </a>
              </li>
              <li>
                <a class="dropdown-item" type="button" href="../views/eventi_proposti.php"> Eventi proposti da voi </a>
              </li>
              <li>
                <a class="dropdown-item" type="button" href="../views/form_compagno.php"> Trova un amico </a>
              </li>
              <li>
                <a class="dropdown-item" type="button" href="../views/form_invia_evento.php"> Invia un evento </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link m-2" id="iscriviti" href="../views/iscriviti.php">Iscriviti</a>
          </li>
        </ul>
        <ul class="nav-item p-0 m-2">
          <?php if (isset($_SESSION['session_id'])) {
            ?>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../imgs/icons/user.png" height="22px" width="22px">
                </a>
                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-lg-end"
                  aria-labelledby="navbarDarkDropdownMenuLink">
                  <li>
                    <a class="dropdown-item" type="button" href="../views/home.php"> Il tuo profilo </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../views/logout.php"> Logout
                    </a>
                  </li>
                </ul>
            </ul>
            <?php
          } else {
            ?>
            <a class="nav-link m-2" href="../views/login.php">Login</a>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php
  //include la connessione al database
  $db = new PDO('sqlite:../db/databaseREN');
  $trovato = false;

  //azione da fare nel momento di submit del form
  if (isset($_GET["cerca"])) {
    $nome = $_GET['nome'];

    //query per la ricerca di nome nelle varie tabelle
    $query = "SELECT* FROM Concerti WHERE (Concerti.artista LIKE '%$nome%') OR (Concerti.luogo LIKE '%$nome%')";
    $record = $db->query($query);
    $query1 = "SELECT* FROM Teatro WHERE (Teatro.artista LIKE '%$nome%') OR (Teatro.luogo LIKE '%$nome%')";
    $record1 = $db->query($query1);
    $query2 = "SELECT* FROM Mostre WHERE (Mostre.artista LIKE '%$nome%') OR (Mostre.luogo LIKE '%$nome%')";
    $record2 = $db->query($query2);
    $query3 = "SELECT* FROM Eventi_Proposti WHERE (Eventi_Proposti.nome LIKE '%$nome%') OR (Eventi_Proposti.luogo LIKE '%$nome%')";
    $record3 = $db->query($query3);
    if ($record != false) {
      foreach ($record as $row) {
        $exp = explode(",", $row['immagine']);
        $trovato=true;
        ?>
      
        <div class="card1 mt-3 col-xxs-11">
          <a <?php echo "href='../views/concerto.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>>
            <img alt="" class="img1" src="<?php echo $exp[0]; ?>">
          </a>
          <div class="textBox">
            <div class="textContent">
              <a class="h1 h1-xxs" <?php echo "href='../views/concerto.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>><?php echo $row['artista']; ?></a>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\placeholder.png" width="25px" height="25px">
              </div>
              <div class="p p-xxs col-9 mx-auto my-auto">
                <?php echo $row['luogo']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\schedule.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p p-xxs col-9 mx-auto my-auto">
                <?php echo $row['data']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\clock.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p p-xxs col-9 mx-auto my-auto">
                <?php echo $row['orario']; ?>
              </div>
            </div>
          </div>
        </div>
        </div>
        <?php
      }
    }
    if ($record1 != false) {
      foreach ($record1 as $row) {
        $exp = explode(",", $row['immagine']);
        $trovato=true;
        ?>
        <div class="card1 mt-3 col-xxs-11">
          <a <?php echo "href='../views/evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>>
            <img alt="" class="img1" src="<?php echo $exp[0]; ?>">
          </a>
          <div class="textBox">
            <div class="textContent">
              <a class="h1" <?php echo "href='../views/evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>><?php echo $row['artista']; ?></a>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\placeholder.png" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['luogo']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\schedule.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['data']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\clock.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['orario']; ?>
              </div>
            </div>
          </div>
        </div>
        </div>
        <?php
      }
    }
    if ($record2 != false) {
      foreach ($record2 as $row) {
        $exp = explode(",", $row['immagine']);
        $trovato=true;
        ?>
        <div class="card1 mt-3 col-xxs-11">
          <a <?php echo "href='../views/evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>>
            <img alt="" class="img1" src="<?php echo $exp[0]; ?>">
          </a>
          <div class="textBox">
            <div class="textContent">
              <a class="h1" <?php echo "href='../views/evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>><?php echo $row['artista']; ?></a>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\placeholder.png" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['luogo']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\schedule.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['data']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\clock.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['orario']; ?>
              </div>
            </div>
          </div>
        </div>
        </div>
        <?php
      }
    }
    if ($record3 != false) {
      foreach ($record3 as $row) {
        $exp = explode(",", $row['locandina']);
        $trovato=true;
        ?>
        <div class="card1 mt-3 col-xxs-11">
          <img alt="" class="img1" src="<?php echo $exp[0]; ?>">
          <div class="textBox">
            <div class="textContent">
              <a class="h1">
                <?php echo $row['nome']; ?>
              </a>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\placeholder.png" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['luogo']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\schedule.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['data']; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-2 my-auto mx-auto">
                <img src="..\imgs\icons\clock.png" class="align-text-center" width="25px" height="25px">
              </div>
              <div class="p col-9 mx-auto my-auto">
                <?php echo $row['orario']; ?>
              </div>
            </div>
          </div>
        </div>
        </div>
        <?php
      }
    }
    if(!$trovato){
       echo "<h5 style='padding: 40px; font-family: Trebuchet MS; color:black'>Ci dispiace, nessun risultato è stato trovato</h5>";
  }
  }
   
  ?>
  <div class="space"></div>
</body>
<?php include '../views/footer.html'; ?>

</html>