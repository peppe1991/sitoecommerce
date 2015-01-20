
<?php
session_start();
unset($_SESSION["id"]);
$_SESSION["admin_name"] = "guest"; 
?>

Sei stato disconnesso con successo.

<?php
header ("location: index.php");
?>