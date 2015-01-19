<div id="pageFooter"> 
    <?php
    if (isset($_SESSION["userid"]))
    {
        ?>Benvenuto <?php echo $_SESSION["username"]; ?> (Non sei tu? Clicca: <a href="logout.php"> Logout </a>)
    <?php
    }
    else
    { ?>
        <a href="login.php"> Login </a> | <a href="sign_up.php"> Registrazione </a> | <a href="storeadmin">Amministrazione</a></div>
  <?php }?>              