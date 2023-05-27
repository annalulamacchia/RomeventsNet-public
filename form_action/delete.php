<?php
session_start();
include '../db/db_utenti_config.php';

if (isset($_POST['elimina'])) {
    $utente = $_SESSION['session_user'];
    $query="SELECT distinct email FROM Utenti WHERE Utenti.username='$utente'";
    $record=$db->query($query);
    $row=$record->fetch();
    $sql = "DELETE FROM Utenti WHERE Utenti.username=:utente";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':utente', $utente);
    $sql1 = "DELETE FROM Compagni WHERE Compagni.email=:utente";
    $stmt1 = $db->prepare($sql1);
    $stmt1->bindParam(':utente', $row['email']);
    $sql2 = "DELETE FROM Eventi_Proposti WHERE Eventi_Proposti.email=:utente";
    $stmt2 = $db->prepare($sql2);
    $stmt2->bindParam(':utente', $row['email']);
    if ($stmt->execute() && $stmt1->execute() && $stmt2->execute()) {
        $_SESSION['success'] = "Account eliminato con successo";
        unset($_SESSION['session_id']);
        unset($_SESSION['session_user']);
        session_destroy();
        header('location:../views/index.php');
    } else {
        $_SESSION['error'] = "Non è stato possibile eliminare l'account";
        header('location:../views/home.php');
        exit();
    }
} else if (isset($_POST['indietro'])) {
    header('location:../views/home.php');
    exit();
}
?>