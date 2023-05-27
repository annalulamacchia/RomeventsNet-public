<?php
session_start();
include '../db/db_utenti_config.php';

//azione da fare nel momento di submit del form
if (isset($_POST['reset'])) {
    // Setting variables
    $risposta = $_POST['risposta'];
    $login = $_SESSION['session_user'];
    $sql = "SELECT COUNT(*) as conta FROM Utenti WHERE (Utenti.username='$login' OR Utenti.email='$login') AND lower(Utenti.risposta)=lower('$risposta')";
    $record = $db->query($sql);
    $row = $record->fetch();
    if ($row['conta'] == 0) {
        $_SESSION['error'] = "La risposta non è corretta";
        header('location:../views/recupero_pass.php');
    } else {
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        //query per il salvataggio dei dati nella tabella utenti
        $query = "UPDATE Utenti SET password=:password WHERE email=:login OR username=:login";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password_hash);

        if ($stmt->execute()) {
            //settare il parametro 'success' della session
            $_SESSION['success'] = "Password cambiata con successo";
            header('location:../views/login.php');
            unset($_SESSION['session_user']);
        } else {
            $_SESSION['error'] = "Non è stato possibile cambiare la password. Riprova!";
            header('location:../views/recupero_pass.php');
            unset($_SESSION['session_user']);
        }
    }
}
?>