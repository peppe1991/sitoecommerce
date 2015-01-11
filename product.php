<?php
include "./storescripts/force_error_reporting.php"
?>


<?php
/* Controlliamo innanzitutto che nel database esista un prodotto con il codice
 * contenuto nella variabile showid
 */
if (isset($_GET['showid'])) {
    // Richiedo la connessione al database  
    include "storescripts/connect_to_mysql.php";
    /* filtriamo la variabile passata dall'esterno e memorizziamo il risultato in
     * una nuova variabile
     */
    $id = preg_replace('#[^0-9]#i', '', $_GET['showid']);
    $sql = mysql_query("SELECT * FROM prodotto WHERE prod_code='$id' LIMIT 1") or die("Err:" . mysql_error());
    $productCount = mysql_num_rows($sql);
    if ($productCount > 0) {
        /* Lo abbiamo trovato, memorizziamo la riga del database in una
         * variabile 
         */
        while ($row = mysql_fetch_array($sql)) {
            /* Estraiamo i dati dalla riga e li memorizziamo separatamente in
             * delle variabili
             */
            $product_name = $row["prod_name"];
            $price = $row["price"];
            $description = $row["description"];
            //$category = $row["category"];
            //$subcategory = $row["subcategory"];
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
        /* Non abbiamo trovato un prodotto con quel codice nel database
         */
        echo "That item does not exist.";
        exit();
    }
} else {
    /* non è stata passata la variabile contenente il codice del prodotto
     */
    echo "Mancano delle informazioni per poter visualizzare questa pagina";
    exit();
}
mysql_close();
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $product_name; ?></title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
    <div align="center" id="mainWrapper">
        <?php include_once("template_header.php"); ?>
        <div id="pageContent">
            <table width="100%" border="0" cellspacing="0" cellpadding="15">
                <tr>
                    <td width="19%" valign="top"><img src="inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" /><br />
                        <a href="inventory_images/<?php echo $id; ?>.jpg">View Full Size Image</a></td>
                    <td width="81%" valign="top"><h3><?php echo $product_name; ?></h3>
                        <p><?php echo "$" . $price; ?><br />
                            <br />
                            <br />
                            <br />
                            <?php echo $description; ?>
                            <br />
                        </p>
                        <form id="form1" name="form1" method="post" action="cart.php">
                            <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
                            <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>
</html>