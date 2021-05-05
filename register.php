<?php
$datainserted = false;
$usernameExists = false;
$emailExists = false;
$errormessage = '';
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include 'connections/connect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    if($usernameExists == false){
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0){
        $usernameExists = 'username already taken please try another username';
    }
    }

    if($emailExists == false){
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $emailExists = 'email already taken please try another email';
        }
        }
    if($password != $cpassword){
		$errormessage = 'confirm passoword does not match password';
	}
    if (($password == $cpassword && $usernameExists == false && $emailExists == false)){
        $sql = "INSERT INTO `users` (`username`,`email`,`password`) VALUES 
        ('$username','$email','$password')";
        $result = mysqli_query($conn, $sql);
        if($result){
			$datainserted = true;
			header('location: login.php');
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Registration</title>
	 <meta name='viewport' content='width=device-width, initial-scale=1'>
        
          <script src="https://kit.fontawesome.com/65ace80df2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/reg.css">
</head>
<body>
	<div>
		<h1>Sign Up here</h1>
		

		<hr>
	</div>
	<div class="container">
		 <div class="imgcontainer">
   	 <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
  			</div>
  			<p>Please fill in this form to create an account.</p>
  			<hr>
  			<form action="" method="post">
		<label for="username">Your Username</label><br>
		<div>
		<i class="fa fa-user" style="font-size:24px"></i>
		<input type="text" name="username" placeholder="Enter username" id="username" required>
		</div>
		<div>
			<label for="email">Your E-mail</label><br>
		<i class="fa fa-envelope" style="font-size:24px"></i>
		<input type="email"  placeholder="Email" name="email" id="email" required>
		</div>

		<label for="password">Your Password</label><br>
		<div>
			<i class="fa fa-key" style="font-size:24px"></i>
		<input type="Password" name="password" placeholder="Enter password" id="password" minlength="8" required>
	</div>
		<label for="password">Confirm Password</label><br>
	<div>
			<i class="fa fa-key" style="font-size:24px"></i>
		<input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" id="cpassword" minlength="8" required>
	</div>

	<div>
		<input type="submit" value="Register" id="sub">
	</div>
   
    <div id="reg">Already have an account?
    <a href="login.php">sign in</a>
	</div>

</form>
	</div>
	<script type="text/javascript" ></script>
</body>
</html>