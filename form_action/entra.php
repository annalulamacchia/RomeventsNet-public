<?php
session_start();
//include la connessione al database
include '../db/db_utenti_config.php';

if (isset($_POST['salva'])) {
	//setta le variabili
	$login = $_POST['login'];
	$password = $_POST['password'];

	// query per vedere se username e password stanno nel database
	$query = "SELECT password, username, email, COUNT(*) as count FROM utenti WHERE utenti.email='$login' or utenti.username='$login'";
	$res = $db->query($query);
	$row = $res->fetch();

	//verifica che la password corrisponda
	$count = $row['count'];
	if ($count > 0 && password_verify($password, $row['password'])) {
		session_regenerate_id();
		$_SESSION['session_id'] = session_id();
		$_SESSION['session_user'] = $row['username'];
		header('location:../views/home.php');
		exit();
	} else {
		$_SESSION['error'] = "Username o password non validi";
		header('location:../views/login.php');
		exit();
	}
}
?>