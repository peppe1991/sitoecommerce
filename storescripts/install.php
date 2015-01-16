<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIAcommerce</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<div id="install">
<?php
require "connect_to_mysql.php";
require "crea_tabella_carrello.php";
require "crea_tabella_categoria.php";
require "crea_tabella_metodo_pagamento.php";
require "crea_tabella_metodo_spedizione.php";
require "crea_tabella_prodotto.php";
require "crea_tabella_utente.php";
require "crea_tabella_indirizzo.php";

echo "<br>"."Tutte le tabelle sono state create";
?> 
</div>