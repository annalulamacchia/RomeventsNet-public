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
  <link rel="stylesheet" href="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\css\bootstrap.css" />
  <link rel="stylesheet" href="..\css\signin.css">
  <link rel="stylesheet" href="..\css\foto.css">
  <link rel="stylesheet" href="..\css\sfondo.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\dashboard.css">
  <link rel="stylesheet" href="..\css\style.css">
  <link rel="stylesheet" href="..\css\form.css">
  <script src="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\js\bootstrap.bundle.js" type="application/javascript"></script>
  <script type="text/javascript" src="..\js\formcompagno.js"></script>
  <script type="text/javascript" src="..\js\previewFoto.js"></script>
  <script src="..\js\sweetalert2.all.min.js"></script>
  <script src="../js/jquery-3.6.4.js"></script>
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
</head>

<body class="text-center">
  <!--Navbar superiore-->
  <?php include 'navbar.php'; ?>

  <!--Form-->
  <div class="sfondo d-block">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
      </symbol>
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
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
    //controlla se session 'success' è settato quando un account è creato con successo
    if (isset($_SESSION['success'])) {
    ?>
      <!-- Mostra il messaggio -->
      <div class="text-center mx-auto my-auto pt-4">
        <div class="alert alert-success d-inline-flex align-items-center alert-dismissible fade show" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
            <?php
            echo $_SESSION['success'];
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php
      //Unsetting 'success' session dopo aver mostrato il messaggio
      unset($_SESSION['success']);
    }
    ?>
    <div class="container">
      <form name="compagno" method="POST" action="../form_action/compagno.php" class="form-signin2 g-2 mx-auto my-auto text-center" enctype="multipart/form-data" onsubmit="return cercacompagno();">

        <!--Immagine-->
        <div class="carta2 carta2-lg carta2-md" style="backdrop-filter: blur(50px); background:transparent">
          <div class="login">Trova un amico</div>
          <div class="row">
            <div class="picture-container">
              <div class="picture">
                <img src="" class="picture-src" name="imagePrev" id="imagePreview" title="">
                <input type="file" id="image" name="img" class="" onchange="return preview();">
              </div>
            </div>
            <div class="row">
              <div class="col-7"></div>
              <div class="col-3">
                <div type="button" class="button3" onclick="return clearImage();">
                  <img src="../imgs/icons/remove.png" height="40px" width="40px">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12">
              <div class="inputBox mx-auto">
                <input type="text" name="nome">
                <span>Nome*</span>
              </div>
              <div class="inputBox mx-auto">
                <input type="text" name="cognome">
                <span>Cognome*</span>
              </div>
              <div class="inputBox mx-auto">
                <input type="text" name="email">
                <span>E-mail*</span>
              </div>
              <div class="inputBox mx-auto">
                <input type="date" name="data_nascita">
                <span>Data di nascita*</span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12">
              <div class="inputBox mx-auto">
                <input type="text" name="descrizione" id="descr" maxlength="100">
                <span>Descrivti un po'</span>
                <span id="charCount"></span>
              </div>
              <div class="inputBox mx-auto">
                <input type="text" name="instagram">
                <span>Instagram</span>
              </div>
              <div class="inputBox mx-auto">
                <input type="text" name="twitter">
                <span>Twitter</span>
              </div>
              <div class="inputBox mx-auto">
                <?php
                $db = new PDO('sqlite:../db/databaseREN');
                ?>
                <select size="1" cols="1" name="evento">
                  <option class="selectBox" value="">Evento a cui iscriversi: *</option>
                  <optgroup label="Concerti">
                    <?php
                    $sql1 = "SELECT* FROM Concerti";
                    $resultset1 = $db->query($sql1);
                    foreach ($resultset1 as $record1) {
                    ?>
                      <option class="selectBox" value="<?php echo $record1['artista'];
                                                        echo ".";
                                                        echo $record1['data']; ?>"> <?php echo $record1['artista'];
                                                  echo " - ";
                                                  echo $record1['data']; ?></option>
                    <?php
                    } ?>
                  </optgroup>
                  <optgroup label="Spettacoli teatrali">
                    <?php
                    $sql2 = "SELECT* FROM Teatro";
                    $resultset2 = $db->query($sql2);
                    foreach ($resultset2 as $record2) {
                    ?>
                      <option class="selectBox" value="<?php echo $record2['artista'];;
                                                        echo ".";
                                                        echo $record2['data']; ?>"> <?php echo $record2['artista'];
                                                  echo " - ";
                                                  echo $record2['data']; ?></option>
                    <?php
                    } ?>
                  </optgroup>
                  <optgroup label="Mostre e Musei">
                    <?php
                    $sql3 = "SELECT* FROM Mostre";
                    $resultset3 = $db->query($sql3);
                    foreach ($resultset3 as $record3) {
                    ?>
                      <option class="selectBox" value="<?php echo $record3['artista']; ?>"> <?php echo $record3['artista']; ?></option>
                    <?php
                    } ?>
                  </optgroup>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="text-center">
              <div id="divRemember" class="checkbox mb-2">
                <input type="checkbox" name="remember" id="rmb" onclick="accetta();">
                <label for="rmb">Acconsento al trattamento dei dati personali</label>
              </div>
              <button class="enter" name="salva" id="salv" disabled>Invia</button>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
  </div>
</body>
<?php include 'footer.html'; ?>

</html>