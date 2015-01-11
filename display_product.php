<?php
require ("./storescripts/connect_to_mysql.php");
$query = mysql_query('SELECT * FROM prodotto WHERE prod_code = ' . $_GET["p"]);
session_start();
?>

<?php
if (isset($_POST["amount"]) && isset($_POST["ship_method"]) )
{
    /*$query = mysql_query('INSERT INTO carrello (prod_code,user_id, quantity)
        VALUES ()');*/
}
else
{
    
}
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Più informazioni su di noi</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
    <div align="center" id="mainWrapper">
        <?php include_once("./template_header.php"); ?>
        <div id="pageContent">
            <?php
            while ($row = mysql_fetch_array($query)) {
                ?>  
                <?php echo $row["prod_name"];
                
            echo '<img src="./inventory_images/' . $_GET["p"]. '.jpg ">' ;
            echo 'Prezzo: ' . $row["price"] . '€\n';
            echo $row["description"] . '\n';
            echo 'Disponibili: ' . $row["instock"] . ' pz\n';
           
            }
            ?>
            <form action="inventory_edit.php?pid=<?php echo $targetID; ?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
                    <table width="90%" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                            <td width="20%" align="right">Quantità da acquistare</td>
                            <td width="80%"><label>
                                    <input name="amount" type="text" id="amount" size="64"  />
                                </label></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">Scegli un metodo di spedizione:</td>
                            <td><select name="ship_method" id="ship_method">
                                   
                                    <option value="1">Corriere TNT</option>
                                    <option value="2">Pacchetto assicurato</option>
                                    <option value="3">Spedizione urgente</option>
                                </select></td>
                        </tr>
 
                            <td>&nbsp;</td>
                            <td><label>
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
