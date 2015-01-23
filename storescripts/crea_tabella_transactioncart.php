<?php

require_once 'connect_to_mysql.php';

$sqlCommand = "CREATE TABLE IF NOT EXISTS transactioncart (
   trans_id int(32),
   prod_code int (8),
   item_n int (4),
   PRIMARY KEY (trans_id, item_n),
   FOREIGN KEY (trans_id) REFERENCES transazione (id),
   FOREIGN KEY (prod_code) REFERENCES prodotto (prod_code)  
    )";

if (mysql_query($sqlCommand)) 
{
    echo ("tabella TRANSACTIONCART creata correttamente"."<br>");
}
else
{
    echo ("ERRORE FATALE, tabella TRANSACTIONCART non creata"."<br>");
}
