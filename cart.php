
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Il tuo carrello - NewEcommerce</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<?php
require './storescripts/connect_to_mysql.php';
session_start();
?>

<?php
if (isset($_GET["n"])) {
    $item_to_delete = $_GET["n"];
    $sql = mysql_query("DELETE FROM carrello WHERE cart_element='$item_to_delete' LIMIT 1") or die(mysql_error());
}
?>
<body>
    <div align="center" id="mainWrapper">
        <?php include_once("./template_header.php"); ?>
        <div id="pageContent">
            <?php
            $query = mysql_query("SELECT * FROM carrello WHERE user_id = " . $_SESSION["userid"]);
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
                        $tot += $prod_quantity * $prod_price;
                    }
                    $string = '<td><img src="inventory_images/'.$row["prod_code"].'.jpg" '.'height='.'"20px"></td><td id='.'"carrello_td">' . $prod_name . "</td><td id="."carrello_td".">" . $prod_price . "€</td><td id="."carrello_td".">" . $prod_quantity . "</td><td id="."carrello_td".">" . $prod_price * $prod_quantity . "€</td>";
                    echo $string.'<td> <a href="cart.php?n=' . $prod_cartnumber . ' ">cancella</a><br /> </td>';
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td></td>  <td></td> <td></td>  <td id="totale" colspan="2" style="text-align: right;"><?php echo "Totale: $tot €" ?></td>
                    <td></td>  <td></td> <td></td> <td></td> <td><input type="submit" name="pay" id="button" value="Completa l'ordine e paga ora" />
                    </td>
                </tr> 

            </table>


        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>

<?php
/* FUNZIONI QUANDO SI CLICCA PAGA ORA - DA SISTEMARE
  if (isset($_POST["pay"]){

  $sqlCommand = mysql_query("INSERT INTO transazione ( user_id, password, name, surname, cod_fisc, last_log_date)
  VALUES ('$username', '$password', '$name', '$surname', '$fiscode', NOW()) ") or die(mysql_error());
  } */
?>
