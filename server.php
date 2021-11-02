<?php


// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database

    $serveurBD="localhost";
     $nomUtilisateur="root";
     $motDePasse="";
     $baseDeDonnees="mini_projet";

     $idConnexion=mysqli_connect($serveurBD,$nomUtilisateur,$motDePasse) 
         or die(" Problemme de connexion a la base !!");

      $connexionBase = mysqli_select_db($idConnexion,$baseDeDonnees)
         or die(" Problemme de selection a la base !!");


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($idConnexion, $_POST['username']);
  $email = mysqli_real_escape_string($idConnexion, $_POST['email']);
  $password_1 = mysqli_real_escape_string($idConnexion, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($idConnexion, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM inscription WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($idConnexion, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO inscription (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($idConnexion, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: emp.php');
  }
}

// ... 
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($idConnexion, $_POST['username']);
  $password = mysqli_real_escape_string($idConnexion, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = ($password);
  	$query = "SELECT * FROM inscription WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($idConnexion, $query);
  	if(mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: emp.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>