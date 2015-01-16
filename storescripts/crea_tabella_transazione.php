<?php

require_once 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE IF NOT EXISTS transazione (
    id int(4) NOT NULL auto_increment,
    user_id int(32) NOT NULL,
    data date NOT NULL,
    pag_code int(4) NOT NULL,
    sped_code int(4) NOT NULL,
    FOREIGN KEY (met_code_pagamento) REFERENCES metodopag(met_code),
    FOREIGN KEY(met_code_spedizione) REFERENCES metodospedizione(met_code)
    )";

if (mysql_query($sqlCommand) or die (mysql_error())) 
{
    echo ("tabella TRANSAZIONE creata correttamente"."<br>");
}
else
{
    echo ("ERRORE FATALE, tabella TRANSAZIONE non creata"."<br>");
}

?>   


