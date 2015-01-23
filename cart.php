
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
        <div id="pageContent"><?php
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
    $query2 = mysql_query("SELECT * FROM prodotto WHERE prod_code = " . $row["prod_code"]) or die(mysql_error());
    $prod_quantity = $row["quantity"];
    $prod_cartnumber = $row["cart_element"];
    while ($row2 = mysql_fetch_array($query2)) {
        $prod_name = $row2["prod_name"];
        $prod_price = $row2["price"];
        $tot += $prod_quantity * $prod_price;
    }
    $string = "<td>" . $prod_name . "</td><td>" . $prod_quantity . "</td><td>" . $prod_price . "</td><td>" . $prod_price * $prod_quantity . "</td>";
    echo '<td> <a href="cart.php?n=' . $prod_cartnumber . ' ">cancella</a><br /> </td>' . $string;
    echo "</tr>";
}
?>
                <tr>
                    <td></td> <td></td> <td></td> <td><?php echo "$tot" ?></td>
                    <td></td> <td></td> <td></td> <td><input type="submit" name="pay" id="button" value="Paga ora" />
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
