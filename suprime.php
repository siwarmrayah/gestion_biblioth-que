
<?php 
    require_once("connect.php");


   if (! $idConnexion){
       echo "echec de la connexiopn: " .mysqli_connect_error();
       exit();
   }
   
$test =$_GET['a'];
$req ="delete from mini_projet where id=$test";
$res=mysqli_query($idConnexion,$req);
header('location: catalogue1.php');

?> 