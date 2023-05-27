<?php
//apre il database del progetto databaseREN
$db = new PDO('sqlite:../db/databaseREN');

//crea la tabella compagni
$query = "CREATE TABLE IF NOT EXISTS Eventi_Proposti (
        nome STRING NOT NULL,
        email STRING NOT NULL,
        data STRING NOT NULL,
        orario STRING NOT NULL,
        locandina TEXT NOT NULL,
        luogo STRING NOT NULL,
        tipo_evento STRING,
        instagram STRING,
        PRIMARY KEY(email, nome, data))";
$db->exec($query);
?>