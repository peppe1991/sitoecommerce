<?php
include "user_verify_script.php"
?>

<?php
/* Cominciamo ad elaborare i dati del form solo se l'utente ha riempito entrambi
 * i campi.
 */

if (isset($_POST["username"]) & isset($_POST["password"])) {
    /*ai dati inseriti applichiamo lo stesso tipo di "filtraggio" che abbiamo
     * applicato nella pagina di amministrazione
     */
    $username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); 
    $password = md5(preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]));
    $email =  $_POST["email"];

    /* come nell'altra pagina includiamo lo script di connessione al database 
     * ed effettuiamo la query "di controllo"
     */
    include "../storescripts/connect_to_mysql.php";
    $query = mysql_query("SELECT id FROM amministratore WHERE username='$username' LIMIT 1") or die(mysql_error());
    $found = mysql_num_rows($query);
    if ($found == 1) 
        { 
        /* Se troviamo un utente già registrato nel nostro database con lo 
         * stesso username mandiamo un messaggio di errore e impediamo la 
         * registrazione
         */
        echo'ERRORE: esiste già un utente registrato con questo username, si'
        . 'prega di sceglierne un altro';
       // header("location: ./admin_edit.php");
        exit();
    } else {
        /*Aggiungiamo al database un nuovo utente con i dati appena inseriti
         * 
         */
        
        $sqlCommand = mysql_query("INSERT INTO amministratore ( username, password, email, last_log_date)
            VALUES ('$username', '$password', '$email', NOW()) ") or die(mysql_error());
                // header("location: ./admin_edit.php");
     
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
            <div id="pageContent"><br />
                <table id="lista admin" width="600px"><tr><td> Id </td><td>Username</td><td>email</td><td>Ultimo accesso</td> </tr> <?php
$sql = mysql_query("SELECT * FROM amministratore");
    $adminCount = mysql_num_rows($sql);
    if ($adminCount > 0) {
        while ($row = mysql_fetch_array($sql)) {
         echo "<tr><td>";
            $id = $row["id"];
    echo "$id"."</td><td>";
    $admin_name = $row["username"];
    echo "$admin_name"."</td><td>";
    $email = $row["email"];            
    echo "$email"."</td><td>";
    $date = $row["last_log_date"];
           echo "$date"."</td></tr>";
    }}
?> </table>
                <div align="left" style="margin-left:24px;">
                    <h3>Inserire dati nuovo amministratore</h3>
                    <form id="form1" name="form1" method="post" action="admin_edit.php">
                        Username:<br />
                        <input name="name" type="text" id="username" size="40"  />
                        <br /><br />
                        Password:<br />
                        <input name="surname" type="password" id="password" size="40"  />
                        <br /><br />
                        Email:<br />
                        <input name="email" type="text" id="email" size="40"  />
                        <br /><br />
                      
                        <br />

                        <input type="submit" name="button" id="button" value="Conferma dati" />

                    </form>
                    <p>&nbsp; </p>
                </div>
                <br />
                <br />
                <br />
            </div>
            <?php include_once("template_footer.php");             ?>
        </div>
    </body>
</html>