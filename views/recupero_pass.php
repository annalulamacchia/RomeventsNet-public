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
  <link rel="stylesheet" href="..\css\signin.css">
  <link rel="stylesheet" href="..\css\form.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <link rel="stylesheet" href="..\css\sfondo.css">
  <script src="../js/jquery-3.6.4.js"></script>
  <script type="text/javascript" src="..\js\recpass.js"></script>
  <script type="text/javascript" src="..\js\modal.js"></script>
  <script src="..\js\sweetalert2.all.min.js"></script>
  <script src="../js/jquery-3.6.4.js"></script>
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
</head>

<body class="text-center" style="min-height: 100vh">
  <?php include 'navbar.php'; ?>
  <div class="d-block justify-content-center align-items-center" style="max-height: 80vh">
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
        <?php
        //Unsetting 'success' session dopo aver mostrato il messaggio
        unset($_SESSION['success']);
    }
    ?>
      <!--Form-->
      <form name="form_recupero_pass" method="POST" class="form-signin2 g-2 mx-auto my-auto text-center"
        enctype="multipart/form-data">
        <div class="carta" style="background:transparent;">
          <a class="login">Inserisci email o username</a>
          <div class="inputBox">
            <input type="text" name="login" id="login">
            <span>E-mail o username</span>
          </div>
          <button type="button" class="enter" name="salva" data-bs-target="#staticBackdrop" data-bs-toggle="modal"
            onclick="popola();">Invia</button>
        </div>
      </form>
      <div class="modal fade modal1-lg modal1-md modal1-sm modal1-xs modal1-xxs" id="staticBackdrop"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">
              <div class="col-1"></div>
              <h5 class="modal-title col-10" id="staticBackdropLabel">Reset password</h5>
              <button type="button" class="btn-close col-1" data-bs-dismiss="modal" aria-label="Close"
                onclick="refresh();"></button>
            </div>
            <div class="inputbox w-100 mt-4 h5" id="login1"></div>
            <div class="modal-body d-flex justify-content-between align-items-center">
              <form name="form_reset_pass" method="POST" action="../form_action/reset_pass.php"
                class="form-signin row g-2 mx-auto" enctype="multipart/form-data" onsubmit="return recuperap();">
                <div class="d-flex flex-column justify-content-center align-items-center">
                  <div class="inputBox no">
                    <input type="text" name="risposta">
                    <span>Risposta</span>
                  </div>
                  <div class="inputBox no">
                    <input type="Password" name="password">
                    <span>Nuova password</span>
                  </div>
                  <div class="inputBox no">
                    <input type="password" name="pass_repeate" id="login">
                    <span>Ripeti la password</span>
                  </div>
                </div>
                <button type="submit" class="enter mt-3 m-auto no" name="reset">Invia</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
<?php include 'footer.html'; ?>

</html>