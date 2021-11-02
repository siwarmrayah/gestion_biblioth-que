<?php
session_start();

// initializing variables

$title = "";
$article = "";
$errors = array(); 

// connect to the database
$idConnexion = mysqli_connect('localhost', 'root', '', 'mini_projet');
//sert à savoir si une variable possède une
//valeur (true ou false) 

// REGISTER mini_projet
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $title = mysqli_real_escape_string($idConnexion, $_POST['title']);
  $article = mysqli_real_escape_string($idConnexion, $_POST['resume']);
 
//renvoie true si la variable est vide ou vaut 0,
//sinon revoie false
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($title)) { array_push($errors, "title is required"); }
  if (empty($article)) { array_push($errors, "resume is required"); }
  
  

  // first check the database to make sure 
  // a mini_projet does not already exist with the same title and/or article
  $req = "SELECT * FROM mini_projet WHERE title='$title' OR resume='$article' LIMIT 1";
  $result = mysqli_query($idConnexion, $req);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['title'] === $title) {
      array_push($errors, "title already exists");
    }

    if ($user['resume'] === $article) {
      array_push($errors, "article already exists");
    }
    
  }

  // Finally, register mini_projet if there are no errors in the form
  if (count($errors) == 0) {
  	$article = ($article);

  	$query = "INSERT INTO mini_projet (title,resume) 
  			  VALUES('$title', '$article')";
  	mysqli_query($idConnexion, $query);
    $_SESSION['title'] = $title;
    $_SESSION['resume'] = $article;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: catalogue1.php');
  }
}

// ... 
// LOGIN mini_projet
if (isset($_POST['reg_user'])) {
  $title = mysqli_real_escape_string($idConnexion, $_POST['title']);
  $article= mysqli_real_escape_string($idConnexion, $_POST['resume']);

  if (empty($title)) {
  	array_push($errors, "title is required");
  }
  if (empty($article)) {
  	array_push($errors, "resume is required");
  }

  if (count($errors) == 0) {
  	$article = ($article);
  	$query = "SELECT * FROM mini_projet WHERE title='$title' AND resume='$article'";
  	$results = mysqli_query($idConnexion, $query);
  	if(mysqli_num_rows($results) == 1) {
  	  $_SESSION['title'] = $title;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: catalogue1.php');
  	}else {
  		array_push($errors, "try again");
  	}
  }
}
?>