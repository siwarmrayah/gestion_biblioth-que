
<?php 
    require_once("connect.php");


   
?>    

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Catalogue</title>

  <!-- Bootstrap core CSS -->
  <link href="public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="public/assets/css/business-casual.min.css" rel="stylesheet">
 
</head>
<style>
        h1{margin-left:100px;
        font-family: arial;
        color: white;} 
       
        p{
            color:white;
        }
        img{
          margin-left:100px;
          

        }
        div img{float: right;}
        .hi{
    width: 1360px;
    height: 500px;
}
    </style>
<body>

<h1 class="site-heading text-center text-white d-none d-lg-block">
    <span class="site-heading-upper text-primary mb-3">BIENVENUE</span>
    <span class="site-heading-lower">My Bibliothéque</span>
  </h1>
  <?php
//récupaire les articles

function get_articles(){
    require('connect.php');
    $req=('select id,resume,image, title from mini_projet');
    $res=mysqli_query($idConnexion,$req);
    if(mysqli_num_rows($res)!=0)
    {
        ?>
        
        
        <?php 
        while ($row = mysqli_fetch_assoc($res)){
         echo "
         
        <h1  >".$row['title']."</h1>
        
         <img src=\"".$row['image']."\"  height=\"150px\"/>
         <p >".$row['resume']."</p>
         <a href=\"home.php\">Empreinter</a>
         <a href=\"admiiiin.php\">modifier</a>
         ";
        }
        ?>
        <?php
    }    
}          
         get_articles()
         ?>
  
  <footer class="footer text-faded text-center py-5">
    <div class="container">
      <p class="m-0 small">Copyright &copy; Your Website 2021</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="public/assets/jquery/jquery.min.js"></script>
  <script src="public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>