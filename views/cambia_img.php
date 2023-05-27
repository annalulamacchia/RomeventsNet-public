<!DOCTYPE html>
<?php
session_start();
include '../db/db_utenti_config.php';
?>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\css\bootstrap.css" />
  <link rel="stylesheet" href="..\css\dashboard.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <link rel="stylesheet" href="..\css\foto.css">
  <script src="../js/previewFoto.js" type="application/javascript"></script>
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
  <form name="modifica_img" method="POST" action="../form_action/change_img.php" class="text-center"
    enctype="multipart/form-data">
    <div class="picture">
      <img src="<?php echo $row['image']; ?>" class="picture-src" name="imagePrev" id="imagePreview" title="">
      <input type="file" id="image" name="img" class="" onchange="return preview();">
    </div>
    <div class="row mx-auto my-auto">
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 col-xxs-3"></div>
      <div
        class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-xxs-1 d-inline-flex text-center ps-lg-4 ps-md-0 pe-md-2 ps-sm-0 pe-xs-6 pe-xxs-6">
        <div type="button" class="button3" onclick="return clearImage();">
          <img src="../imgs/icons/remove.png" height="45px" width="45px">
        </div>
      </div>
      <div
        class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-xxs-2 d-inline-flex text-center pe-lg-5 pe-md-5 pe-sm-2 ps-xs-0 ps-xxs-2">
        <button type="submit" name="salva" id="salva" class="border-0 bg-transparent button3">
          <img src="../imgs/icons/check.png" height="45px" width="45px">
        </button>
      </div>
    </div>
  </form>
</body>

</html>