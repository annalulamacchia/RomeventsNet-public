<?php
session_start();

//include la connessione al database
include '../db/db_utenti_config.php';

//azione da fare nel momento di submit del form
if (isset($_POST['salva'])) {
    //immagine
    $file_name = $_FILES['img']['name'];
    $file_temp = $_FILES['img']['tmp_name'];
    $exp = explode(".", $file_name);
    $ext = end($exp);
    $ext_allowed = array("png", "gif", "jpeg", "jpg");
    $name = time() . "." . $ext;
    $location = "../imgs/iscrizioni/" . $name;

    //Set variabili
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $domanda = $_POST['domanda'];
    $risposta = $_POST['risposta'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    //query per il salvataggio dei dati nella tabella utenti
    $query = "INSERT INTO Utenti (nome, cognome, username, email, password, image, domanda, risposta) VALUES(:nome, :cognome, :username, :email, :password, :image, :domanda, :risposta)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password_hash);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cognome', $cognome);
    $stmt->bindParam(':domanda', $domanda);
    $stmt->bindParam(':risposta', $risposta);
    if (in_array($ext, $ext_allowed)) {
        if (move_uploaded_file($file_temp, $location)) {
            $stmt->bindParam(':image', $location);
        }
    } else if ($ext != "" && !in_array($ext, $ext_allowed)) {
        $_SESSION['error'] = "Formato dell'immagine non supportato";
        header('location:../views/iscriviti.php');
        exit();
    }

    //query per controllare se un utente con una determinata mail è già presente nel database
    $query1 = "SELECT COUNT(*) as conta FROM Utenti WHERE Utenti.email='$email'";
    $res1 = $db->query($query1);
    $row1 = $res1->fetch();
    if ($row1['conta'] != 0) {
        //settare il parametro 'error' della session
        $_SESSION['error'] = "E-mail già in uso";
        header('location:../views/iscriviti.php');
        exit();
    }

    //query per controllare se un utente con un determinato username è già presente nel database
    $query2 = "SELECT COUNT(*) as conta FROM Utenti WHERE Utenti.username='$username'";
    $res2 = $db->query($query2);
    $row2 = $res2->fetch();
    if ($row2['conta'] != 0) {
        //settare il parametro 'error' della session
        $_SESSION['error'] = "Nome utente già in uso";
        header('location:../views/iscriviti.php');
        exit();
    }

    //se l'iscrizione va a buon fine
    if ($row1['conta'] == 0 && $row2['conta'] == 0 && $stmt->execute()) {
        //settare il parametro 'success' della session
        $_SESSION['success'] = "Account creato con successo";
        header('location:../views/iscriviti.php');
    }
}
?>