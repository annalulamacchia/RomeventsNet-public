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
  <link rel="stylesheet" href="..\css\event.css">
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <script src="..\js\event.js" type="application/javascript"></script>
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">

<body class="text-center">
  <!--Navbar superiore-->
  <?php include 'navbar.php'; ?>

  <!--Parte dinamica-->
  <?php
  //include connessione al databse
  $concerti = new PDO('sqlite:../db/databaseREN');

  //riga del database con artista e data del concerto cliccato
  $art = $_GET['artista'];
  $sql = "SELECT artista, data, * FROM Concerti WHERE artista LIKE '$art%' AND data='" . $_GET['data'] . "'";
  $query = $concerti->query($sql);
  $record = $query->fetch();
  $exp = explode(",", $record['immagine']);
  ?>
  <div
    class="card1 card1-xxs card1-xs card1-sm card1-md card1-lg mb-3 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12">
    <img alt="" class="img1 img1-xxs img1-xs img1-sm img1-md img1-lg" src="<?php echo $exp[0]; ?>">
    <div class="textBox text-center mt-sm-4">
      <div class="textContent">
        <div class="h1 h1-lg h1-md h1-sm h1-xs h1-xxs">
          <?php echo $record['artista']; ?>
        </div>
      </div>
      <div class="row marg marg-lg marg-md marg-sm marg-xs marg-xxs">
        <div class="col-lg-auto col-md-auto col-xs-2 col-sm-2  col-xxs-2 my-aut my-xs-auto">
          <img src="..\imgs\icons\placeholder.png" class="align-text-center logo-xxs logo-xs logo-sm logo-md logo-lg">
        </div>
        <div
          class="p p-xxs p-xs p-sm p-md p-lg col-lg-auto col-md-auto col-xxs-10 col-xs-10 col-sm-10 my-auto my-xs-auto">
          <?php echo $record['luogo']; ?>
        </div>
      </div>
      <div class="row marg marg-lg marg-md marg-sm marg-xs marg-xxs">
        <div class="col-lg-auto col-md-auto my-auto my-xs-auto col-xs-2 col-sm-2 col-xxs-2">
          <img src="..\imgs\icons\schedule.png" class="align-text-center logo-xs logo-sm logo-md logo-lg logo-xxs">
        </div>
        <div
          class="p p-xs p-xxs p-sm p-md p-lg col-lg-auto col-md-auto my-auto my-xs-auto col-xxs-10 col-xs-10 col-sm-10">
          <?php echo $record['data']; ?>
        </div>
      </div>
      <div class="row marg marg-lg marg-md marg-sm marg-xs marg-xxs mb-lg-3 mb-md-3 mb-sm-2 mb-xs-2">
        <div class="col-lg-auto col-md-auto my-auto my-xs-auto col-xs-2 col-sm-2 col-xxs-2">
          <img src="..\imgs\icons\clock.png" class="align-text-center logo-xs logo-sm logo-md logo-lg logo-xxs">
        </div>
        <div
          class="p p-xs p-xxs p-sm p-md p-lg col-lg-auto col-md-auto my-auto my-xs-auto col-xs-10 col-sm-10 col-xxs-10">
          <?php echo $record['orario']; ?>
        </div>
      </div>
      <div class="row align-text-center ms-1 ">
        <div
          class="button1 button1-lg button1-md button1-sm button1-xs button1-xxs col-lg-4 col-md-4 col-sm-4 col-xs-5 col-xxs-5 my-auto text-center">
          <a type="button" class="h2 h2-xs h2-sm h2-md h2-lg h2-xxs" href="<?php echo $record['biglietti']; ?>"
            target="_blank">TicketOne </a>
        </div>
        <?php
        if (isset($_SESSION['session_id'])) {
          ?>
          <div
            class="button1 button1-lg button1-md button1-sm button1-xs button1-xxs col-lg-6 col-md-6 col-sm-6 col-xs-auto col-xxs-auto my-auto ms-lg-4 ms-md-4 ms-sm-4 ms-xs-3 ms-xxs-3 text-start">
            <img src="../imgs/icons/friends.png"
              class="me-lg-1 me-md-1 me-sm-1 me-xs-0 me-xxs-0 logo-xs logo-sm logo-md logo-lg logo-xxs">
            <button type="button" class="h2 h2-xs h2-sm h2-md h2-lg h2-xxs border-0 bg-transparent" data-bs-toggle="modal"
              data-bs-target="#staticBackdrop">Amici </button>
          </div>
        <?php }
        ?>
      </div>
    </div>
  </div>
  </div>
  <!-- Modal -->
  <div class="modal fade modal1-lg modal1-md modal1-sm modal1-xs modal1-xxs" id="staticBackdrop"
    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Iscritti a questo evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
          $utente = $_SESSION['session_user'];
          $art = $_GET['artista'];
          $sql1 = "SELECT Utenti.email as e, COUNT(Utenti.email) as conta FROM Compagni INNER JOIN Utenti ON Utenti.email=Compagni.email WHERE Utenti.username='$utente' AND Compagni.evento ='$art' AND Compagni.data_evento='" . $_GET['data'] . "'";
          $resultset1 = $concerti->query($sql1);
          $row1 = $resultset1->fetch();
          if($row1['conta']==0) {
            echo "Non sei ancora iscritto a questo evento";
          }
          else {
          $sql2 = "SELECT * FROM Compagni WHERE  Compagni.email!='" . $row1['e'] . "' AND Compagni.evento ='" . $_GET['artista'] . "' AND Compagni.data_evento='" . $_GET['data'] . "'";
          $record2 = $concerti->query($sql2);
          $sql3 = "SELECT COUNT(*) AS conta FROM Compagni WHERE  Compagni.email!='" . $row1['e'] . "' AND Compagni.evento ='" . $_GET['artista'] . "' AND Compagni.data_evento='" . $_GET['data'] . "'";
          $record3 = $concerti->query($sql3);
          $row3 = $record3->fetch();
          if ($row3['conta'] == 0) {
            echo "Non ci sono ancora iscritti per questo evento";
          }
          foreach ($record2 as $row2) {
            ?>
            <div class="card4 mb-2">
              <?php if ($row2['image'] != NULL) {
                ?>
                <img src="<?php echo $row2['image']; ?>" class="img4">
                <?php
              } else {
                ?>
                <img class="img4">
              <?php } ?>
              <div class="textBox4">
                <div class="textContent4">
                  <p class="h1_4 h1_4-xxs h1_4-xs h1_4-sm h1_4-md h1_4-lg">
                    <?php echo $row2['nome'];
                    echo " ";
                    echo $row2['cognome']; ?>
                  </p>
                  <span class="span4">
                    <?php
                    if ($row2['instagram'] != "") {
                      ?>
                      <a href="https://www.instagram.com/<?php echo $row2['instagram'];
                      echo "/"; ?> " target="_blank">
                        <img src="..\imgs\icons\instagram.png" class="logo-xxs logo-xs logo-md logo-sm logo-lg">
                      </a>
                      <?php
                    }
                    if ($row2['twitter'] != "") {
                      ?>
                      <a href="https://twitter.com/<?php echo $row2['twitter']; ?>" target="_blank">
                        <img src="..\imgs\icons\twitter.png" class="logo-xxs" height="22px" width="22px">
                      </a>
                      <?php
                    }
                    ?>
                  </span>
                </div>
                <p class="p4 p4-xxs p4-xs p4-sm p4-md p4-lg">
                  <?php echo $row2['data_nascita']; ?>
                </p>
                <div>
                </div>
              </div>
            </div>
          <?php }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class=" row mx-auto mt-5">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-xxs-12">
      <h3> Trova un posto in cui stare </h3>
      <iframe src="<?php echo $record['mappa']; ?>" title="Trova un posto in cui stare" height="400px"
        width="90%"></iframe>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-xxs-12 mt-lg-0 mt-md-4 mt-sm-4 mt-xs-4">
      <h3> Trova un mezzo con cui arrivare </h3>
      <iframe src="https://www.comparabus.it/" title="Trova un mezzo per arrivarci" height="400px" width="90%"></iframe>
    </div>
  </div>
  <div class="row mx-auto mt-5 ms-lg-5 ms-md-5 ms-sm-5">
    <div class="col-lg-8 col-md-8 col-sm-11 col-xs-10 col-xxs-10 card2 me-lg-4 me-md-4 me-sm-0 ms-xs-5 mb-lg-3 mb-md-3">
      <?php
      $exp = explode("-", $record['artista']);
      $part1 = substr($record['biografia'], 0, 200);
      $part2 = substr($record['biografia'], 200, strlen($record['biografia']));
      ?>
      <div class="infos text-start">
        <p class="date-time"> Biografia di
          <?php echo $exp[0]; ?>
        </p>
        <p class="description">
          <?php echo $part1; ?>
          <span id="dots">...</span><span id="more">
            <?php echo $part2; ?>
          </span>
        </p>
        <div type="button" onclick="myFunction()" id="myBtn">Leggi di più</div>
      </div>
    </div>
    <div
      class="col-lg-3 col-md-3 col-sm-11 col-xs-10 col-xxs-10 card3 mb-lg-3 mb-md-3 mb-sm-3 mb-xs-3 ms-xs-5 mt-lg-0 mt-md-0 mt-sm-3 mt-xs-3">
      <div class="infos text-start">
        <p class="date-time"> Scopri di più </p>
        <p class="description">
          <?php
          if ($record['spotify'] != null) {
            ?>
            <a href="<?php echo $record['spotify']; ?>" class="pe-3" target="_blank">
              <img src="../imgs/icons/spotify.png" height="30px" width="30px">
            </a>
          <?php }
          if ($record['instagram'] != null) { ?>
            <a href="<?php echo $record['instagram']; ?>" target="_blank">
              <img src="../imgs/icons/instagram.png" height="30px" width="30px">
            </a>
          <?php } ?>
        </p>
      </div>
    </div>
  </div>
</body>
<?php include 'footer.html'; ?>

</html>