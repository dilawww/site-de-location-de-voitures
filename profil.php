<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Mon profil</title>
	
	<meta charset="utf-8"> 
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/fcss0.css">
    <link rel="stylesheet" href="fonts/fcss1.css">
    <link rel="stylesheet" href="fonts/fcss2.css">
    <link rel="stylesheet" href="fonts/bootstrap-grid.css">
      <link rel="stylesheet" href="style/profil.css">
   
</head>
<body>
<?php
include('header/header1.php');
?>
<?php if  (date("H") <17) {?>
  <h2 style="text-align: center; margin-top: 150px;"> Bonjour bienvenue dans votre espace personnel</h2>
 <hr>
 <?php 
} 
else {?>
  <h2 style="text-align: center; margin-top: 150px;"> Bonsoir bienvenue dans votre espace personnel</h2> 
 <hr>
 <?php
}
?>

<div class="container emp-profile" >
            <form method="post">
                <div class="row" style="margin-left: -123px;margin-top: 14px;">
                    <div class="col-md-4">
                       
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h1>
                                      <?php  echo $_SESSION['nom'].'  '.$_SESSION['prenom'] ?>
                                    </h1>
                                  
                                    
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                </div>
                <div class="row" style="margin-left: -80px;">
                    <div class="col-md-4">
                        <div class="profile-work">
                          
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Votre permis</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION['permis'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nom</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION['nom'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Prénom</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION['prenom'] ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>N° Téléphone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION['numero'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Adresse</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION['adresse'] ?></p>
                                            </div>
                                        </div>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
         <a href="modifierClient.php"><button class="btn btn-success" style="margin-left: 700px">Editer profil</button></a>
<hr>
<div class="reservation" style="margin-left: 182px;margin-top: 32px;">
	<p style="font-size: 39px;color: black;margin-left: -80px"> Mes Réservation : </p>
	<p style="color: red ;margin-left: -80px">(Le jour ou vous recevez votre voiture,vous devez être accompagné de votre permis de conduire et le code de votre réservation confirmée)</p>
<?php 
$bdd=new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','',array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$req=$bdd->prepare('SELECT * FROM reservation INNER JOIN voiture ON reservation.matriculeVoiture=voiture.matriculeVoiture  WHERE permisClient=? ');
$req ->execute(array($_SESSION['permis']));
?>
<table  class="table table-borderedtable  .table-sm" style="margin-left:-80px;width:95%;" >
	<thead class="thead-dark" >
	<tr>	
	<th style="padding-left: 3px;padding-top: 4px;padding-right: 19px;font-size: 12px">Voiture Reservée </th>									
	<th style="padding-left: 3px;padding-top: 4px;padding-right: 19px;font-size: 12px">Code Reservation</th>
	<th style="padding-left: 3px;padding-top: 4px;padding-right: 19px;font-size: 12px">Date début Reservation</th>	
	<th style="padding-left: 3px;padding-top: 4px;padding-right: 19px;font-size: 12px">Heure début Reservation</th>	
	<th style="padding-left: 3px;padding-top: 4px;padding-right: 19px;font-size: 12px">Date Fin  Reservation</th>
	<th style="padding-left: 3px;padding-top: 4px;padding-right:19px;font-size: 12px">Heure Fin  Reservation</th>	
	<th style="padding-left: 3px;padding-top: 4px;padding-right:19px;font-size: 12px">Montant Reservation</th>	
	<th style="padding-left: 20px;padding-top: 4px;padding-right:19px;font-size: 12px">Suppression</th>	
	<th style="padding-left: 20px;padding-top: 4px;padding-right:19px;font-size: 12px">Confirmation</th>	
	</tr>
</thead>
<?php
while ($données=$req->fetch()) {
?>
<tr>
<th style="padding-left: 18px;padding-top: 4px;"><img style="width: 104px;height: 93px;margin-left: -6px;" src="admin/images/<?php echo $données['image']; ?>"></th>
<th style="padding-top: 40px;text-align: center;"><?php echo $données['idRes']; ?></th>
<th style="padding-top: 40px;text-align: center;"><?php echo $données['dateDebutRes']; ?></th>
<th style="padding-top: 40px;text-align: center;"><?php echo $données['heureDebutRes']; ?></th>
<th style="padding-top: 40px;text-align: center;"><?php echo $données['dateFinRes']; ?></th>
<th style="padding-top: 40px;text-align: center;"><?php echo $données['heureFinRes']; ?></th>
<th style="padding-top: 40px;text-align: center;"><?php echo $données['montantRes'];?>DA</th>
<th style="padding-top: 40px;text-align: center;"><a href="sup.php?ID=<?=$données['idRes']?>" class="btn_delete" style="color: red;text-decoration: underline;cursor: pointer;"><button style="margin-left: 22px; margin-right: 11px;margin-top: 3px;" type="button" class="btn btn-danger">Supprimer</button></a>

	<?php if($données['confirmer']==0 && $données['annuler']==0) {
    ?>
    <th style="padding-left: 12px;padding-top: 20px;"> <p style="color: red; font-size: 12px;margin-left:-5px;margin-top: 20px">Pas encore confirmée </p> </th>
<?php 
	}
elseif ($données['confirmer']==1) {
?>
<th style="padding-left: 20px;padding-top: 20px;margin-left: -5px;" > <p style="color:green;font-size: 12px;margin-left: 10px;margin-top: 20px"> confirmée </p> </th>
<?php
}
elseif ($données['confirmer']==0 && $données['annuler']==1)  {
?>
<th style="padding-left: 20px;padding-top: 20px;margin-left: -5px;" > <p style="color:red;font-size: 12px;margin-left: 10px;margin-top: 20px"> Votre réservation est annulée  </p> </th>
<?php
}
?>
</tr>
<?php 
}
?>
</table>
<?php 
if(isset($_GET['m'])){
?>
<div class="flash-data" data-flashdata="<?=$_GET['m'];?>"></div>
<?php } ?>
<script  src="sweetAlert/jquery-3.5.1.min.js"></script>
<script  src="sweetAlert/sweetalert2.all.min.js"></script>
<script>
	$('.btn_delete').on('click',function(e){
		e.preventDefault();
     const href =$(this).attr('href')



	Swal.fire({
  title: "<?php echo ucwords($_SESSION['prenom']); ?>  êtes-vous sûr?",
  text: "Votre réservation sera supprimée difinitivement!",
  icon: 'warning',
  showCancelButton:true ,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Annuler',
  confirmButtonText: 'Oui,Supprimer!'
}).then((result) => {
  if (result.value) {
  	document.location.href = href;
    
  }
})
})
 const flashdata=$('.flash-data').data('flashdata');
 if (flashdata) {
 	Swal.fire({
 		icon: 'success',
 		type :'success',
 		title : 'supprimée',
 		text:'Votre réservation a été supprimée!'
 	})
 }

</script>
</div>

<!-- footer -->
</body>
</html>
