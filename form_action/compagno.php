<?php
session_start();

//include la connessione al database
include '../db/db_compagni_config.php';

//azione da fare nel momento di submit del form
if (isset($_POST["salva"])) {
  //immagine
  $file_name = $_FILES['img']['name'];
  $file_temp = $_FILES['img']['tmp_name'];
  $exp = explode(".", $file_name);
  $ext = end($exp);
  $ext_allowed = array("png", "gif", "jpeg", "jpg");
  $name = time() . "." . $ext;
  $location = "../imgs/compagni/" . $name;

  $email = $_POST['email'];
  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $data_nascita = $_POST['data_nascita'];
  $des = $_POST['descrizione'];
  $ig = $_POST['instagram'];
  $tw = $_POST['twitter'];
  $evento_con_data = $_POST['evento'];
  $array_evento = explode('.', $evento_con_data);
  $evento = $array_evento[0];
  $data_evento = $array_evento[1];

  //query per il salvataggio dei dati nella tabella utenti
  $query = "INSERT INTO Compagni (nome, cognome, email, descrizione, data_nascita, image, evento, data_evento, instagram, twitter) VALUES(:nome, :cognome, :email, :descrizione, STRFTIME('%d/%m/%Y', :data_nascita), :image, :evento, :data_evento, :instagram, :twitter)";
  $stmt = $db->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':descrizione', $des);
  $stmt->bindParam(':data_nascita', $data_nascita);
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':cognome', $cognome);
  $stmt->bindParam(':instagram', $ig);
  $stmt->bindParam(':twitter', $tw);
  if (in_array($ext, $ext_allowed)) {
    if (move_uploaded_file($file_temp, $location)) {
      $stmt->bindParam(':image', $location);
    }
  } else if ($ext != "" && !in_array($ext, $ext_allowed)) {
    $_SESSION['error'] = "Formato dell'immagine non supportato";
    header('location:../views/form_compagno.php');
    exit();
  }
  $stmt->bindParam(':evento', $evento);
  $stmt->bindParam(':data_evento', $data_evento);

  //query per controllare se un compagno con una determinata mail è già presente nel database ed è iscritto a quello stesso evento
  $query1 = "SELECT* FROM Compagni WHERE Compagni.email='$email' and Compagni.evento='$evento' and Compagni.data_evento='$data_evento'";
  $res1 = $db->query($query1);
  $row1 = $res1->fetch();
  if ($row1 != null) {
    //settare il parametro 'error' della session
    $_SESSION['error'] = "Sei già iscritto a questo evento";
    header('location:../views/form_compagno.php');
    exit();
  }

  //query per controllare se l'utente è iscritto al sito
  $query2 = "SELECT COUNT(*) as conta FROM Utenti WHERE Utenti.email='$email'";
  $res2 = $db->query($query2);
  $row2 = $res2->fetch();
  if ($row2['conta'] == 0) {
    $_SESSION['error'] = "Non sei iscritto al sito, iscriviti";
    header('location:../views/form_compagno.php');
    exit();
  }

  if ($row2['conta'] != 0) {
    $query3 = "SELECT COUNT(*) as conta FROM Utenti WHERE Utenti.email='$email' AND lower(Utenti.nome)=lower('$nome') AND lower(Utenti.cognome)=lower('$cognome')";
    $res3 = $db->query($query3);
    $row3 = $res3->fetch();
    if ($row3['conta'] == 0) {
      $_SESSION['error'] = "Le informazioni inserite non corrispondono con la mail registrata";
      header('location:../views/form_compagno.php');
      exit();
    }

    $query4 = "SELECT COUNT(Compagni.email) as conta, email FROM Compagni WHERE Compagni.email='$email'";
    $res4 = $db->query($query4);
    $row4 = $res4->fetch();
    if ($row4['conta'] != 0) {
      $em = $row4['email'];
      $query5 = "SELECT distinct COUNT(*) as conta FROM Compagni WHERE Compagni.email='$em' and lower(Compagni.nome)=lower('$nome') and lower(Compagni.cognome)=lower('$cognome') AND Compagni.data_nascita=STRFTIME('%d/%m/%Y', '$data_nascita')";
      $res5 = $db->query($query5);
      $row5 = $res5->fetch();
      if ($row5['conta'] == 0) {
        //settare il parametro 'error' della session
        $_SESSION['error'] = "La data di nascita non è corretta";
        header('location:../views/form_compagno.php');
        exit();
      }
    }
  }

  //se l'iscrizione va a buon fine
  global $row3;
  if ($row1 == null && $row2['conta'] != 0 && $row3['conta'] != 0 && $stmt->execute()) {
    //settare il parametro 'success' della session
    $_SESSION['success'] = "Sei iscritto con successo a questo evento";
    header('location: ../views/form_compagno.php');
  }

  $sql = "SELECT distinct email FROM Compagni WHERE email!='$email' AND evento='$evento' AND ('$data_evento'='' OR data_evento='$data_evento')";
  $record = $db->query($sql);

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
    global $cognome;
    global $data_evento;
    global $evento;
    global $ig;
    global $record;

    foreach ($record as $row) {
      $mail->addAddress($row['email']);
    }

    $mail->Subject = 'Nuovo amico';
    $mail->isHTML(true);
    $mail->Body = '
            <html>
            <head>
              <title>Nuovo amico</title>
            </head>
            <body>
            <img src="https://cdn-icons-png.flaticon.com/512/190/190488.png" style="display: block; margin-left: auto; margin-right: auto;" width="60px" height="60px">
            <h4 style="font-family: Trebuchet MS; color:black; text-align:center"> RomeventsNet </h4>
              <div style="font-family: Trebuchet MS; color:black">Ciao,</div>
              <div style="font-family: Trebuchet MS; color:black">RomeventsNet è lieto di notificarti una nuova iscrizione per l\'evento \'' . $evento . '\' in data ' . $data_evento . '!</div>
              <br>
              <div style="font-family: Trebuchet MS; color:black">Nome: ' . $nome . '</div>
              <div style="font-family: Trebuchet MS; color:black">Cognome: ' . $cognome . '</div>
              <div style="font-family: Trebuchet MS; color:black">Instagram: ' . $ig . '</div>
              <p style="font-family: Trebuchet MS; color:black">Per ulteriori informazioni consulta la sezione \'Persone interessate ai tuoi stessi eventi\' nel tuo profilo!</p>
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