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
  <link rel="stylesheet" href="..\css\dashboard.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
</head>

<body class="text-center">
  <h4 class="text-start">Persone interessate ai tuoi stessi eventi</h4>
  <!--Parte dinamica-->
  <?php
  //connessione al database
  $db = new PDO('sqlite:../db/databaseREN');
  $utente = $_SESSION['session_user'];
  $sql1 = "SELECT evento, data_evento, Utenti.email FROM Compagni JOIN Utenti WHERE Utenti.username='$utente' AND Utenti.email=Compagni.email";
  $resultset1 = $db->query($sql1);
  foreach ($resultset1 as $record1) {
    $email = $record1['email'];
    $evento = $record1['evento'];
    $data_evento = $record1['data_evento'];
    $sql = "SELECT* FROM Compagni WHERE Compagni.evento='$evento' AND Compagni.data_evento='$data_evento' AND Compagni.email!='$email'";
    $resultset = $db->query($sql);
    foreach ($resultset as $record) {
      ?>
      <article class="card2">
        <?php if ($record['image'] != NULL) {
          ?>
          <img src="<?php echo $record['image']; ?>" class="w-100 h-100 g-0">
        <?php } ?>
        <div class="card_content">
          <?php
          if ($record['instagram'] != "") {
            ?>
            <a class="temporary_text temporary_text-xs" target="_blank" href="https://www.instagram.com/<?php echo $record['instagram'];
            echo "/"; ?>">
              <img src="..\imgs\icons\instagram.png" height="22px" width="22px">
            </a>
            <?php
          }
          if ($record['twitter'] != "") {
            ?>
            <a class="temporary_text1" target="_blank" href="https://twitter.com/<?php echo $record['twitter']; ?>">
              <img src="..\imgs\icons\twitter.png" height="22px" width="22px">
            </a>
            <?php
          }
          ?> <br>
          <span class="card_title">
            <?php echo $record['nome'];
            echo " ";
            echo $record['cognome'];
            echo " - ";
            echo $record['data_nascita']; ?>
          </span>
          <span class="card_subtitle">
            <?php echo $record['evento'];
            echo " - ";
            echo $record['data_evento']; ?>
          </span>
          <p class="card_description">
            <?php echo $record['descrizione']; ?>
          </p>
        </div>
      </article>
    <?php }
  } ?>
</body>

</html>