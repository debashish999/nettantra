<?php
session_start();
$row = false;
$num = 0;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header('location: login.php');
  exit;
} else {
  include 'connections/connect.php';
  $sql = "SELECT * FROM `users`";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <!--Custom styles-->
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/dash.css">
	 <meta name='viewport' content='width=device-width, initial-scale=1'>
        
          <script src="https://kit.fontawesome.com/65ace80df2.js" crossorigin="anonymous"></script>
</head>
<body>
	<header id="main-header">
		
			<h1>Nettantra</h1>
		
	</header>
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
  <p>List of the Users</p>

	<div>
			<!-- Table of users registered -->
        <table class="table">
		      
          <thead>
            <tr>
              <th scope="col">Sl no.</th> 
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">View</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>

		  <?php
            if ($num > 0) {
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {

                echo '<tr>';
                echo "<th scope='row'>" . $no . "</th>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . "<a href='viewprofile.php?user=" . $row['username'] . "' class='btn btn-primary'>View</a>" . "</td>";
                echo "<td>" . "<a href='edituser.php?user=" . $row['username'] . "' class='btn btn-primary'><i class='fas fa-edit'></i>" . "</td>";
                echo "<td>" . "<a href='userdelete.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></a>" . "</td>";
                echo '</tr>';
                $no = $no + 1;
              }
            } else {
              echo 'No user registered';
            }
            ?>
        
          	          </tbody>
        </table>
	</div>
			
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>