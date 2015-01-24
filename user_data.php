<?php
session_start();
include "./storescripts/connect_to_mysql.php";
           if (!isset($_SESSION["userid"]))
    {
        header("location: login.php"); 
    }
    else {
        $id= $_SESSION["userid"];
        
    }
   ?>
    <?php
$sql = mysql_query("SELECT * FROM utente WHERE id=$id LIMIT 1");
    $userCount = mysql_num_rows($sql);
    if ($userCount > 0) {
        while ($row = mysql_fetch_array($sql)) {
            $id = $row["id"];
            $username = $row["username"];
            $email = $row["email"];            
            $date = $row["last_log_date"];
                  
    }
    
        }
        else {
        echo"<h3>Utente non esistente</h3>";
    }
?>


<?php
/* Cominciamo ad elaborare i dati del form solo se l'utente ha riempito entrambi
 * i campi.
 */

if(isset($_POST["username"]) || isset($_POST["passwordold"]) || isset($_POST["email"])){
if( isset($_POST["passwordold"]) && isset($_POST["passwordnew"]) ){
    $id = mysql_real_escape_string($_POST['thisID']);
    $passwordnew = md5(preg_replace('#[^A-Za-z0-9]#i', '', $_POST["passwordnew"]));
    $query = mysql_query("UPDATE utente SET password='$passwordnew' WHERE id='$id'") or die("Err:" . mysql_error());    
    $_SESSION["password"] = $passwordnew;

}
    

if (isset($_POST["username"]) || isset($_POST["email"])) {
    /*ai dati inseriti applichiamo lo stesso tipo di "filtraggio" che abbiamo
     * applicato nella pagina di amministrazione
     */
    $id = mysql_real_escape_string($_POST['thisID']);
    $username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); 
    $email =  preg_replace('#[^A-Za-z0-9@.]#i', '', $_POST["email"]);

    /* come nell'altra pagina includiamo lo script di connessione al database 
     * ed effettuiamo la query "di controllo"
     */
    
    $query = mysql_query("UPDATE utente SET username='$username', email='$email' WHERE id='$id'") or die("Err:" . mysql_error());
    $_SESSION["username"] = $username;
}

header("location: user_panel.php");
}

?>
<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Pannello Utente - <?php echo $_SESSION["username"]; ?>  - NewEcommerce</title>
        <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
    </head>

    <body>
        <div align="center" id="mainWrapper">
            <?php include_once("template_header.php"); ?>
            <div id="pageContent"><br />
                
                <h3> Benvenuto <font color="blue"> <?php echo $_SESSION["username"]; ?></font> qui puoi gestire i tuoi dati: </h3>
    
                <form action="user_data.php?pid=<?php echo $id; ?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
                    <table width="90%" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                            <td width="30%" align="right">ID utente:</td>
                            <td width="80%">
                                    <b> <?php echo $id ?></b>
                                </td>
                        </tr><tr>
                            <td width="20%" align="right">Username</td>
                            <td width="80%"><label>
                                    <input name="username" type="text" id="username" size="64" value="<?php echo $username; ?>" />
                                </label></td>
                        </tr>
                        <tr>
                            <td align="right">Inserisci vecchia password</td>
                            <td><label>
                                    <input name="passwordold" type="password" id="passwordold" size="12" value="<?php echo $password; ?>" />
                                </label></td>
                        </tr>
                        <tr>
                            <td align="right">Vuoi aggiornare la password? Inseriscine una nuova</td>
                            <td><label>
                                    <input name="passwordnew" type="password" id="passwordnew" size="12" />
                                </label></td>
                        </tr>
                        <tr>
                            <td align="right">Email</td>
                            <td><label>
                 
                                    <input name="email" type="text" id="email" size="12" value="<?php echo $email; ?>" />
                                </label></td>
                        </tr>
                        
                            <td><label>
                                    <input name="thisID" type="hidden" value="<?php echo $id; ?>" />
                                    <input type="submit" name="button" id="button" value="Conferma Modifiche" />
                                </label></td>
                        </tr>
                    </table>
                </form>

                </div>
                                           <?php include_once("template_footer.php");             ?>
                
            </div>
    </body>
</html>