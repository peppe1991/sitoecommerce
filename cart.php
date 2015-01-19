
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Il tuo carrello</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
 

<body>
    <div align="center" id="mainWrapper">
        <?php include_once("./template_header.php"); ?>
        <div id="pageContent"><?php
        /*ciao, questo è un aggiornamento*/
            session_start();
            require './storescripts/connect_to_mysql.php';
            $query = mysql_query("SELECT * FROM carrello WHERE user_id = " . $_SESSION["userid"]);
            ?>
            <table id="carello" width="600px">
                <tr>
                    <td><b> Nome Prodotto</b></td> <td> Prezzo Prodotto </td> <td> Quantita'</td> <td>€</td>
                </tr> 
                <?php
                $tot = 0;
                while ($row = mysql_fetch_array($query)) {
                    echo "<tr>";
                    $query2 = mysql_query("SELECT * FROM prodotto WHERE prod_cod = " . $row["prod_code"]);
                    $prod_quantity = row["quantity"];
                    while ($row2 = mysql_fetch_array($query2)) {
                        $prod_name = row2["prod_name"];
                        $prod_price = row2["price"];
                        $tot += row["quantity"] * row2["price"];
                    }
                    echo "<td>" . $prod_name . "</td><td>" . $prod_quantity . "</td><td>" . $prod_price . "</td><td>" . $prod_price * $prod_quantity . "</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td></td> <td></td> <td></td> <td><?php echo "$tot" ?></td>
                     <td></td> <td></td> <td></td> <td>                    <img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;">
<?php echo "$tot" ?>
                   <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<table>
<tr><td><input type="hidden" name="on0" value="Prezzi">Prezzi</td></tr><tr><td><select name="os0">
	<option value="Opzione 1">Totale + corriere <?php echo"$tot" ?> + €10,00</option>
	<option value="Opzione 2">Totale + posta prioritaria <?php echo"$tot" ?> + €5,00</option>
	<option value="Opzione 3">Totale + ritiro in negozio <?php echo"$tot" ?> + €0,00</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - Il metodo rapido, affidabile e innovativo per pagare e farsi pagare.">
<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>


                     
                     
                     
                     
                     
                     
                     </td>
                </tr> 

            </table>


        </div>
<?php include_once("template_footer.php"); ?>
    </div>
</body>
