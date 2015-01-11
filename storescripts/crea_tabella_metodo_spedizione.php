<?php

require 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE metodospedizione (
    met_code int(2) NOT NULL auto_increment,
    met_name varchar(20) NOT NULL,
    met_price int(3) NOT NULL,
    PRIMARY KEY (met_code),
    FOREIGN KEY(cat_code) REFERENCES categoria(cat_code)
    )";

if (mysql_query($sqlCommand)) 
{
    echo ("tabella METODOSPEDIZIONE creata correttamente");
}
else
{
    echo ("ERRORE FATALE, tabella METODOSPEDIZIONE non creata");
}

?>   

