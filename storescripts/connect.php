<?php

$user = 'root';
$pass = '';
$db = 'ecommerce';
$db = new mysqli('localhost', $user, $pass, $db) or die("non riesco a connettermi");

echo "Connessione riuscita!"
?>
