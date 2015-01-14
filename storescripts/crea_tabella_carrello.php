<?php

require 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE carrello (
    prod_code int(4) NOT NULL,
    user_id int(32) NOT NULL,
    quantity int (16) NOT NULL,
    last_mod_date date NOT NULL,
    PRIMARY KEY (prod_code, user_id),
    FOREIGN KEY (prod_code) REFERENCES prodotto(prod_code),
    FOREIGN KEY(user_id) REFERENCES utente(id)
    )";

if (mysql_query($sqlCommand) or die (mysql_error())) 
{
    echo ("tabella CARRELLO creata correttamente");
}
else
{
    echo ("ERRORE FATALE, tabella CARRELLO non creata");
}

?>   

