<?php
//apre il database del progetto databaseREN
$db = new PDO('sqlite:../db/databaseREN');

//crea la tabella utenti
$query = "CREATE TABLE IF NOT EXISTS Utenti (
        nome STRING NOT NULL,
        cognome STRING NOT NULL,
        username STRING PRIMARY KEY,
        email STRING NOT NULL UNIQUE,
        password STRING NOT NULL,
        image TEXT,
        domanda STRING NOT NULL,
        risposta STRING NOT NULL)";
$db->exec($query);
?>