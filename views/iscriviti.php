<!DOCTYPE html>
<?php
session_start();
?>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\css\bootstrap.css" />
  <script src="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\js\bootstrap.bundle.js"
    type="application/javascript"></script>
  <script type="text/javascript" src="..\js\previewFoto.js"></script>
  <link rel="stylesheet" href="..\css\dashboard.css">
  <link rel="stylesheet" href="..\css\foto.css">
  <link rel="stylesheet" href="..\css\sfondo.css">
  <link rel="stylesheet" href="..\css\signin.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <link rel="stylesheet" href="..\css\form.css">
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
  <script type="text/javascript" src="..\js\iscriviti.js"></script>
  <script src="..\js\sweetalert2.all.min.js"></script>
  <script src="../js/jquery-3.6.4.js"></script>
</head>

<body class="text-center">
  <!--Navbar superiore-->
  <?php include 'navbar.php'; ?>

  <div class="sfondo d-block">
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
    <!--Form-->
    <div class="container">
      <form name="iscrizione" method="POST" action="../form_action/signup.php" class="form-signin2 mx-auto my-auto"
        enctype="multipart/form-data" onsubmit=" return validai();">

        <!--Immagine-->
        <div class="carta2 carta2-lg carta2-md" style="backdrop-filter: blur(50px); background:transparent">
          <div class="login">Iscriviti</div>
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
                <input type="text" name="username">
                <span>Username*</span>
              </div>
              <div class="inputBox mx-auto">
                <input type="text" name="email">
                <span class="user">E-mail*</span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12">
              <div class="inputBox mx-auto">
                <input type="password" name="password">
                <span>Password*</span>
              </div>
              <div class="inputBox mx-auto">
                <input type="password" name="password2">
                <span>Ripeti Password*</span>
              </div>
              <div class="inputBox select mx-auto">
                <select name="domanda">
                  <option value="">Seleziona una domanda per il recupero password: *</option>
                  <option value="Qual è il nome del tuo primo animale domestico?">Qual è il nome del tuo primo animale
                    domestico?</option>
                  <option value="Qual è la tua città di nascita?">Qual è la tua città di nascita?</option>
                  <option value="Qual è il tuo colore preferito?">Qual è il tuo colore preferito?</option>
                  <option value="Qual era il nome della tua scuola elementare?">Qual era il nome della tua scuola
                    elementare?</option>
                  <option value="Qual è la marca della tua automobile?">Qual è la marca della tua automobile?</option>
                </select>
              </div>
              <div class="inputBox mx-auto">
                <input type="text" name="risposta">
                <span>Inserisci la risposta*</span>
              </div>
            </div>
          </div>
          <div class="text-center">
            <div id="divRemember" class="checkbox mb-2">
              <input type="checkbox" name="remember" id="rmba" onclick="accetta();">
              <label for="rmb">Acconsento al trattamento dei dati personali</label>
            </div>
            <button class="enter" name="salva" id="salv" disabled>Invia</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<?php include 'footer.html'; ?>

</html>