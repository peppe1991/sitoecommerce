<?php
require 'storescripts/connect_to_mysql.php';
require 'user_verify_script.php';
?>

<?php
if ((isset($_GET["p"])) && (isset($_GET["m"]))) {
    $userid = $_GET["p"];
    $ship_code = $_GET["m"];
}
if ((isset($_GET["pay"]))) {
    $userid = $_GET["pay"];
    $ship_address =  $_POST['address'];
    $met_pag =  $_POST['met_pag'];
    
   
        
    header ("location: checkout.php?p=$userid&m=$met_spedizione");


    }
?>

<?php
$query = mysql_query("SELECT * FROM indirizzo WHERE user_id=$userid ORDER BY add_code") or die("Err:" . mysql_error());
$addCount = mysql_num_rows($query); 
if ($addCount > 0) { 
   $address_list = "";
    while ($row = mysql_fetch_array($query)) {
        $n = $row["add_code"];
        $via = $row["via"];
        $citta = $row["citta"];
        $cap = $row["CAP"];
        $regione = $row["regione"];
        $paese = $row["paese"];
        $civico = $row ["civico"];
        $appartamento = $row["appart"];
        $provincia = $row["provincia"];
        $address_list .= "<input type='radio' name='address' value='$n'> Indirizzo n.: $n -- via $via $civico $appartamento $citta $cap ($provincia) - Regione: $regione -Paese: $paese <br>";
    }
        
        
 }
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Checkout - NewEcommerce</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
    <div align="center" id="mainWrapper">
<?php include_once("./template_header.php"); ?>
        <div id="pageContent">
<?php
$query = mysql_query("SELECT * FROM carrello WHERE user_id = " . $userid);
?>
            <table id="carrello" width="600px">
                <tr>
                    <td></td>    <td id="titolo_cart"><b> Nome Prodotto</b></td> <td id="titolo_cart"> Prezzo Prodotto </td> <td id="titolo_cart"> Quantita'</td> <td id="titolo_cart">€</td>
                </tr> 
            <?php
            $tot = 0;
            while ($row = mysql_fetch_array($query)) {
                echo "<tr>";
                $query2 = mysql_query("SELECT * FROM prodotto WHERE prod_code = " . $row["prod_code"]) or die(mysql_error());
                $prod_quantity = $row["quantity"];
                $prod_cartnumber = $row["cart_element"];
                while ($row2 = mysql_fetch_array($query2)) {
                    $prod_name = $row2["prod_name"];
                    $prod_price = $row2["price"];
                    $query3 = mysql_query("SELECT * FROM metodospedizione WHERE ship_code = " . $ship_code) or die(mysql_error());
                    while ($row3 = mysql_fetch_array($query3)) {
                        $met_name = $row3["met_name"];
                        $met_price = $row3["met_price"];
                    }

                    $tot += $prod_quantity * $prod_price + $met_price;
                }
                $string = '<td><img src="inventory_images/' . $row["prod_code"] . '.jpg" ' . 'height=' . '"20px"></td><td id=' . '"carrello_td">' . $prod_name . "</td><td id=" . "carrello_td" . ">" . $prod_price . "€</td><td id=" . "carrello_td" . ">" . $prod_quantity . "</td><td id=" . "carrello_td" . ">" . $prod_price * $prod_quantity . "€</td>";
                echo $string;
                echo "</tr>";
            }
            ?>
                <tr>

                    <td></td>  <td></td> <td><?php echo $met_name; ?></td>  <td><?php echo " $met_price €" ?></td>

                    <td></td>  <td></td> <td></td> <td></td> <td>
                    </td>

                </tr> 
                <tr>

                    <td></td>  <td></td> <td></td>  <td id="totale" colspan="2" style="text-align: right;"><?php echo "Totale: $tot €" ?></td>

                    <td></td>  <td></td> <td></td> <td></td> <td>
                    </td>

                </tr> 

            </table>
            <p style="text-align: left; padding-left: 40px;"> <a href="cart.php" text-align="left">Modifica ordine</a></p>
            <br>
            <br>
            <table id="checkout"><h3>Seleziona l'indirizzo a cui spedire l'ordine:</h3>  <form action="checkout.php?pay=<?php echo $userid; ?>" enctype="multipart/form-data" name="myForm" id="myform" method="post" >
<?php echo $address_list; ?>
            </table>
            
            <p> ------------------ </p>
            
                <table id="checkout"><h3>Seleziona il metodo con cui desidere pagare:</h3>
<input type="radio" name="met_pag" value="creditcard" checked> Carta di Credito: <input name="creditcard" type="text" id="creditcard" size="40" />
<br>
<input type="radio" name="met_pag" value="bollettino">Bollettino postale (anticipato): C/C 8098800000.
<br>
<input type="radio" name="met_pag" value="bonifico">Bonifico Bancario (anticipato) C/C intestato a NewEcommerce IBAN IT80988000000000.
<br>
<input type="radio" name="met_pag" value="contrassegno">Contrassegno, pagamento alla consegna.

                                <input type="submit" name="button" id="button" value="Conferma dati" />

</form>
                <br>
                <br>
                <br>
            </table>
        </div>
<?php include_once("template_footer.php"); ?>
    </div>
</body>

<?php
if (!$BLABLABLA = 1) {
    /*
     * 
     */
    $query = mysql_query("INSERT INTO transazione (user_id, data, pay_code, ship_code)"
            . "VALUES ($userid, NOW(),1,$ship_code ") or die(mysql_error);
    $trans_id = mysql_insert_id();
    $query = mysql_query("SELECT * FROM CARRELLO WHERE user_id=$userid") or die(mysql_error());
    while
    ($row = mysql_fetch_array($query)) {
        $prod_code = $row["prod_code"];
        $quantity_bought = $row["quantity"];
        $query2 = mysql_query("SELECT * FROM prodotto WHERE prod_code = $prod_code") or die(mysql_error());
        $row2 = mysql_fetch_array($query2);
        $quantity_instock = row2["instock"];
        $quantity_instock -= $quantity_bought;
        $query2 = mysql_query("UPDATE prodotto SET instock=$quantity_instock WHERE prod_code=$prod_code");
        $query2 = mysql_query("INSERT INTO transactioncart (trans_id)"
                . "VALUES($trans_id)") or die(mysql_error());
        $query2 = mysql_query ("DELETE FROM carrello WHERE user_id = $userid");
    }
}
?>
