<?php include('server1.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>ajouter</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>* {
  margin: 0px;
  padding: 0px;
}
body {
  font-size: 120%;
  background: pink;
}

.header {
  width: 30%;
  margin: 50px auto 0px;
  color: white;
  background:red;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: pink;
  background: red;
  border: none;
  border-radius: 5px;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #red; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
</style>
<body>
  <div class="header">
  	<h2>ajouter un article</h2>
  </div>
	
  <form method="post" action="ajouter.php">
  <?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>title</label>
  	  <input type="text" name="title" value="<?php echo $title;?>">
  	</div>
  	<div class="input-group">
  	  <label>Resume</label>
  	  <textarea id="w3review" name="resume" rows="9" cols="50"
          value="<?php echo $article;?>">
          </textarea>
  	</div>
  	
  	  <button type="submit" class="btn" name="reg_user">ajouter</button>
  	</div>
  	<p>
  		
  	</p>
  </form>
</body>
</html>