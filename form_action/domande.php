<?php
session_start();
$db = new PDO('sqlite:../db/databaseREN');
function funzione($login)
{
    $_SESSION['session_user'] = $login;
    global $db;
    $sql2 = "SELECT domanda FROM Utenti WHERE Utenti.email='$login' OR Utenti.username='$login'";
    $res2 = $db->query($sql2);
    $row2 = $res2->fetch();
    $risp = $row2['domanda'];
    return $risp;
}

if (isset($_POST["login"])) {
    $login = $_POST["login"];
    $risp = "";
    $sql1 = "SELECT COUNT(*) as conta FROM Utenti WHERE Utenti.email='$login' OR Utenti.username='$login'";
    $res1 = $db->query($sql1);
    $row1 = $res1->fetch();
    if ($row1['conta'] == 0) {
        $_SESSION['error_1'] = "Non sei iscritto al sito";
        $risposta = "";
    } else {
        $risposta = funzione($login);
    }

    // Restituisci i dati richiesti come risposta AJAX
    echo $risposta;
}
?>