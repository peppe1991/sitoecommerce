<?php

require_once 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE IF NOT EXISTS METODOPAG (
    met_code int(4) NOT NULL auto_increment,
    met_name varchar(20) NOT NULL,
    card_code int(16) ,
    PRIMARY KEY (met_code),
    )";

if (mysql_query($sqlCommand)) 
{
    echo ("tabella METODOPAG creata correttamente"."<br>");
}
else
{
    echo ("ERRORE FATALE, tabella METODOPAG non creata"."<br>");
}

?>   
