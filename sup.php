<?php
// connexion
$bdd= new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
// preparer la requette
$pdostat = $bdd->prepare('DELETE FROM reservation WHERE idRes=:num');
//lier le param nomme
$pdostat->bindValue(':num',$_GET['ID'],PDO::PARAM_INT);
//execution
$executeisok=$pdostat->execute();
header('Location: profil.php?m=1')
?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8">
<link rel="stylesheet"  href="style.css"  >      
</head>
 <body>               
</body>
</html>