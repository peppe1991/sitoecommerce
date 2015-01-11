<?php
session_start();
include "./storescripts/connect_to_mysql.php";
?>
<?php
/* In questo blocco php c'è una procedura che permette di visualizzare l'intero
 * inventario sotto forma di lista
 */
/* per il momento inizializzo la variabile con una stringa vuota
 */
$product_list = "";
/* effettuo una query sulla tabella dei prodotti
 */
$query = mysql_query("SELECT * FROM prodotto ORDER BY date_added DESC LIMIT 6") or die("Err:" . mysql_error());
$productCount = mysql_num_rows($query); // conto il numero di oggetti trovati
if ($productCount > 0) { //se trovo almeno un oggetto nell'inventario
    /*
     * Costruisco la mia lista di prodotti (finchè ne trovo nell'inventario).
     * Creo delle variabili che conterranno i dati dei prodotti che vado 
     * leggendo nella lista, e le concateno nella variabile principale
     */
    while ($row = mysql_fetch_array($query)) {
        $id = $row["prod_code"];
        $product_name = $row["prod_name"];
        $price = $row["price"];
        $product_list .= "<a href='product.php?showid=$id'> <strong>$product_name</strong> </a> - $$price </br></br>";
    }
} else {
    $product_list = "Nessun prodotto nel nostro store per il momento";
}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIAcommerce</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
    <div align="center" id="mainWrapper">
        <?php include_once("./template_header.php"); ?>
        <div id="pageContent">
            <table width="100%" border="0 cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">&nbsp;</td>
                    <td valign="top">
                        <p>Ultime novità</p>
                        <p><?php
                            echo $product_list;
                            ?>
                        </p>
                    </td>
                    <td valign="top"></td>
                </tr>
            </table>

        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>
</html>