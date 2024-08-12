<?php
session_start();

if(!isset($_SESSION['log'])){
	
} else {
	header('location:index.php');
};

include 'dbconnect.php';

if(isset($_POST['adduser']))
	{
		$phonenum = $_POST['phonenum'];
		$address = $_POST['address'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
			  
		$tambahuser = mysqli_query($conn,"INSERT INTO vmm_sign (username, password, phonenum, address,email) 
		values('$username','$pass','$phonenum','$address','$email')");
		if ($tambahuser){
			echo "<div class='alert-success'>
			Successful Registration
		    </div>
			<meta http-equiv='refresh' content='1; url= login.php'/>  ";
		} else {	
			echo "<div class='alert-warning'>
			Registration Failed
		    </div>
			<meta http-equiv='refresh' content='1; url= signup.php'/>  ";
		}
		
	};

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
					<h1>Register Here</h1>
					<form method="post">
						<div class="login-item">
							<input type="text" name="phonenum" required maxlength="13">
							<span></span>
							<label>Telegram ID</label>
						</div>
						<div class="login-item">
							<input type="email" name="email" required>
							<span></span>
							<label>Email</label>
						</div>
						<div class="login-item">
							<input type="text" name="address" required>
							<span></span>
							<label>Address</label>
						</div>
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
                            <div class="signup_link">
							<input type="submit" name="adduser" class="submit">
							</div>
					</form>
				</div>
			</div>
		</div>	
	</body>
</html>