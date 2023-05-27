<?php
//apre il database del progetto databaseREN
$db = new PDO('sqlite:../db/databaseREN');

//crea la tabella compagni
$query = "CREATE TABLE IF NOT EXISTS Compagni (
        nome STRING NOT NULL,
        cognome STRING NOT NULL,
        email STRING NOT NULL,
        descrizione STRING,
        data_nascita STRING NOT NULL,
        image TEXT,
        evento STRING,
        data_evento STRING,
        instagram STRING,
        twitter STRING,
        PRIMARY KEY(email, evento, data_evento))";
$db->exec($query);
?>