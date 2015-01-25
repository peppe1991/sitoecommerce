<?php
include "user_verify_script.php";
include "../storescripts/connect_to_mysql.php";
?>


<?php
// Questo blocco assicura che gli errori non vengano soppressi
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
/* Ottengo i dati inseriti nel form e li traduco in una istruzione mysql per
 * inserire un nuovo oggetto nel database.
 */
$query = mysql_query ("SELECT * FROM transazione");
if (isset ($_POST["userid"]))
{
    $userid = $_POST["userid"];
    $query = mysql_query ("SELECT * FROM $query WHERE user_id=$user_id") or die (mysql_error());
}
if (isset ($_POST["prod_low_limit"]))
{
    $prod_low_limit = $_POST["prod_low_limit"];
    $query2 = mysql_query("SELECT COUNT prod_code from ") or die (mysql_error());
}
if (isset ($_POST["ship_code"]))
{
    $ship_code = $_POST["ship_code"];
    $query = mysql_query("SELECT * FROM $query WHERE ship_code = $ship_code") or die (mysql_error());
}
if (isset ($_POST["pay_code"]))
{
    $pay_code = $_POST["pay_code"];
    $query = mysql_query ("SELECT * FROM $query WHERE pay_code = $pay_code") or die (mysql_error());
}
if (isset ($_POST["tot_low_limit"]))
{
    $tot_low_limit = $_POST["tot_low_limit"];
    $query = mysql_query("SELECT * FROM $query WHERE tot> $tot_low_limit") or die (mysql_error());
}
if (isset ($_POST["tot_high_limit"]))
{
    $tot_high_limit = $_POST["tot_high_limit"];
    $query = mysql_query("SELECT * FROM $query WHERE tot <= $tot_high_limit") or die (mysql_error());
}
if (isset ($_POST["date_low_limit"]))
{
    $date_low_limit = $_POST["date_low_limit"];
    $option = 1;
}
if (isset ($_POST["date_high_limit"]))
{
    $date_high_limit = $_POST["date_high_limit"];
    $option = 1;
}

if (isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['sel_category']) && isset($_POST['brand'])) /* se è stato cliccato il bottone per
 * inserire un nuovo prodotto
 */ {
    echo $_POST['sel_category'];
    /*
     * prendiamo i dati dalla variabile _POST prodotta dal form. la funzione 
     * mysql_real_escape_string filtra di volta in volta il dato che a noi interessa
     * memorizzare nella variabile. Tale funzione produce un errore se viene 
     * utilizzata mentre non si è connessi al database 
     */
    // $product_code = mysql_real_escape_string($_POST['code']);
    $product_name = mysql_real_escape_string($_POST['product_name']);
    $price = mysql_real_escape_string($_POST['price']);
    $inStock = mysql_real_escape_string($_POST['instock']);
    $category = $_POST['sel_category'];
    $brand = mysql_real_escape_string($_POST['brand']);
    $description = mysql_real_escape_string($_POST['description']);
    //Controlliamo se nel database esistano altri oggetti uguali
    /*  $query = mysql_query("SELECT * FROM prodotto WHERE prod_code='$product_code' LIMIT 1");
      $matching = mysql_num_rows($query); // numero righe corrispondenti
      if ($matching > 0) {
      echo 'ERRORE: si sta tentando di aggiungere un altro oggetto col codice "&product_code" nel sistema, <a href="inventory_list.php">clicca qui</a>';
      exit();
      } */
    // Se non abbiamo trovato un oggetto uguale ne aggiungiamo uno nuovo al DB
    $sql = mysql_query("INSERT INTO prodotto ( prod_name, instock, price, cat_code, brand, description, date_added) 
        VALUES ( '$product_name', '$inStock', '$price', '$category', '$brand', '$description', NOW())") or die(mysql_error());
    /* $sql = mysql_query("INSERT INTO prodotto (prod_code, prod_name, instock, price, category, brand, description, date_added) 
      VALUES('$product_code, $product_name',1,'$price',
      '$subcategory','$brand', '$description',now())") or die(mysql_error()); */
    $pid = mysql_insert_id();
    //Aggiungi l'immagine all'archivio immagine con il nome adequato
    $newname = $pid . '.jpg';
    $uploaded = move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/" . $newname);
    if (!$uploaded) {
        echo "ERRORE: non è riuscita la creazione dell'immagine";
    }
    /* Autorefresh per evitare che aggiornando la pagina dopo aver riempito il
     * form l'oggetto venga inserito due volte
     */
    header("location: inventory_list.php");
    exit();
}
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
$query = mysql_query("SELECT * FROM prodotto ORDER BY date_added DESC") or die("Err:" . mysql_error());
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
        $instock2 = $row["instock"];
        $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        $product_list .= "Product ID: $id - <strong>$product_name</strong> - $$price - Quantità disponibile: $instock2 -- <em>aggiunto il $date_added</em> "
                . "&nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>edita</a> &bull; "
                . "<a href='inventory_list.php?deleteid=$id'>cancella</a><br />";
    }
} else {
    $product_list = "Nessuna vendita che soddisfi i criteri di ricerca";
}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Storico vendite - NewEcommerce</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
    <div align="center" id="mainWrapper">
        <?php include_once("template_header.php"); ?>
        <div id="pageContent"><br />
            <!-- Aggiungo un pulsante che faccia subito raggiungere la parte
            della pagina che contiene il form per aggiungee un nuovo
            elemento al'inventario
            -->
            <div align="left" style="margin-left:24px;">
                <h2>Lista Vendite</h2>
                <?php
                /* stampo a schermo la lista dei prodotti nell'inventario
                 */
                echo $product_list;
                ?>
            </div>
            <hr />
            <h3>
                &darr; Ricerca fatture &darr;
            </h3>
            <!-- Creo un form appoggiato ad una tabella che permetta 
            l'aggiunta di un nuovo oggetto all'inventario in maniera
            semplice e comoda. Una volta inseriti i dati il sistema eseguirà
            il comando mysql per aggiungere l'oggetto nel daabase -->
            <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
                <table width="90%" border="0" cellspacing="0" cellpadding="6">

                    <tr>
                        <td width="20%" align="right">Per ID utente</td>
                        <td width="80%"><label>
                                <input name="userid" type="text" id="userid" size="64" />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">N. prodotti venduti > di</td>
                        <td><label>
                                <input name="prod_low_limit" type="text" id="prod_low_limit" size="12" />
                            </label></td>
                    </tr>
                    <tr>                      </tr>
                    <tr>
                        <td align="right">Spediti Tramite</td>
                        <td> <?php
                            $query = mysql_query("SELECT * FROM metodospedizione") or die("Err:" . mysql_error());
                            $metCount = mysql_num_rows($query); // conto il numero di oggetti trovati
                            if ($metCount > 0) { //se trovo almeno una categoria
                                /*
                                 * Costruisco la mia lista di prodotti (finchè ne trovo nell'inventario).
                                 * Creo delle variabili che conterranno i dati dei prodotti che vado 
                                 * leggendo nella lista, e le concateno nella variabile principale
                                 */
                                echo '<select name="ship_code" id="category">';
                                while ($row = mysql_fetch_array($query)) {
                                    $cat_code = $row["ship_code"];
                                    $name = $row["met_name"];
                                    echo '<option value="' . $cat_code . '">' . $name . '</option>';
                                }
                                echo "</select>";
                            } else {
                                echo "Nessun metodo di spedizione";
                            }
                            ?>
                    </tr>
                    <tr>
                        <td align="left">Pagati con</td>
                        <td> <?php
                            $query = mysql_query("SELECT * FROM metodopag") or die("Err:" . mysql_error());
                            $metCount = mysql_num_rows($query); // conto il numero di oggetti trovati
                            if ($metCount > 0) { //se trovo almeno una categoria
                                /*
                                 * Costruisco la mia lista di prodotti (finchè ne trovo nell'inventario).
                                 * Creo delle variabili che conterranno i dati dei prodotti che vado 
                                 * leggendo nella lista, e le concateno nella variabile principale
                                 */
                                echo '<select name="pay_code" id="category">';
                                while ($row = mysql_fetch_array($query)) {
                                    $cat_code = $row["met_code"];
                                    $name = $row["met_name"];
                                    echo '<option value="' . $cat_code . '">' . $name . '</option>';
                                }
                                echo "</select>";
                            } else {
                                echo "Nessun metodo di pagamento";
                            }
                            ?>


                        </td>
                    </tr>
                    <tr>
                        <td align="right">Totale > di € </td>
                        <td><label>
                                <input name="tot_low_limit" type="text" id="tot_low_limit" size="12" />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Totale <= di €</td>
                        <td><label>
                                <input name="tot_high_limit" type="text" id="tot_high_limit" size="12" />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Antecedenti al</td>
                        <td><label>
                                <input name="date_high_limit" type="text" id="date_high_limit" size="12" />
                            </label></td>
                    </tr><tr>
                        <td align="right">Posteriori al</td>
                        <td><label>
                                <input name="date_low_limit" type="text" id="date_low_limit" size="12" />
                            </label></td>
                    </tr>
                </table>
            </form>
            <br />
            <br />
        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>
</html>
