<?php  

/*
 * Script di connessione al database sql  
*/ 
//Variabili contenenti i dati d'accesso
$db_host = "localhost"; //Locazione del database
$db_username = "root";  //nome dell'utente 
$db_pass = "";  //password dell'utente 
$db_name = "sito"; //nome del database

// Procedo alla connessione con i dati sopra inseriti 
$db = new mysqli($db_host, $db_username, $db_pass, $db_name) or die(mysql_error());;//probabilmente credenziali sbagliate
mysql_select_db("$db_name") or die ("no database");//probabilmente tabella inesistente  
?>

