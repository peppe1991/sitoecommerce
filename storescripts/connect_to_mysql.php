<?php  

/*
 * Script di connessione al database sql  
*/ 
//Variabili contenenti i dati d'accesso
$db_host = "localhost"; //Locazione del database
$db_username = "builder";  //nome dell'utente 
$db_pass = "diciotto";  //password dell'utente 
$db_name = "siacommerce"; //nome del database

// Procedo alla connessione con i dati sopra inseriti 
 mysql_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql");//probabilmente credenziali sbagliate
mysql_select_db("$db_name") or die ("no database");//probabilmente ttabella inesistente        
/* mysql_connect() è una funzione deprecated, vedere file connect.php per un 
 * altro esempio di connessione usando sintassi a oggetti.
 */
?>

