<?php 
session_start();
$row = false;
$num = 0;
$result = false;
$Userdata = '';
$Userdetails = '';
$userPhone = false;
$dataupdated = false;
$datainserted = false;

if(!isset($_SESSION['loggedin']) ||$_SESSION['loggedin']!= true ){
    header('location: login.php');
    exit;
}
else{
include 'connections/connect.php';
 $username = $_SESSION['username'];
 $sql = "SELECT * FROM `users` WHERE (`username` = '$username' OR `email` = '$username')";
 $result = mysqli_query($conn,$sql);
 $num_user = mysqli_num_rows($result);
 $Userdata = mysqli_fetch_assoc($result);
 $userid = $Userdata['id'];
 $sql = "SELECT * FROM `userdetails` WHERE `id` = $userid";
 $result = mysqli_query($conn,$sql);
 $Userdetails = mysqli_fetch_assoc($result);
 $num = mysqli_num_rows($result);
 
}
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include 'connections/connect.php';
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    if($userPhone == false && $phone != $Userdetails['phone']){

        $sql = "SELECT * FROM `userdetails` WHERE `phone` = '$phone'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $usernameExists = 'Phone already taken please try another username';
        }
        }
    
        if($userPhone == false){
            if($num > 0){
            $userid = $Userdata['id'];
            $sql = "UPDATE `userdetails` SET `firstname` = '$firstname',`middlename` = '$middlename',`lastname` = '$lastname',`phone` ='$phone',`dob`='$dob',`gender`='$gender'  WHERE `id` = $userid ";
            $result = mysqli_query($conn, $sql);
       
        if($result){
            
            $dataupdated = true;
            header('location: userprofile.php');
            
        }
    }
        else{
            $userid =(int)$Userdata['id'] ;
        $sql = "INSERT INTO `userdetails` (`id`,`firstname`,`middlename`,`lastname`,`phone`,`dob`,`gender`) VALUES 
        ($userid,'$firstname','$middlename','$lastname','$phone','$dob','$gender')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $datainserted = true;
            header('location: userprofile.php');
           
        }
        }
    
        }
        
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>User personal details</title>
	<link rel="stylesheet" type="text/css" href="css/userpersonal.css">
	 <meta name='viewport' content='width=device-width, initial-scale=1'>
        
          <script src="https://kit.fontawesome.com/65ace80df2.js" crossorigin="anonymous"></script>
</head>
<body>
	<nav id="navbar">
		<ul>
			<li>
				<a href="">Home</a></li>
                <li><a href="userprofile.php">Profile</a></li>
				<li><a href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<header>
		<h1>Personal Details</h1>
	</header>
	<div>
		
		<p>Please fill this details</p>

		<hr>
	</div>
	<div class="container">
		 <div class="imgcontainer">
   	 <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
			  </div>
			  <form method="POST" action="">
	

		<div>
			<i class="fa fa-user" style="font-size:24px"></i>


			 <?php
            if($num > 0){
                
            echo '<input type="text" class="form-control" id="firstname" aria-describedby="firstname" name="firstname" placeholder="Firstname" value ="'.$Userdetails['firstname'].'" required>';
        }else{
            
            echo '<input type="text" class="form-control" id="firstname" aria-describedby="firstname" name="firstname" placeholder="Firstename" required>';
        }
            ?>
		</div>
		<div>
			<i class="fa fa-user" style="font-size:24px"></i>
			<?php
            if($num > 0){
            echo '<input type="text" class="form-control" id="middlename" aria-describedby="middlename" name="middlename" placeholder="Middlename" value ="'.$Userdetails['middlename'].'">';
        }else{
            echo '<input type="text" class="form-control" id="middlename" aria-describedby="middlename" name="middlename" placeholder="Middlename" >';
        }
            ?>
		 <div>
		 	<i class="fa fa-user" style="font-size:24px"></i>
			 <?php
            if($num > 0){
            echo '<input type="text" class="form-control" id="lastname" aria-describedby="lastname" name="lastname" placeholder="Lastname" value ="'.$Userdetails['lastname'].'" required>';
        }else{
            echo '<input type="text" class="form-control" id="lastname" aria-describedby="lastname" name="lastname" placeholder="Lastname" required>';
        }
            ?>
		</div>

		<div>
			<i class="fa fa-mobile" style="font-size:24px"></i>
			<?php
            if($num > 0){
            echo '<input type="tel" class="form-control" id="phone" aria-describedby="phone" name="phone" placeholder="Phone" pattern="[0-9]{10}" value ="'.$Userdetails['phone'].'" required>';
        }else{
            echo '<input type="tel" class="form-control" id="phone" aria-describedby="phone" name="phone" placeholder="Phone" pattern="[0-9]{10}" required>';
        }
            ?>
		</div>
		<div>
			<i class="fa fa-calendar" style="font-size:24px"></i>
			<?php
            if($num > 0){
            echo '<input type="date" class="form-control" id="dob" aria-describedby="dob" name="dob" placeholder="Date of birth" value ="'.$Userdetails['dob'].'" required>';
        }else{
            echo '<input type="date" class="form-control" id="dob" aria-describedby="dob" name="dob" placeholder="Date of birth" required>';
        }
            ?>
		</div>
		<div>
			<i class="fa fa-male" style="font-size:24px"></i>
		<select class="form-control" id="sel1" name='gender'>
                <option value="" selected disabled hidden>Choose here</option>
                <option value="Male" <?php if ($Userdetails['gender'] == 'Male') echo 'selected="selected"';?>>Male</option>
                <option value="Female" <?php if ($Userdetails['gender'] == 'Female') echo 'selected="selected"';?>>Female</option>
                <option value="Others" <?php if ($Userdetails['gender'] == 'Others') echo 'selected="selected"';?>>Others</option>
            </select>
		</div>
		   <button type="submit">Submit</button>

	</div>
</form>

</body>
</html>