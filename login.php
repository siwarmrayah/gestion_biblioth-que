

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My Bibliothéque</title>
  


  <!-- Bootstrap core CSS -->
  <link href="public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="public/assets/css/business-casual.min.css" rel="stylesheet">

</head>


  <style>
  

    * {
  box-sizing: border-box;
}
body {
  margin: 0;
  font-family: sans-serif;
}
a {
  color: #666;
  font-size: 14px;
  display: block;
}

#login-page {
  display: flex;
}
.notice {
  font-size: 13px;
  text-align: center;
  color: #666;
}
.login {
  width: 30%;
  height: 100vh;
  background: #FFF;
  padding: 70px;
}



.background h1 {
  max-width: 420px;
  font-size: 20px;
  color: #FFF;
  text-align: right;
  padding: 0;
  margin: 0;
}


  .box {
  border: 1px solid #c4c4c4;
  padding: 30px 25px 10px 25px;
  background: white;
  margin: 30px auto;
  width: 360px;
  margin-left:0px;
}

    .box-input {
  font-size: 14px;
  background: #fff;
  border: 1px solid #ddd;
  margin-bottom: 25px;
  padding-left:10px;
  border-radius: 5px;
  width: 280px;
  height: 70px;
}
.box-button {
  border-radius: 5px;
  background: black;
  text-align: center;
  cursor: pointer;
  font-size: 19px;
  width: 100%;
  height: 51px;
  padding: 0;
  color: #fff;
  border: 0;
  outline:0;
}
.nav div.logo {
    float: left;
    width: auto;
    height: auto;
    padding-left: 3rem;
}

.nav div.logo a {
    text-decoration: none;
    color: #fff;
    font-size: 2.5rem;
}

.nav div.logo a:hover {
    color: #00E676;
}

.nav div.main_list {
    height: 65px;
    float: right;
}

.nav div.main_list ul {
    width: 100%;
    height: 65px;
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}
.nav div.main_list ul li {
    width: auto;
    height: 65px;
    padding: 0;
    padding-right: 3rem;
}

.nav div.main_list ul li a {
    text-decoration: none;
    color: #fff;
    line-height: 65px;
    font-size: 2.4rem;
}

.nav div.main_list ul li a:hover {
    color: #00E676;
}

  </style>
</head>
<body>
<body>

<h1 class="site-heading text-center text-white d-none d-lg-block">
  <span class="site-heading-upper text-primary mb-3">My Bibliothéque</span>
  <span class="site-heading-lower">Bienvennue</span>
</h1>

    <section class="home">
    </section>
<div id="login-page">
  <div class="login">
    <h2 class="login-title"></h2>

    <?php
require('connect.php');
$username="";
$email="";
/*$_SESSION["username"]; 
$_SESSION['password'];*/
if (isset($_POST['submit'])){
  $username = mysqli_real_escape_string($idConnexion, $_POST['username']);
  $password = mysqli_real_escape_string($idConnexion,  $_POST['password']);
  $email = mysqli_real_escape_string($idConnexion,  $_POST['email']);
   $query = "SELECT * FROM inscription WHERE username='$username' and password='$password' and email=' $email'";
  $result = mysqli_query($idConnexion,$query) or die(mysqli_error());
  //var_dump($result);
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      $_SESSION['email'] = $email;

     $res="SELECT id FROM inscription where username='$username'and password='$password' and email='$email'";
     $res=mysqli_query($idConnexion,$res);
     if(mysqli_num_rows($res)!=0)
     {
      while($res_array=mysqli_fetch_assoc($res))   {
        $id_ad=$res_array['id'];
        $_SESSION['id']=$id_ad;
      }
     }
      header("Location: catalogue1.php");
  }else{
    $message = "créer un compte";
  } 
}
?>
<div><p style="font-size:15px;font-family:Georgia, serif;text-align:center;color:chocolate">Vous êtes un utilisateur </p>
<p style="font-size:15px;font-family:Georgia, serif;text-align:center;color:chocolate">Remplir ce formulaire pour connecter</p>
</div>
    <form class="box" action="" method="post" name="login">

<h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required value="<?php echo $username; ?>">
<input type="password" class="box-input" name="password" placeholder="Mot de passe" required>

  	  <input type="email" name="email"  class="box-input"  placeholder="email" required value="<?php echo $email; ?>" >
  	
<input type="submit" value="Connexion " name="submit" class="box-button">

<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
 </form>
 
    <div class="created">
    </div>
 
  <div class="background">
   
  </div>
  
</div>

</body>
</html>
