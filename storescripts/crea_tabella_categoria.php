<?php
require 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE categoria (
    cat_code int(8)  auto_increment NOT NULL,
    parent_code int(8),
    name varchar(24) NOT NULL,
    PRIMARY KEY (cat_code),
    FOREIGN KEY (parent_code) REFERENCES categoria (cat_code),
    UNIQUE KEY nome (name)
    )";
if (mysql_query($sqlCommand)) 
{
    echo ("tabella CATEGORIA creata correttamente");
}
else
{
    echo ("ERRORE FATALE, tabella CATEGORIA non creata");
}

?>