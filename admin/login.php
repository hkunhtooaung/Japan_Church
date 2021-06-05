<?php 
session_start();
require "../config/config.php";

if ($_POST) {
	$name = $_POST['name'];
	$password = $_POST['pwd'];

	$stmt = $pdo->prepare("SELECT * FROM admin WHERE username=:username");
	$stmt->bindValue(':username',$name);
	$stmt->execute();
	$admin = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($admin) {
		if (password_verify($password,$admin['password'])) {
			$_SESSION['user_id'] = $admin['id'];
			$_SESSION['username'] = $admin['name'];
			$_SESSION['logged_in'] = time(); 

			header("location: index.php");
		} 
	} else {
		echo "<script>alert('Username or Password is wrong');</script>";
	}
	
}

// error_reporting(1);
// if ($_SESSION['user_id']) {
// 	header("location: index.php");
// }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="icon" href="images/fb.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../dist/index.css">
	<link rel="stylesheet" type="text/css" href="../dist/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../dist/aos.css">
	<script src="dist/jquery.min.js"></script>
	<script src="dist/bootstrap.min.js"></script>

	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.css">
    <!-- Bootstrap core CSS -->
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
	<style type="text/css">
		.container {
			margin-top: 120px; 
			width: 30%;
			background-color: #f4f6f9;
			height: 300px;
			border-radius: 10px;
		}
		.btn {
			margin-bottom: 100px;
		}
		.f-header {
			margin-bottom: 20px;
			margin-top: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1 align="center" class="f-header">Admin Login</h1>
		<form action="" method="POST">
		  	<!-- Email input -->
		  	<div class="form-outline mb-4">
		  		<label class="form-label" for="form1Example1">Username</label>
		    	<input type="text" name="name" id="form1Example1" class="form-control" required />
		  	</div>

		 	<!-- Password input -->
		  	<div class="form-outline mb-4">
		  		<label class="form-label" for="form1Example2">Password</label>
		    	<input type="password" name="pwd" id="form1Example2" class="form-control" required/>
		  	</div>

		  <!-- Submit button -->
		  <button type="submit" class="btn btn-primary btn-block">Sign in</button>
		</form>
	</div>

</body>
</html>