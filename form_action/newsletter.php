<?php
session_start();

//pass per le app gmail vygddabmhccdscho
//pass mail Progettoltw23@
//include la connessione al database
include '../db/db_newsletter_config.php';

//azione da fare nel momento di submit del form
if (isset($_POST["salva"])) {
  if ($_POST['email'] != "") {
    $email = $_POST['email'];

    //query per il salvataggio dei dati nella tabella newsletter
    $query = "INSERT INTO Newsletter (email) VALUES(:email)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
  } else {
    header('location:../views/index.php');
  }

  //query per controllare se l'utente è iscritto alla newsletter
  $query1 = "SELECT count(*) as conta FROM Newsletter WHERE Newsletter.email='$email'";
  $res1 = $db->query($query1);
  $row1 = $res1->fetch();
  if ($row1['conta'] != 0) {
    header('location:../views/index.php');
    exit();
  }

  //se l'iscrizione va a buon fine
  if ($row1['conta'] == 0 && $stmt->execute()) {
    header('location: ../views/index.php');
  }

  $email = $_POST['email'];
  global $email;

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

  function sendEmail($email)
  {
    global $mail;
    $mail->addAddress($email);
    $mail->Subject = 'Iscrizione alla newsletter';
    $mail->isHTML(true);
    $mail->Body = '
    <html>
    <head>
      <title>Iscrizione alla newsletter</title>
    </head>
    <body>
    <img src="https://cdn-icons-png.flaticon.com/512/190/190488.png" style="display: block; margin-left: auto; margin-right: auto;" width="60px" height="60px">
    <h4 style="font-family: Trebuchet MS; color:black; text-align:center"> RomeventsNet </h4>
      <p style="font-family: Trebuchet MS; color:black">Grazie per esserti iscritto a RomeventsNet!</p>
      <p style="font-family: Trebuchet MS; color:black">Iscrivendoti alla nostra newsletter, hai scelto di essere notificato della presenza di nuovi eventi nella città eterna.</p>
      <p style="font-family: Trebuchet MS; color:black">Sei pronto a goderti concerti, mostre e spettacoli da solo, ma soprattutto in compagnia?</p>
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



  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ricevi l'indirizzo email inviato dal modulo
    global $email;

    // Invia l'email di iscrizione alla newsletter all'utente
    sendEmail($email);

    // Mostra un messaggio di successo all'utente
    echo "La mail stata inviata all'indirizzo email fornito.";
  } else {
    // Mostra un messaggio di errore all'utente se l'indirizzo email non esiste
    echo "L'indirizzo email fornito non esiste nel nostro sistema.";
  }
}


?>