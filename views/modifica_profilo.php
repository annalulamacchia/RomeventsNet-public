<!DOCTYPE html>
<?php
session_start();
include '../db/db_utenti_config.php';
?>
<html lang="it">

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"
    href="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\css\bootstrap.css" />
  <link rel="stylesheet" href="..\css\dashboard.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <script src="../js/jquery-3.6.4.js"></script>
  <script src="..\js\sweetalert2.all.min.js"></script>
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
</head>

<body class="text-center">
  <?php
  $utente = $_SESSION['session_user'];
  $sql = "SELECT* FROM Utenti WHERE Utenti.username='$utente'";
  $res = $db->query($sql);
  $row = $res->fetch();
  ?>
  <form name="modifica_prof" method="POST" action="../form_action/change.php" class="form-signin g-2 mx-auto"
    enctype="multipart/form-data">
    <h3 class="mb-3 text-start">Modifica i tuoi dati</h3>
    <!--Immagine-->
    <div class="row">
      <div class="container">
        <div class="picture-container">
          <div class="picture">
            <img src="<?php echo $row['image']; ?>" class="picture-src" name="imagePrev" id="imagePreview" title="">
          </div>
        </div>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-lg-6">
        <!-- Campi -->
        <input type="text" name="nome" class="input" placeholder="Nome" value="<?php echo $row['nome']; ?>"> <br>
        <input type="text" placeholder="Cognome" class="input" name="cognome" value="<?php echo $row['cognome']; ?>">
        <br>
        <input type="text" placeholder="Username" class="input" name="username" value="<?php echo $row['username']; ?>">
        <br>
        <input type="email" placeholder="E-mail" name="email" class="input" value="<?php echo $row['email']; ?>">
      </div>
      <div class="col-lg-6">
        <input type="password" placeholder="Vecchia password" name="old_pass" class="input"> <br>
        <input type="password" placeholder="Password" name="password" class="input" id="pass"
          pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"> <br>
        <label class="pass" for="pass" style="font-size: 2;">Deve contenere almeno 8 caratteri, un numero, <br>
          una lettera maiuscola e un carattere speciale.
        </label><br>
        <input type="password" placeholder="Ripeti Password" name="password2" class="input"> <br>
        <select size="1" cols="1" name="domanda" class="input">
          <option value=""> Domanda per il recupero password</option>
          <option value="Qual è il nome del tuo primo animale domestico?">Qual è il nome del tuo primo animale
            domestico?</option>
          <option value="Qual è la tua città di nascita?">Qual è la tua città di nascita?</option>
          <option value="Qual è il tuo colore preferito?">Qual è il tuo colore preferito?</option>
          <option value="Qual era il nome della tua scuola elementare?">Qual era il nome della tua scuola elementare?
          </option>
          <option value="Qual è la marca della tua automobile?">Qual è la marca della tua automobile?</option>
        </select>
        <input type="text" placeholder="Risposta" name="risposta" class="input">
      </div>
    </div>
    <div class="row">
      <button type="submit" name="salva" id="salva" class="button1 mx-auto">Salva</button>
    </div>
  </form>
  <script>
    $(document).ready(function () {
      $("#canc").click(function () {
        $("#image").val("utente.png");
      });
    });
  </script>
</body>

</html>