


<div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
        <tr>
            <td width="32%"><a href="../index.php"><img src="../style/logo1.jpg" alt="Logo" width="252" height="36" border="0" /></a></td>
            <td width="68%" align="right"> 
                <?php
                if (isset($_SESSION["userid"])) {
                    ?><a href="../cart.php"><?php
                } else {
                    ?> <a href="../login.php?c=1"> <?php }
                ?>
                      <img src="../style/cart.png" alt="cart" width="50" height="50" border="0" />  Il tuo carrello</a>
            </td>

        </tr>
        <tr>
            <td colspan="2"><a href="../index.php">Home</a> &nbsp; &middot; &nbsp; <a href="../navigate_products.php">Naviga prodotti</a> &nbsp; &middot; &nbsp; <a href="../help.php">Help</a> &nbsp; &middot; &nbsp; <a href="../contacts.php">Contattaci</a></td>
        </tr>
    </table>
</div>




