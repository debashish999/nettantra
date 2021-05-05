<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include 'connections/connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
	
    $sql = "SELECT * FROM `users` WHERE (`username` = '$username' OR `email` = '$username') AND `password` = '$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $login = true;
		session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		header('location: dashboard.php');
    }

    else{
        $showError = 'Invalid Credentials';
    }

    }    

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Login page</title>
	 <meta name='viewport' content='width=device-width, initial-scale=1'>
        
          <script src="https://kit.fontawesome.com/65ace80df2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/log.css">
</head>
<body>
	<div>
		<h1>Sign in to continue</h1>
		<hr>
		
	</div>
	<div class="container">
		 <div class="imgcontainer">
   	 <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
  			</div>
  			<form method="post" action="">
		<label for="username">Your Username</label><br>
		<div>
		<i class="fa fa-user" style="font-size:24px"></i>
		<input type="text" name="username" placeholder="Enter username" id="username" required>
		</div>

		<label for="password">Your Password</label><br>
		<div>
			<i class="fa fa-key" style="font-size:24px"></i>
		<input type="Password" name="password" placeholder="Enter password" id="password" required>
	</div>
	<div>
		<input type="submit" value="Login" id="sub">
	</div>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label><br>
    <div id="reg">Create an account?
    <a href="register.php">sign up</a>
	</div>

	</div>
</form>
	<script type="text/javascript" ></script>
</body>
</html>