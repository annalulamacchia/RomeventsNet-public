<?php
session_start();

//include la connessione al database
include '../db/db_eventi_config.php';

//azione da fare nel momento di submit del form
if (isset($_POST["salva"])) {
  //immagine
  $file_name = $_FILES['img']['name'];
  $file_temp = $_FILES['img']['tmp_name'];
  $exp = explode(".", $file_name);
  $ext = end($exp);
  $ext_allowed = array("png", "gif", "jpeg", "jpg");
  $name = time() . "." . $ext;
  $location = "../imgs/locandine/" . $name;

  $email = $_POST['email'];
  $nome = $_POST['nome'];
  $tipo = $_POST['tipo_evento'];
  $orario = $_POST['orario'];
  $data = $_POST['data'];
  $luogo = $_POST['luogo'];
  $ig = $_POST['instagram'];

  //query per il salvataggio dei dati nella tabella utenti
  $query = "INSERT INTO Eventi_Proposti (nome, email, data, orario, locandina, luogo, tipo_evento, instagram) VALUES(:nome, :email, STRFTIME('%d/%m/%Y', :data), :orario, :locandina, :luogo, :tipo_evento, :instagram)";
  $stmt = $db->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':orario', $orario);
  $stmt->bindParam('luogo', $luogo);
  $stmt->bindParam(':data', $data);
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':instagram', $ig);
  $stmt->bindParam(':tipo_evento', $tipo);
  if (in_array($ext, $ext_allowed)) {
    if (move_uploaded_file($file_temp, $location)) {
      $stmt->bindParam(':locandina', $location);
    }
  } else if ($ext != "" && !in_array($ext, $ext_allowed)) {
    $_SESSION['error'] = "Formato dell'immagine non supportato";
    header('location:../views/form_compagno.php');
    exit();
  }

  $query3 = "SELECT COUNT(*) as conta FROM Eventi_Proposti WHERE Eventi_Proposti.email!='$email' AND lower(Eventi_Proposti.nome)=lower('$nome') and Eventi_Proposti.data=STRFTIME('%d/%m/%Y', '$data') AND lower(Eventi_Proposti.luogo)=lower('$luogo')";
  $res3 = $db->query($query3);
  $row3 = $res3->fetch();
  if ($row3['conta'] != 0) {
    $_SESSION['error'] = "Questo evento è già presente sul nostro sito";
    header('location:../views/form_invia_evento.php');
    exit();
  }

  //query per controllare se una determinata mail ha già proposto lo stesso evento
  $query1 = "SELECT COUNT(*) as conta FROM Eventi_Proposti WHERE Eventi_Proposti.email='$email' and lower(Eventi_Proposti.nome)=lower('$nome') and Eventi_Proposti.data=STRFTIME('%d/%m/%Y', '$data')";
  $res1 = $db->query($query1);
  $row1 = $res1->fetch();
  if ($row1['conta'] != 0) {
    //settare il parametro 'error' della session
    $_SESSION['error'] = "Hai già proposto questo evento";
    header('location:../views/form_invia_evento.php');
    exit();
  }

  //query per controllare se l'utente è iscritto al sito
  $query2 = "SELECT count(*) as conta FROM Utenti WHERE Utenti.email='$email'";
  $res2 = $db->query($query2);
  $row2 = $res2->fetch();
  if ($row2['conta'] == 0) {
    $_SESSION['error'] = "Non sei iscritto al sito, iscriviti";
    header('location:../views/form_invia_evento.php');
    exit();
  }



  //se l'iscrizione va a buon fine
  if ($row1['conta'] == 0 && $row2['conta'] != 0 && $stmt->execute()) {
    //settare il parametro 'success' della session
    $_SESSION['success'] = "Hai proposto con successo un evento.";
    header('location: ../views/form_invia_evento.php');
  }

  $news = new PDO('sqlite:../db/databaseREN');
  $sql = "SELECT distinct* FROM Newsletter WHERE email!='$email'";
  $record = $news->query($sql);
  $q = "SELECT data FROM Eventi_Proposti WHERE email='$email' AND nome='$nome' AND tipo_evento='$tipo' AND luogo='$luogo' AND orario='$orario' AND locandina='$location' AND instagram='$ig'";
  $r = $db->query($q);
  $ro = $r->fetch();
  $d = $ro['data'];

  require "..\PHPMailer\phpmailer\phpmailer\src\PHPMailer.php";
  require "..\PHPMailer\phpmailer\phpmailer\src\Exception.php";
  require "..\PHPMailer\phpmailer\phpmailer\src\SMTP.php";

  $PHPMailer = new PHPMailer\PHPMailer\PHPMailer();
  $Exception = new PHPMailer\PHPMailer\Exception();

  $mail = $PHPMailer;

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'romeventsnet@gmail.com';
  $mail->Password = 'vygddabmhccdscho';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->CharSet = "UTF-8";

  $mail->setFrom('romeventsnet@gmail.com', 'RomeventsNet');

  function sendEmail()
  {

    global $mail;
    global $nome;
    global $luogo;
    global $d;
    global $record;

    foreach ($record as $row) {
      $mail->addAddress($row['email']);
    }

    $mail->Subject = 'Nuovo evento';
    $mail->isHTML(true);
    $mail->Body = '
            <html>
            <head>
              <title>Nuovo evento</title>
            </head>
            <body>
            <img src="https://cdn-icons-png.flaticon.com/512/190/190488.png" style="display: block; margin-left: auto; margin-right: auto;" width="60px" height="60px">
            <h4 style="font-family: Trebuchet MS; color:black; text-align:center"> RomeventsNet </h4>
              <div style="font-family: Trebuchet MS; color:black">Ciao,</div>
              <div style="font-family: Trebuchet MS; color:black">RomeventsNet è lieto di notificarti la presenza di un nuovo evento nella sezione \'Eventi proposti da voi\' del nostro sito!</div>
              <br>
              <div style="font-family: Trebuchet MS; color:black">Nome evento: ' . $nome . '</div>
              <div style="font-family: Trebuchet MS; color:black">Luogo: ' . $luogo . '</div>
              <div style="font-family: Trebuchet MS; color:black">Data: ' . $d . '</div>
              <p style="font-family: Trebuchet MS; color:black">Per ulteriori informazioni consulta il nostro sito!</p>
              <h3 style="font-family: Trebuchet MS; color:black"> Il team di RomeventsNet ti augura buon divertimento!</h3>
            </body>
            </html>
            ';

    if (!$mail->send()) {
      echo 'Errore durante l\'invio dell\'email: ' . $mail->ErrorInfo;
    } else {
      echo 'Email inviata con successo.';
    }

  }


  // Invia l'email di iscrizione alla newsletter all'utente
  sendEmail();

}

?>