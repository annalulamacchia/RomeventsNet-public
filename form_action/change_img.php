<?php
session_start();
include '../db/db_utenti_config.php';

if (isset($_POST['salva'])) {
    //Set variabili
    $utente = $_SESSION['session_user'];
    $file_name = $_FILES['img']['name'];
    $file_temp = $_FILES['img']['tmp_name'];
    $exp = explode(".", $file_name);
    $ext = end($exp);
    $ext_allowed = array("png", "gif", "jpeg", "jpg");
    $name = time() . "." . $ext;
    $location = "../imgs/iscrizioni/" . $name;
    $query = "UPDATE Utenti SET image=:image WHERE username='$utente'";
    $stmt = $db->prepare($query);
    if (in_array($ext, $ext_allowed)) {
        if (move_uploaded_file($file_temp, $location)) {
            $stmt->bindParam(':image', $location);
        }
    } else if ($ext != "" && !in_array($ext, $ext_allowed)) {
        $_SESSION['error'] = "Formato dell'immagine non supportato";
        header('location:../views/home.php');
        exit();
    }
    if ($stmt->execute()) {
        //settare il parametro 'success' della session
        $_SESSION['success'] = "Immagine modificata con successo";
        header('location:../views/home.php');
    } else {
        $_SESSION['error'] = "Non è stato possibile modificare l'immagine profilo";
        header('location:../views/home.php');
    }
}
?>