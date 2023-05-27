<?php
session_start();
$db = new PDO('sqlite:../db/databaseREN');
?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\css\bootstrap.css" />
  <script src="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\js\bootstrap.bundle.js"
    type="application/javascript"></script>
  <link rel="stylesheet" href="..\css\index.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <script src="..\js\index.js"></script>
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
</head>

<body class="bg-light" data-bs-theme="light">
  <div class="container1">
    <!--Navbar superiore-->
    <?php include 'navbar.php'; ?>

    <!--Griglia-->
    <div class="container-fluid h-100 bg-black">
      <div class="row h-100 justify-content-center">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 g-0 hover1">
          <?php
          $sql = "SELECT* FROM Concerti WHERE Concerti.artista='Imagine Dragons - Rock In Roma'";
          $res = $db->query($sql);
          $row = $res->fetch();
          $exp = explode(",", $row['immagine']);
          ?>
          <a <?php echo "href='concerto.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>
            class="hover1">
            <img src="<?php echo $exp[1]; ?>" height="56.5%" width="99.5%">
          </a>
          <div class="row g-0">
            <div class="hover1">
              <?php
              $sql = "SELECT* FROM Teatro WHERE Teatro.artista='Pink Floyd Legend - Shine Pink Floyd Moon'";
              $res = $db->query($sql);
              $row = $res->fetch();
              ?>
              <a class="hover2" <?php echo "href='evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>>
                <img src="<?php echo $row['immagine']; ?>" width="48.75%" height="99.75%">
              </a>
              <?php
              $sql = "SELECT* FROM Mostre WHERE Mostre.artista='Ipotesi Metaverso'";
              $res = $db->query($sql);
              $row = $res->fetch();
              ?>
              <a <?php echo "href='evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>
                class="hover2">
                <img src="<?php echo $row['immagine']; ?>" width="48.75%" height="99.75%">
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 g-0 hover1">
          <?php
          $sql = "SELECT* FROM Concerti WHERE Concerti.artista='Arctic Monkeys - Rock in Roma'";
          $res = $db->query($sql);
          $row = $res->fetch();
          ?>
          <a class="hover5" <?php echo "href='concerto.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>>
            <img src="<?php echo $row['immagine']; ?>" width="99.25%" height="46.75%">
          </a>
          <?php
          $sql = "SELECT* FROM Mostre WHERE Mostre.artista='The World Of Bansky '";
          $res = $db->query($sql);
          $row = $res->fetch();
          $exp = explode(",", $row['immagine']);
          ?>
          <a class="hover4" <?php echo "href='evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>>
            <img src="<?php echo $exp[1]; ?>" height="52.75%" width="99%">
          </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 g-0 hover1">
          <?php
          $sql = "SELECT* FROM Teatro WHERE Teatro.artista='Andrea Bocelli'";
          $res = $db->query($sql);
          $row = $res->fetch();
          ?>
          <a <?php echo "href='evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>
            class="hover3">
            <img src="<?php echo $row['immagine']; ?>" height="49.65%" width="99.5%">
          </a>
          <?php
          $sql = "SELECT* FROM Teatro WHERE Teatro.artista='Peter Pan a Fantasy Musical Story'";
          $res = $db->query($sql);
          $row = $res->fetch();
          ?>
          <a <?php echo "href='evento.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>
            class="hover3">
            <img src="<?php echo $row['immagine']; ?>" height="49.75%" width="99.5%">
          </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 g-0 hover1">
          <div class="row g-0">
            <div class="hover1">
              <?php
              $sql = "SELECT* FROM Concerti WHERE Concerti.artista='Gazzelle'";
              $res = $db->query($sql);
              $row = $res->fetch();
              ?>
              <a <?php echo "href='concerto.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>
                class="hover2">
                <img src="<?php echo $row['immagine']; ?>" width="48.75%" height="99.75%">
              </a>
              <?php
              $sql = "SELECT* FROM Concerti WHERE Concerti.artista='Muse'";
              $res = $db->query($sql);
              $row = $res->fetch();
              ?>
              <a <?php echo "href='concerto.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>
                class="hover2">
                <img src="<?php echo $row['immagine']; ?>" width="48.75%" height="99.75%">
              </a>
            </div>
          </div>
          <?php
          $sql = "SELECT* FROM Concerti WHERE Concerti.artista='Guns N Roses'";
          $res = $db->query($sql);
          $row = $res->fetch();
          $exp = explode(",", $row['immagine']);
          ?>
          <a <?php echo "href='concerto.php?artista=" . $row['artista'] . "&data=" . $row['data'] . "'"; ?>
            class="hover1">
            <img src="<?php echo $exp[1]; ?>" width="99.5%" height="56.5%">
          </a>
        </div>
      </div>
    </div>

    <!--Navbar inferiore-->
    <nav class="navbar navbar-expand col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12">
      <div class="container-fluid">
        <div class="nav-item col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-3">
          <a class="nav-link m-2" type="button" href="concerti.php"> Concerti </a>
        </div>
        <div class="nav-item col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-3">
          <a class="nav-link m-2" type="button" href="mostre.php"> Mostre </a>
        </div>
        <div class="nav-item col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-3">
          <a class="nav-link m-2" type="button" href="teatri.php"> Spettacoli Teatrali</a>
        </div>
        <div class="nav-item col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-3">
          <a class="nav-link m-2" type="button" href="eventi_proposti.php"> Eventi proposti da voi </a>
        </div>
      </div>
    </nav>
  </div>
  <div class="blank"></div>
  <div class="container1 second">
    <!--Form compagno-->
    <div class="container-fluid d-lg-inline-flex d-md-inline-block">
      <div class="card card-5 card-lg card-md card-sm card-xs card-xxs">
        <div class="text">I tuoi amici non condividono le tue stesse passioni? 
          Non sai con chi andare a concerti, spettacoli teatrali e mostre dei tuoi artisti preferiti?
          Ti diamo la possibilià di conoscere nuove persone con cui andarci. <br>
          Basta inserire dati personali veritieri, un profilo social e una breve descrizione. Il resto lo farà la magia dell'arte.
        </div>
        <p class="card__apply">
          <a class="card__link" href="form_compagno.php">Iscriviti adesso<i class="fas fa-arrow-right"></i></a>
        </p>
      </div>

      <!--Form invia evento-->
      <div class="card card-5 card-lg card-md card-sm card-xs card-xxs">
        <div class="text">Vuoi suggerire agli spettatori, romani e non, nuovi eventi che non tutti conoscono in modo da ampliare il tuo pubblico? <br>
          Adesso puoi farlo! <br>
          Fornendo pochissime informazioni, potrai far conoscere le tue serate a tutta Roma, notificare la presenza di una sagra e molto altro.
        </div>
        <p class="card__apply">
          <a class="card__link" href="form_invia_evento.php">Suggerisci un evento<i class="fas fa-arrow-right"></i></a>
        </p>
      </div>

      <!--Newsletter-->
      <div class="card card-5 card-lg card-md card-sm card-xs card-xxs">
        <div class="text">Iscriviti alla nostra newsletter per rimanere sempre aggiornato sui nuovi eventi presenti
          nella città eterna!</div>
        <form name="news" method="POST" action="../form_action/newsletter.php" enctype="multipart/form-data">
          <input placeholder="Inserisci la tua mail"
            class="newsletter newsletter-lg newsletter-md newsletter-sm newsletter-xs newsletter-xxs" name="email"
            type="email" id="news">
          <button class=" card__link border-0" name="salva" type="submit" id="butt" onmouseover="newsl();">Iscriviti!
          <i class="fas fa-arrow-right"></i></button>
        </form>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
      </svg>
      <?php
      //controlla se session 'error' è settato se username o email sono già nel database
      if (isset($_SESSION['error'])) {
        ?>
        <!--Mostra l'errore -->
        <div class="text-center mx-auto my-auto pt-4">
          <div class="alert alert-danger d-inline-flex alert-dismissible fade show align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
              <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
              <?php
              echo $_SESSION['error'];
              ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
        <?php
        //Unsetting 'error' session dopo aver mostrato l'errore 
        unset($_SESSION['error']);
      }
      ?>
    </div>
  </div>
</body>
<?php include "footer.html"; ?>

</html>