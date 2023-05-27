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
  <h4 class="text-start">Eventi proposti da te</h4>
  <div class="card-container">
    <?php
    //connessione al database
    $db = new PDO('sqlite:../db/databaseREN');
    $utente = $_SESSION['session_user'];
    $sql = "SELECT*, Eventi_Proposti.nome as artista FROM Eventi_Proposti JOIN Utenti WHERE Utenti.username='$utente' AND Utenti.email=Eventi_Proposti.email";
    $resultset = $db->query($sql);
    foreach ($resultset as $record) {
      ?>
      <article class="card2 card-xs card-sm card-md card-lg">
        <img src="<?php echo $record['locandina']; ?>" class="w-100 h-100 g-0">
        <div class="card_content">
          <?php
          if ($record['instagram'] != "") {
            ?>
            <a class="temporary_text2" target="_blank" href="https://www.instagram.com/<?php echo $record['instagram'];
            echo "/"; ?>">
              <img src="..\imgs\icons\instagram.png" height="22px" width="22px">
            </a>
            <?php
          }
          ?> <br>
          <span class="card_title">
            <?php echo $record['artista']; ?>
          </span>
          <span class="card_subtitle"></span>
          <p class="card_description">
            <?php echo "Luogo: ";
            echo $record['luogo']; ?> <br>
            <?php echo "Data: ";
            echo $record['data']; ?> <br>
            <?php echo "Orario: ";
            echo $record['orario']; ?>
          </p>
        </div>
      </article>
    <?php } ?>
  </div>
</body>

</html>