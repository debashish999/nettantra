<?php
session_start();
$row = false;
$num_user = 0;
$num_userdetails = 0;
$num_useraddress = 0;
$num_userpic = 0;
$num_education = 0;
$result = false;
$Userdata = '';
$Userpic = '';
$Userdetails = '';
$Useraddress = '';
$Educationdetails = '';
if(!isset($_SESSION['loggedin']) ||$_SESSION['loggedin']!= true ){
    header('location: login.php');
    exit;
}
else{
include 'connections/connect.php';

$username = $_GET['user'];
 $sql = "SELECT * FROM `users` WHERE (`username` = '$username' OR `email` = '$username')";
 $result = mysqli_query($conn,$sql);
 $num_user = mysqli_num_rows($result);
 $Userdata = mysqli_fetch_assoc($result);
 $userid = $Userdata['id'];

 // userdetails
 $userdetail = "SELECT * FROM `userdetails` WHERE `id` = $userid";
 $userdetailresult = mysqli_query($conn,$userdetail);
 $num_userdetails = mysqli_num_rows($userdetailresult);

 if($num_userdetails > 0 ){
  $Userdetails = mysqli_fetch_assoc($userdetailresult);
}

//  // address details
//  $addressdetail = "SELECT * FROM `addressdetails` WHERE `id` = $userid";
//  $addressdetailresult = mysqli_query($conn,$addressdetail);
//  $num_useraddress = mysqli_num_rows($addressdetailresult);

//  if($num_useraddress > 0 ){
//   $Useraddress = mysqli_fetch_assoc($addressdetailresult);
// }

// education details
$educationdetail = "SELECT * FROM `educationdetails` WHERE `id` = $userid";
$educationdetailresult = mysqli_query($conn,$educationdetail);
$num_education = mysqli_num_rows($educationdetailresult);

 if($num_education > 0 ){
  $Educationdetails = mysqli_fetch_assoc($educationdetailresult);
}

 // user pic
 $profilepic = "SELECT * FROM `profilepic` WHERE `id` = $userid";
 $profilepicresult = mysqli_query($conn,$profilepic);
 $num_userpic = mysqli_num_rows($profilepicresult);

 if($num_userpic > 0 ){

  $Userpicdata= mysqli_fetch_assoc($profilepicresult);
  $Userpic = $Userpicdata['profilepic'];
}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>User profile</title>
	<link rel="stylesheet" type="text/css" href="css/usprofile.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
	<nav id="navbar">
		<div class="nav-container">
		<ul>
			<li>
				<a href="dashboard.php">Home</a></li>
				<li><a href="userprofile.php">Profile</a></li>
          
				<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	</nav>

	<div class="wrapper">
		<div class="box0">
			
                  
                     <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                 
                  
				  <?php
                  if ($Userpic == ''){
                    echo "<img src='https://bootdey.com/img/Content/avatar/avatar7.png' alt='Admin' class='rounded-circle' width='150'>";
                    
                  }else{
                    echo "<img src=images/$Userpic alt='Admin' class='rounded-circle' width='150'>";
                    
                  }
                    
					?>
                 
				 <a href="profilepic.php" style="float: right;">edit</a>
                    
                 
              </div>
          </div>
              </div>
              </div>
              </div>
                </div>
              
		
	</div>
		<div class="box1">
		<h3>personal details<a href="userdetails.php" style="float: right;">edit</a></h3>
		
		<p>Fullname:   <?php 
                    if($num_userdetails > 0){
                   
					echo  $Userdetails['firstname'].' '.$Userdetails['middlename'].' '.$Userdetails['lastname'];
					
					}
					else{
						echo 'update profile';
					}
					 ?>
					</p>

		<p>E-mail:  <?php 
                    if($num_userdetails > 0){
                   
					echo  $Userdata['email'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>

		<p>Mobile:  <?php 
                    if($num_userdetails > 0){
                   
					echo  $Userdetails['phone'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>

		<p>Date of birth:  <?php 
                    if($num_userdetails > 0){
                   
					echo  $Userdetails['dob'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>

		<p>gender:  <?php 
                    if($num_userdetails > 0){
                   
					echo  $Userdetails['gender'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>
		
	</div>
	
	<div class="box3">
		<h3>Education details <a href="educationdetails.php" style="float: right;">edit</a></h3>
		<p>school name :
		<?php 
                    if($num_education > 0){
                   
					echo $Educationdetails['schoolname'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>
		</p>
		<p>percentage :
		<?php 
                    if($num_education > 0){
                   
					echo  $Educationdetails['tenthmark'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>
		</p>
		<p>College name :
		<?php 
                    if($num_education > 0){
                   
					echo  $Educationdetails['collegename'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>
		</p>
		<p>percentage :
		<?php 
                    if($num_education > 0){
                   
					echo  $Educationdetails['twthmark'];
					
					}
					else{
						echo 'update profile';
					}
					 ?></p>
		</p>
		<p>University name :
		<?php 
                    if($num_education > 0){
                   
					echo  $Educationdetails['universityname'];
					
					}
					else{
						echo 'update profile';
					}
					 ?>
		</p>
		<p>cgpa :
		<?php 
                    if($num_education > 0){
                   
					echo  $Educationdetails['unicgoa'];
					
					}
					else{
						echo 'update profile';
					}
					 ?>
		</p>
	</div>
	

	</div>
</div>


 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>