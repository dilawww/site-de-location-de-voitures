<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Nos voitures</title>
	<link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/icons.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
    <link rel="stylesheet" href="fonts/icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Julee" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&amp;subset=latin-ext"/>
    <link rel="stylesheet" href="fonts/styles.css">
    <link rel="stylesheet" href="path/to/line-awesome/css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
     
  <link rel="stylesheet prefetch" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

  <link rel="stylesheet" href="fonts/style.css">
	<meta charset="utf-8">
</head>
<body>

<?php 
  include('header/header1.php');

?>
<div class="recherche">
	
	<form method=" get" action="recherche.php">
	<input type="text" name="recherche" placeholder="Chercher votre marque préférée" style="margin-top: 98px;width:661px;margin-left: 360px;">
	<button name="submit"></button>  
	</form>
	</div>
<?php 
$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$req=$bdd->prepare('SELECT * FROM voiture ');
$req->execute();
while ($données=$req->fetch()) {
?>
<div class="list_cars" style="display: inline-block;width: 300px; box-shadow: 5px 5px 8px 7px rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19); margin-top: 95px; margin-left:120px; ">
	<div class="cars" style="border-bottom: 2px dashed black;"><img src="admin/images/<?php echo $données["image"]; ?> " height="200" width="280" style="padding-right: 11px;padding-top: 27px;  padding-left: 10px;  margin-top: 17px; margin-left: 0px;padding:0; text-align: center;">
	</div>
<p style="margin-left: 5px;font-style: italic; text-align: center;font-size: 30px;margin-top: 4px;font-weight: bolder;"> <?php echo  $données['nomVoiture']; ?></p>
<p style="margin-left: 5px;font-style: italic;"> Prix Location: <?php  echo $données['prixLocation'];?>DA/J</p>
<div style="display: grid;">
<div class="siege" style="display: inline-flex;"><img src="images/siege.png" height="35" width="35"><p style="margin-left: 18px"><?php echo $données['nbrSiege']?> Siéges</p></div>
<div class="porte" style="display: inline-flex;"><img src="images/porte.png" height="35" width="35"><p style="margin-left: 18px"><?php echo $données['nbrPorte']?> Portes</p></div>
<?php if (($données['climatisation'])=='Oui') {
?>
<div class="climatiser" style="display: inline-flex;">
<img src="images/climatiser.png" height="35" width="35">
<p style="margin-left: 13px;margin-top: 5px">Climatisée</p>
</div>
<?php
}
else{
?>	
<div style="display: inline-flex;">
<img src="images/croix.png" height="35" width="35">

<p style="margin-left: 13px;margin-top: 5px">Non climatisée</p>
</div>
<?php
}
if (($données['boite'])=='Automatique') {
?>
<div style="display: inline-flex;">
<img src="images/boiteAuto.png" height="35" width="35" style="text-decoration: line-through;">
<p style="margin-left:13px;margin-top:5px">Boite Automatique</p>
</div>
<?php
}
elseif (($données['boite'])=='Manuelle') {
?>
<div style="display: inline-flex;">
<img src="images/boiteManuelle.png" height="35" width="35" style="text-decoration: line-through;">
<p style="margin-left: 13px;margin-top: 5px">Boite Manuelle</p>
</div>	
<?php
}
 ?>
 <div class="lienRes" style="background-color:#9ACD32; box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);">
 <a href="reservation.php?matricule=<?=$données['matriculeVoiture']?>" style="color:black;margin-left: 41px;font-size: 24px;" onmouseover="this.style.color='white';" onmouseout="this.style.color='black'">Reserver Maintenant</a>
 </div>
</div>
</div>
<?php
}
?>
<!--footer-->
<?php include('footer/footer.php'); ?>
</body>
</html>
