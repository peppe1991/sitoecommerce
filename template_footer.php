<div id="pageFooter"> 
    <?php
    if (isset($_SESSION["userid"]))
    {
        ?>Benvenuto <?php echo $_SESSION["username"]; ?> (Non sei tu? Clicca: <a href="http://localhost/siacommerce/logout.php"> Logout </a>)
    <?php
    }
    else
    { ?>
        <a href="http://localhost/siacommerce/login.php"> Login </a> | <a href="http://localhost/siacommerce/sign_up.php"> Registrazione </a> | <a href="http://localhost/siacommerce/storeadmin">Amministrazione</a></div>
  <?php }?>              