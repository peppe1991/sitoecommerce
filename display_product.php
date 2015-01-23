<?php
require ("./storescripts/connect_to_mysql.php");
$targetID = $_GET["p"];
$query = mysql_query('SELECT * FROM prodotto WHERE prod_code = ' . $targetID);
$row = mysql_fetch_array($query);
$cat_code = $row["cat_code"];
$query2 = mysql_query('SELECT * FROM categoria WHERE cat_code = ' . $cat_code); ;
$row2 = mysql_fetch_array($query2);
session_start();
?>

<?php
if (isset($_POST["amount"]))
{
    if (isset($_SESSION["userid"]))
    {
    $quantity = $_POST["amount"];
    $userid = $_SESSION["userid"];
    $query = mysql_query("INSERT INTO carrello (prod_code, user_id, quantity)
        VALUES ('$targetID','$userid','$quantity' )") or die (mysql_error());
    }
    else
    {
        echo'ciao';
        header ("./login.php?c=2");
    }
}
else
{
    
}
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $row["prod_name"]  ?></title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />

</head>
<body>
    <div align="center" id="mainWrapper">
        <?php include_once("./template_header.php"); ?>
        <div id="pageContent">
            <table id="product_view" width="90%"> <tr><h3><?php echo $row["prod_name"];?></h3> </tr>
                <tr><td align="left">
                       <?php   echo '<img id="zoom" src="./inventory_images/' . $_GET["p"]. '.jpg " height="200px data-zoom-image="./inventory_images/' . $_GET["p"]. '.jpg ">' ; ?>
                        
                        <br>   <a href="inventory_images/<?php echo $targetID; ?>.jpg">Ingrandisci anteprima</a>
                    </td><td>
                        
        <?php
            echo 'Categoria: <b><a href="navigate_products.php?p='.$row2["cat_code"].'">'.$row2["name"].'</a></b><br>';        
            echo 'Prezzo: <b>' . $row["price"] . '€ </b><br>';
            echo $row["description"] . '<br>';
            echo 'Disponibili: <b>' . $row["instock"] . '</b> pz<br>';
           
            ?>
                    </td>
            <form action="display_product.php?p=<?php echo $targetID; ?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
                        <tr>
                            <td width="20%" align="right">Quantità da acquistare</td>
                            <td width="80%"><label>
                                    <input name="amount" type="text" id="amount" size="24"  />
                                </label></td>
                        </tr>
             <!--               <td width="20%" align="right">Scegli un metodo di spedizione:</td>
                            <td><select name="ship_method" id="ship_method">
                                   
                                    <option value="1">Corriere TNT</option>
                                    <option value="2">Pacchetto assicurato</option>
                                    <option value="3">Spedizione urgente</option>
                                </select></td>-->
 
                           
                            <td align="center"><label>
                                    <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
                                    <input type="submit" name="button" id="button" value="Aggiungi al carrello" />
                                </label></td>
                        </tr>
                    </table>
                </form>

        </div>
        <?php include_once("template_footer.php"); ?>
         
    </div>
</body>