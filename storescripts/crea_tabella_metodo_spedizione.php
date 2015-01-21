<?php

require_once 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE IF NOT EXISTS metodospedizione (
    met_code_sped int(4) auto_increment NOT NULL,
    met_name varchar(20) NOT NULL,
    met_price int(3) NOT NULL,
    PRIMARY KEY (met_code_sped),
    )";

if (mysql_query($sqlCommand) or die (mysql_error())) 
{
    echo ("tabella METODOSPEDIZIONE creata correttamente"."<br>");
}
else
{
    echo ("ERRORE FATALE, tabella METODOSPEDIZIONE non creata"."<br>");
}

?>   

