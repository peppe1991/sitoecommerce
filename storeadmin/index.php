<?php
include "user_verify_script.php"
?>

<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Pannello Amministratori</title>
        <link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
    </head>

    <body>
        <div align="center" id="mainWrapper">
            <?php include_once("template_header.php"); ?>
            <div id="pageContent">
                <p><h2>Benvenuto nel pannello di amministrazione dello store. </h2></p>
            <table id="menu" width="600px">
                <tr>
                    <td><b> <a href="inventory_list.php"> <img src="../style/elencoprodotti.jpg" height="100px"> <br> Aggiungi Prodotto </a>
                </b></td> <td> Modifica Categorie </td> <td> Visualizza Lista Prodotti</td> <td>Fatture</td>
                </tr> 
                </table></div>
            <!--metterci altra roba giusto per dargli un senso-->
            <?php include_once("template_footer.php"); ?>
        </div>
    </body>
</html>