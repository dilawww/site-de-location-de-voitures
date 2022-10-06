<?php 
session_start();
function duree($debut,$fin){
	$tdebut=explode("-", $debut);
	$tfin=explode("-", $fin);
	$diff=mktime(0,0,0,$tfin[1],$tfin[2],$tfin[0])-mktime(0,0,0,$tdebut[1],$tdebut[2],$tdebut[0]);
	return(($diff/86400)+1);
}
@$dateDebutRes=htmlentities($_POST['dateDebut']);
@$heureDebutRes=htmlentities($_POST['heureDebut']);
@$dateFinRes=htmlentities($_POST['dateFin']);
@$heureFinRes=htmlentities($_POST['heureFin']);
@$dureeRes=duree(@$dateDebutRes,@$dateFinRes);
@$verfierDateDebut=true;
@$verfierDateFin=true;

if (@$verfierDateDebut==true && @$verfierDateFin==true) {
if (isset($_POST['submitRes'])) {
$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$req=$bdd->prepare('SELECT prixLocation FROM voiture WHERE matriculeVoiture=?');
$req->execute(array($_GET['matricule']));
while($données=$req->fetch()){
	@$montant=($données['prixLocation']*@$dureeRes);
}
$voiture=$bdd->prepare('INSERT INTO reservation (permisClient,matriculeVoiture,dateDebutRes,heureDebutRes,dateFinRes,heureFinRes,montantRes) VALUES(?,?,?,?,?,?,?)');
$voiture -> execute(array($_SESSION['permis'],$_GET['matricule'],@$dateDebutRes,@$heureDebutRes,@$dateFinRes,@$heureFinRes,@$montant));
header('Location: profil.php');
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/icons.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
   
	<meta charset="utf-8">
</head>
<body>

<?php
include('header/header1.php');


$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$req=$bdd->prepare('SELECT * FROM voiture where matriculeVoiture=? ');
$req->execute(array($_GET['matricule']));
while ($données=$req->fetch()) {

 ?>
 <div class="container"> 
         
  <img src="admin/images/<?php echo $données["image"]; ?> " class="rounded-circle" alt="Cinque Terre" width="400" height="400" style="margin-top: 120px;margin-left:60px;box-shadow: 5px 5px 8px 7px rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19)"> 
  <h1 style="margin-top: 40px;margin-left: 140px;font-size: 50px"><?php echo ucwords($données["nomVoiture"]); ?></h1> 
</div>
 
 <?php }?>
<form method="post" action="">
<div class="location" style="margin-top:-500px;margin-bottom:50px;margin-left: 600px;">
<div class="dateD">
<label>Date début location :</label>
<input type="date" name="dateDebut"  required style="width: 400px;"> 
</div>
<div class="heureD">
	<label>Heure début réservation :</label>
<select type="time" name="heureDebut"  required style="width: 400px;">
<option selected disabled hidden>Heure début réservation</option>
<option>9:00</option>
<option>10:00</option>
<option>11:00</option>	
<option>13:00</option>
<option>14:00</option>
<option>15:00</option>
</select> 
</div>
<div class="dateF">
	<label>Date fin réservation :</label>
<input type="date" name="dateFin"  required style="width: 400px;"> 
<?php 
if(isset($_POST['submitRes'])){
if (@$dateDebutRes >= @$dateFinRes) {
echo "<span>Veuillez saisir une date valide</span>";
@$verfierDateFin=false;
} 
}
?>
</div>
<div class="heureF">
<label>Heure fin réservation :</label>
<select type="time" name="heureFin"  required style="width: 400px;">
<option selected disabled hidden>Heure  fin réservation</option>	
<option> 9:00 </option>
<option> 10:00 </option>
<option> 11:00 </option>	
<option> 13:00 </option>
<option> 14:00 </option>
<option> 15:00 </option>
</select> 
</div>
<div class="btn" style="margin-left: 50px;margin-top: 14px">
<input type="submit"  class="btn btn-success" name="submitRes" value="Valider">
<input type="reset" style="width: 92px;margin-left: 90px;" class="btn btn-danger"   value="Annuler">
</div>
</div>
</form>

<?php include('footer/footer.php'); ?>
</body>
</html>
