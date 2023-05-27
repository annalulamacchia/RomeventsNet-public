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

<body class="text-start">
  <h4 class="text-start">Eventi a cui sei iscritto</h4>
  <!--Parte dinamica-->
  <div class="card-container">
    <?php
    //connessione al database
    $db = new PDO('sqlite:../db/databaseREN');
    $utente = $_SESSION['session_user'];
    $sql = "SELECT* FROM Compagni JOIN Utenti WHERE Utenti.username='$utente' AND Utenti.email=Compagni.email";
    $resultset = $db->query($sql);
    foreach ($resultset as $record) {
      $nome = $record['evento'];
      $data = $record['data_evento'];
      $sql1 = "SELECT* FROM Concerti WHERE Concerti.artista='$nome' AND Concerti.data='$data'";
      $res = $db->query($sql1);
      foreach ($res as $row) {
        $exp = explode(",", $row['immagine']);
        ?>
        <article class="card2 card-xs card-sm card-md card-lg">
          <img src="<?php echo $exp[0]; ?>" class="w-100 h-100 g-0">
          <div class="card_content">
            <span class="card_title">
              <?php echo $record['evento']; ?>
            </span>
            <span class="card_subtitle"></span>
            <p class="card_description">
              <?php echo "Luogo: ";
              echo $row['luogo']; ?> <br>
              <?php echo "Data: ";
              echo $row['data']; ?> <br>
              <?php echo "Orario: ";
              echo $row['orario']; ?>
            </p>
          </div>
        </article>
      <?php }
      $sql2 = "SELECT* FROM Mostre WHERE Mostre.artista='$nome'";
      $res2 = $db->query($sql2);
      foreach ($res2 as $row2) {
        $exp1 = explode(",", $row2['immagine']);
        ?>
        <article class="card2 card-xs card-sm card-md card-lg">
          <img src="<?php echo $exp1[0]; ?>" class="w-100 h-100 g-0">
          <div class="card_content">
            <span class="card_title">
              <?php echo $record['evento']; ?>
            </span>
            <span class="card_subtitle"></span>
            <p class="card_description">
              <?php echo "Luogo: ";
              echo $row2['luogo']; ?> <br>
              <?php echo "Data: ";
              echo $row2['data']; ?> <br>
              <?php echo "Orario: ";
              echo $row2['orario']; ?>
            </p>
          </div>
        </article>
      <?php }
      $sql3 = "SELECT* FROM Teatro WHERE Teatro.artista='$nome' AND Teatro.data='$data'";
      $res3 = $db->query($sql3);
      foreach ($res3 as $row3) {
        ?>
        <article class="card2 card-xs card-sm card-md card-lg">
          <img src="<?php echo $row3['immagine']; ?>" class="w-100 h-100 g-0">
          <div class="card_content">
            <span class="card_title">
              <?php echo $record['evento']; ?>
            </span>
            <span class="card_subtitle"></span>
            <p class="card_description">
              <?php echo "Luogo: ";
              echo $row3['luogo']; ?> <br>
              <?php echo "Data: ";
              echo $row3['data']; ?> <br>
              <?php echo "Orario: ";
              echo $row3['orario']; ?>
            </p>
          </div>
        </article>
      <?php }
    } ?>
  </div>
</body>

</html>