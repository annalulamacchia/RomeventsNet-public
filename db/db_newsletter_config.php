<?php
//apre il database del progetto databaseREN
$db = new PDO('sqlite:../db/databaseREN');

//crea la tabella newsletter
$query = "CREATE TABLE IF NOT EXISTS Newsletter (
        email STRING NOT NULL PRIMARY KEY)";
$db->exec($query);
?>