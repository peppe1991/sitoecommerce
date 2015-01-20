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
                <a href="inventory_list.php"> Modifica Inventario </a>
            </div>
            <!--metterci altra roba giusto per dargli un senso-->
            <?php include_once("template_footer.php"); ?>
        </div>
    </body>
</html>