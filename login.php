<?php
session_start();

if(!isset($_SESSION['log'])){
	
} else {
	header('location:index.php');
};

include 'dbconnect.php';


	if(isset($_POST['login']))
	{
	$username = mysqli_real_escape_string($conn,$_POST['username']);
	$pass = mysqli_real_escape_string($conn,$_POST['password']);
	$queryuser = mysqli_query($conn,"SELECT * FROM vmm_sign WHERE username='$username'");
	$finduser = mysqli_fetch_assoc($queryuser);
		
		if( password_verify($pass, $finduser['password']) ) {
			$_SESSION['id'] = $finduser['userid'];
			$_SESSION['role'] = $finduser['role'];
			$_SESSION['phone'] = $finduser['phonenum'];
			$_SESSION['address'] = $finduser['address'];
			$_SESSION['email'] = $finduser['email'];
			$_SESSION['username'] = $finduser['username'];
			$_SESSION['log'] = "Logged";
			echo"
			<meta http-equiv='refresh' content='1; url= index.php'/>  ";
		}
		else {
			echo "<div class='alert-warning'>
			Wrong Username Or Password
		    </div>
			<meta http-equiv='refresh' content='1; url= login.php'/>  ";
		}		
	}
?>

<html>
	<head>
		<link rel="stylesheet" href="./ast/log.css">
		<script src="https://kit.fontawesome.com/b4aece989d.js" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	</head>
	<body>
		<div id="login">
			<div class="login container">
				<div class="box">
					<h1>Login:</h1>
					<form method="post">
						<div class="login-item">
							<input type="text" name="username" required>
							<span></span>
							<label>Username</label>
						</div>
						<div class="login-item">
							<input type="password" name="password" required>
							<span></span>
							<label>Password</label>
						</div>
							<button type="submit" name="login" class="submit"> Login </button>
							<div class="signup_link">
							  You are not a member yet? <a href="sign_up.php">Signup</a>
							</div>
					</form>
				</div>
			</div>
		</div>	
	</body>
</html>