
<?php
session_start();
 
// Suppression des variables de session et de la session
unset($_SESSION['permis']);
unset($_SESSION['password']);

session_unset();
  
header('Location: formulaireClient1.php?m=1');
 
 
?>
