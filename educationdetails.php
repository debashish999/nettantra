<?php
session_start();
$datainserted = false;
$dataupdated = false;
$Userdata = '';

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
     $sql = "SELECT * FROM `educationdetails` WHERE `id` = $userid";
     $result = mysqli_query($conn,$sql);
     $Userdetails = mysqli_fetch_assoc($result);
     $num = mysqli_num_rows($result);
     
    }

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include 'connections/connect.php';
    $schoolname = $_POST['schoolname'];
    $tenthmark = $_POST['tenthmark'];
    // $tenthmark = '';
    // $twthmark = '';
    // if ($tenthmarkcat == 'CGPA'){
    //     $tenthmark = $_POST['tenthmarkc'];
    // }
    // else{
    //     $tenthmark = $_POST['tenthmarkp']; 
    // }
    // $tenthmark = $_POST['tenthmark'];
    $twthmark = $_POST['twthmark'];
    // if ($twthmarkcat  == 'CGPA'){
    //     $twthmark  = $_POST['twmarkc'];
    // }
    // else{
    //     $twthmark = $_POST['twmarkp']; 
    // }
    $clgname = $_POST['clgname'];
    $uniname = $_POST['uniname'];
    $unimark = $_POST['unimark'];

    if($num > 0){
        $userid = $Userdata['id'];
        $sql = "UPDATE `educationdetails` SET `schoolname` = '$schoolname',`tenthmark` = '$tenthmark',`collegename` ='$clgname',`twthmark`='$twthmark',`universityname`='$uniname',`unicgoa`='$unimark'  WHERE `id` = $userid ";
        $result = mysqli_query($conn, $sql);
   
    if($result){
        
        $dataupdated = true;
        header('location: dashboard.php');
        
    }
}

else{
    $userid =(int)$Userdata['id'] ;
$sql = "INSERT INTO `educationdetails` (`id`,`schoolname`,`tenthmark`,`collegename`,`twthmark`,`universityname`,`unicgoa`) VALUES 
($userid,'$schoolname','$tenthmark','$clgname','$twthmark','$uniname','$unimark')";
$result = mysqli_query($conn, $sql);
if($result){
    $datainserted = true;
    header('location: dashboard.php');
   
}
}

}
?>


 






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Educationals details</title>
	<link rel="stylesheet" type="text/css" href="css/education.css">
	 <meta name='viewport' content='width=device-width, initial-scale=1'>
        
          <script src="https://kit.fontawesome.com/65ace80df2.js" crossorigin="anonymous"></script>

</head>
<body>
	
	<nav id="navbar">
		<ul>
			<li>
				<a href="dashboard.php">Home</a></li>
				<li><a href="userprofile.php">Profile</a></li>
				<li><a href="">Logout</a></li>
		</ul>
	</nav>
	<header>
		<h1>Educational Details</h1>
	</header>
	<div>
		
		<p>Please fill this details</p>

		<hr>
	</div>
	<div class="container">
		 <div class="imgcontainer">
   	 <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
  			</div>
  			<form method="post" action="">
	<div id="container">

		<div>
			<i class="fa fa-school" style="font-size:24px"></i>
			<?php
			if($num > 0){
            echo '<input type="text" class="form-control" id="schoolname" aria-describedby="schoolname" name="schoolname" placeholder="School Name" value ="'.$Userdetails['schoolname'].'" required>';
            }
            else{
                echo '<input type="text" class="form-control" id="schoolname" aria-describedby="schoolname" name="schoolname" placeholder="School Name" required>';    
            }
            ?>
		</div>
		<div>
			<i class="fa fa-percent" style="font-size:24px"></i>
			<?php
			if($num > 0){
            echo '<input type="text" class="form-control" id="tenthmark" aria-describedby="tenthmark" name="tenthmark" placeholder="marks in 10th" value ="'.$Userdetails['tenthmark'].'" required>';
            }else{
                echo '<input type="text" class="form-control" id="tenthmark" aria-describedby="tenthmark" name="tenthmark" placeholder="marks in 10th" required>';
            }?>
		 <!-- <input type="text" id="tenthmark"  name="tenthmark" placeholder="marks in 10th" required></div> -->

		 <div>
		 	<i class="fa fa-university" style="font-size:24px"></i>
			 <?php 
            if($num > 0){

            echo '<input type="text" class="form-control" id="clgname" aria-describedby="clgname" name="clgname" placeholder="College Name" value ="'.$Userdetails['collegename'].'" required>';
            }
            else{
                echo '<input type="text" class="form-control" id="clgname" aria-describedby="clgname" name="clgname" placeholder="College Name" required>';    
            }
           ?>
		</div>

		<div>
			<i class="fa fa-percent" style="font-size:24px"></i>
			<?php 
            if($num > 0){

            echo '<input type="text" class="form-control" id="twmark" aria-describedby="twmark" name="twthmark" placeholder="marks in 12th" value ="'.$Userdetails['twthmark'].'" required>';
            }else{
                echo '<input type="text" class="form-control" id="twmark" aria-describedby="twmark" name="twthmark" placeholder="marks in 12th" required>';
            }?>
		  <!-- <input type="text" id="twmark"  name="twthmark" placeholder="marks in 12th" required> -->
		</div>
		<div>
			<i class="fa fa-university" style="font-size:24px"></i>
			<?php 
            if($num > 0){
            echo '<input type="text" class="form-control" id="uniname" aria-describedby="uniname" name="uniname" placeholder="University Name" value ="'.$Userdetails['universityname'].'" required>';
            }
            else{
                echo '<input type="text" class="form-control" id="uniname" aria-describedby="uniname" name="uniname" placeholder="University Name" required>';  
            }
            ?>
		</div>
		<div>
			<i class="fa fa-percent" style="font-size:24px"></i>
			<?php 
            if($num > 0){
            echo '<input type="text" class="form-control" id="unimark" aria-describedby="unimark" name="unimark" placeholder="University CGPA" value ="'.$Userdetails['unicgoa'].'" required>';
            }
            else{
                echo '<input type="text" class="form-control" id="unimark" aria-describedby="unimark" name="unimark" placeholder="University CGPA" required>';
            }?>
		</div>
		   <button type="submit">Submit</button>

	</div>
</form>

</body>
</html>