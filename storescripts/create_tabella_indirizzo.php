<?php

require 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE IF NOT EXISTS indirizzo (
   
    cod int(8) auto_increment NOT NULL,
    id int(8) NOT NULL,
    via varchar(24) NOT NULL,
    numerociv varchar(24) NOT NULL,
    cap varchar(24) NOT NULL,
    citta varchar(24) NOT NULL,
    provincia varchar(24) NOT NULL,
    nazione varchar(24) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY id REFERENCES utente(id)
    ) ";

if (mysql_query($sqlCommand)) 
{
    echo ("tabella UTENTE creata correttamente"."<br>");
}
else
{
    echo ("ERRORE FATALE, tabella UTENTE non creata"."<br>");
}

?>   