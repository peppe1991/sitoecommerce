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
            <h3>Apri una categoria o scegli un prodotto:</h3>
            <table id="navigateproducts">
                <tr> <?php
                $countrow = 0;
            while ($row = mysql_fetch_array($query)) {
                $countrow=$countrow+1;
                if($countrow<6){
                    ?> 
                 <td id="navigateproducts_td"> <a href="navigate_products.php?p=<?php echo $row["cat_code"]; ?>"><?php echo $row["name"]; ?> <br><img src="style/category.png"></a> 
                </td>
                <?php } else { 
                    $countrow=0; 
                echo "</tr><tr>";
                
                }
                  ?>  
                        <?php
            }
            if (isset($_GET["p"])) {
                $query = mysql_query("SELECT * FROM prodotto WHERE cat_code = " . $_GET["p"]);
                $count_prod=0;
                while ($row = mysql_fetch_array($query)) {
                   $count_prod=$count_prod+1;
                if($count_prod<6){
                     ?>

                <td id="navigateproducts_td">  <a href="display_product.php?p=<?php echo $row["prod_code"]; ?>"><?php echo $row["prod_name"]; ?> <?php echo "</a> - €" .$row["price"]; ?><br> <a href="display_product.php?p=<?php echo $row["prod_code"]; ?>"> <img src="inventory_images/<?php echo $row["prod_code"]; ?>.jpg">  </a>
                </td>

                   <?php } else { 
                    $countprod=0; 
                echo "</tr><tr>";
                
                }
                  ?>  
            
                <?php
                }
            }
            ?>
                            </tr>

</table>
        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>


