<?php session_start() ?>
<?php
require ('./storescripts/connect_to_mysql.php');
?>
<?php
if (!isset($_GET["p"]))
    $query = mysql_query("SELECT * FROM categoria WHERE parent_code is NULL ");
else
    $query = mysql_query('SELECT * FROM categoria WHERE parent_code = ' . $_GET["p"]);
?>



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Naviga prodotti</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
    <div align="center" id="mainWrapper">
    
        <?php include_once("./template_header.php"); ?>
        <div id="pageContent">
            <table id="navigate_products">
            <?php
            while ($row = mysql_fetch_array($query)) {
                ?> <a href="navigate_products.php?p=<?php echo $row["cat_code"]; ?>"> <?php echo $row["name"]; ?> </a> 
                <?php
            }
            if (isset($_GET["p"])) {
                $query = mysql_query("SELECT * FROM prodotto WHERE cat_code = " . $_GET["p"]);
                while ($row = mysql_fetch_array($query)) {
                    ?>

                <a href="display_product.php?p=<?php echo $row["prod_code"]; ?>"> <?php echo $row["prod_name"]; ?> </a>
</tr>
                <?php
                }
            }
            ?>
</table>
        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>


