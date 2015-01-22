<?php
include "user_verify_script.php"
?>

<?php
/* Cominciamo ad elaborare i dati del form solo se l'utente ha riempito entrambi
 * i campi.
 */

if (isset($_POST["username"]) && isset($_POST["password"])) {
    /*ai dati inseriti applichiamo lo stesso tipo di "filtraggio" che abbiamo
     * applicato nella pagina di amministrazione
     */
    $pid = mysql_real_escape_string($_POST['thisID']);
    $username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); 
    $password = md5(preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]));
    $email =  $_POST["email"];

    /* come nell'altra pagina includiamo lo script di connessione al database 
     * ed effettuiamo la query "di controllo"
     */
    include "../storescripts/connect_to_mysql.php";
    $query = mysql_query("UPDATE amministratore SET username='$username', password='$password', email='$email' WHERE id='$pid'") or die("Err:" . mysql_error());
    header("location: admin_list.php");
}


?>
<?php
/* prelevo le informazioni riguardanti l'oggetto selezionato e le inserisco
 * automaticamente in un form dove l'admin potrà vederle e decidere quali
 * modificare
 */
if (isset($_GET['pid'])) /* se è settata la variabile che passiamo dall'altra
 * pagina (il codice del prodotto)
 * (si potrebbe filtrare un'altra volta ma è ridondante) 
 */ {
    $targetID = $_GET['pid']; //salvo il codice su una nuova variabile
    /* query sul database per richiamare informazioni sul prodotto
     * 
     */
    $sql = mysql_query("SELECT * FROM amministratore WHERE id='$targetID' LIMIT 1");
        $adminCount = mysql_num_rows($sql);

    if ($adminCount > 0) {
        while ($row = mysql_fetch_array($sql)) {

            $username = $row["username"];
            $password = $row["password"];
            $email = $row["email"];
           
        }
    } else {
        /* non dovrebbe mai accadere visto che il codice lo passiamo in 
         * automatico dall'altra pagina
         */
        echo "ERRORE: id amministratore inesistente nel database.";
        exit();
    }
}
?>
<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gestione Admin</title>
        <link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
    </head>

    <body>
        <div align="center" id="mainWrapper">
            <?php include_once("template_header.php"); ?>
            <div id="pageContent">                    <h3>Modificare i dati dell'amministratore selezionato</h3>
<br />
                <form action="admin_edit.php?pid=<?php echo $targetID; ?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
                    <table width="90%" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                            <td width="20%" align="right">Username</td>
                            <td width="80%"><label>
                                    <input name="username" type="text" id="username" size="64" value="<?php echo $username; ?>" />
                                </label></td>
                        </tr>
                        <tr>
                            <td align="right">Password</td>
                            <td><label>
                                    <input name="password" type="password" id="password" size="12" value="<?php echo $password; ?>" />
                                </label></td>
                        </tr>
                        <tr>
                            <td align="right">Email</td>
                            <td><label>
                 
                                    <input name="email" type="text" id="email" size="12" value="<?php echo $email; ?>" />
                                </label></td>
                        </tr>
                        
                            <td><label>
                                    <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
                                    <input type="submit" name="button" id="button" value="Conferma Modifiche" />
                                </label></td>
                        </tr>
                    </table>
                </form>
                <br />
                <br />
                <br />
            </div>
            <?php include_once("template_footer.php");             ?>
        </div>
    </body>
</html>