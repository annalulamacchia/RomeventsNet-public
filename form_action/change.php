<?php
session_start();

//include la connessione al database
$db = new PDO('sqlite:../db/databaseREN');

//azione da fare nel momento di submit del form
if (isset($_POST['salva'])) {

    //Set variabili
    $utente = $_SESSION['session_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $domanda = $_POST['domanda'];
    $risposta = $_POST['risposta'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $old_pass = $_POST['old_pass'];

    //query per il salvataggio dei dati nella tabella utenti
    $int1 = "SELECT* FROM Utenti WHERE Utenti.username='$utente'";
    $r1 = $db->query($int1);
    $ro1 = $r1->fetch();
    $e = $ro1['email'];

    $query = "UPDATE Utenti SET nome=:nome, cognome=:cognome, username=:username, email=:email, password=:password, image=:image, domanda=:domanda, risposta=:risposta WHERE username='$utente'";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':image', $ro1['image']);

    if ($old_pass == "" && ($password != "" || $password2 != "")) {
        $_SESSION['error'] = "Inserire la vecchia password";
        header('location:../views/home.php');
        exit();
    }

    if ($password != "" && $old_pass != "" && $password2 != "") {
        if (!password_verify($old_pass, $ro1['password'])) {
            $_SESSION['error'] = "Vecchia password errata";
            header('location:../views/home.php');
            exit();
        } else {
            if ($password == $password2 && $password != $old_pass) {
                $stmt->bindParam(':password', $password_hash);
            } else if ($password == $password2 && $password == $old_pass) {
                $_SESSION['error'] = "La nuova password non può uguale a quella vecchia";
                header('location:../views/home.php');
                exit();
            }
        }
        if ($password != $password2) {
            $_SESSION['error'] = "Le password non corrispondono";
            header('location:../views/home.php');
            exit();
        }
    } else if ($password == "" && $old_pass != "" && $password2 == "") {
        $_SESSION['error'] = "La nuova password non può essere vuota. Riprova!";
        header('location:../views/home.php');
        exit();
    } else if ($password == "" && $old_pass == "" && $password2 == "") {
        $stmt->bindParam(':password', $ro1['password']);
    } else if ($old_pass != "" && ($password == "" || $password2 == "")) {
        $_SESSION['error'] = "Le password non corrispondono";
        header('location:../views/home.php');
        exit();
    }


    //query per controllare se un utente con un determinato username è già presente nel database
    $query2 = "SELECT COUNT(*) as conta FROM Utenti WHERE Utenti.username='$username' AND '$username'!='$utente'";
    $res2 = $db->query($query2);
    $row2 = $res2->fetch();
    if ($row2['conta'] != 0) {
        //settare il parametro 'error' della session
        $_SESSION['error'] = "Nome utente già in uso";
        header('location:../views/home.php');
        exit();
    } else {
        $stmt->bindParam(':username', $username);
    }

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cognome', $cognome);
    $query_comp = "UPDATE Compagni SET nome='$nome', cognome='$cognome' WHERE email='$e'";
    $db->query($query_comp);

    //query per controllare se un utente con una determinata mail è già presente nel database
    $query1 = "SELECT COUNT(*) as conta FROM Utenti WHERE Utenti.email='$email' AND'$email'!='$e'";
    $res1 = $db->query($query1);
    $row1 = $res1->fetch();
    if ($row1['conta'] != 0) {
        //settare il parametro 'error' della session
        $_SESSION['error'] = "E-mail già in uso";
        header('location:../views/home.php');
        exit();
    } else {
        $stmt->bindParam(':email', $email);
        $query_comp1 = "UPDATE Compagni SET email='$email' WHERE email='$e'";
        $db->query($query_comp1);
        $query_ev = "UPDATE Eventi_Proposti SET email='$email' WHERE email='$e'";
        $db->query($query_ev);
    }

    if ($domanda != "") {
        $stmt->bindParam(':domanda', $domanda);
    } else {
        $stmt->bindParam(':domanda', $ro1['domanda']);
    }
    if ($risposta != "") {
        $stmt->bindParam(':risposta', $risposta);
    } else {
        $stmt->bindParam(':risposta', $ro1['risposta']);
    }

    //se l'iscrizione va a buon fine
    if ($row1['conta'] == 0 && $row2['conta'] == 0 && $stmt->execute()) {
        //settare il parametro 'success' della session
        $_SESSION['success'] = "Informazioni modificate con successo";
        $_SESSION['session_user'] = $username;
        header('location:../views/home.php');
    }
}
?>