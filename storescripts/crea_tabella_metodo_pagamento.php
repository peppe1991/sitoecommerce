<?php

require_once 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE IF NOT EXISTS metodopag (
    met_code_pag int(4) auto_increment NOT NULL,
    met_name varchar(20) NOT NULL,
    card_code int(16),
    PRIMARY KEY (met_code_pag),
    )";

if (mysql_query($sqlCommand)or die (mysql_error())) 
{
    echo ("tabella METODOPAG creata correttamente"."<br>");
}
else
{
    echo ("ERRORE FATALE, tabella METODOPAG non creata"."<br>");
}

?>   
