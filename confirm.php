<?php
session_start();

if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
};

include 'dbconnect.php';

$idorder = $_GET['id'];

if(isset($_POST['confirm']))
	{
		
		$userid = $_SESSION['id'];
		$veriforderid = mysqli_query($conn,"select * from vmm_cart where orderid='$idorder'");
		$fetch = mysqli_fetch_array($veriforderid);
		$liat = mysqli_num_rows($veriforderid);
		
		if($fetch>0){
		$name = $_POST['name'];
		$method = $_POST['method'];
		$date = $_POST['date'];
			  
		$kon = mysqli_query($conn,"insert into vmm_confirmation (orderid, userid, payment, accountname, paydate) 
		values('$idorder','$userid','$method','$name','$date')");
		if ($kon){
		
		$up = mysqli_query($conn,"update vmm_cart set status='Confirmed' where orderid='$idorder'");
		
		echo " <div class='alert-success'>
			Thank you for confirming, our team will verify it.
			Further information will be sent via email
		  </div>
		<meta http-equiv='refresh' content='7; url= index.php'/>  ";
		} else { echo "<div class='alert-warning'>
			
			Failed to Submit, please try again.
		  </div>
		 <meta http-equiv='refresh' content='3; url= confirm.php'/> ";
		}
		} else {
			echo "<div class='alert alert-danger'>
			
			Order code not found, please re-enter correctly
		  </div>
		<meta http-equiv='refresh' content='4; url= confirm.php'/> ";
		}
		
		$uname = $_SESSION['username'];
		$from = "VMMSSIP2021@gmail.com" ;
		$to =  $_SESSION['email'];
		$subject = "Transaction :";
		$msg ="Hello $uname, Thank you for the payment confirmation. We will proccess your payment no later than 1x24 hours. with orderid $idorder";
					
		$headers = "From: $from";
					
		$sent = mail($to,$subject,$msg, $headers);
		
		
	};

?>

<html>
<head>	
	<title>SSIP</title>
	<link rel="stylesheet" href="./ast/index.css">
	<script src="https://kit.fontawesome.com/b4aece989d.js" crossorigin="anonymous"></script>
</head>
<body>
	<!-- Header Section-->
	<div id="header">
		<div class="header container">
			<div class="nav-bar">
				<div class="logo">
					<a href="index.php">SSIP<span>.</span></a>
				</div>
				<div class="nav-list">
					<div class="hamburger"><div class="bar"></div></div>
					<ul class="nav-list-item">
						<?php
						if(!isset($_SESSION['log'])){
							echo '
							<li class="nav-item"><a href="login.php">Login</a></li>
							';
						} else {
							
							if($_SESSION['role']=='Member'){
							echo '
							<li class="nav-item nav-text">Hello, '.$_SESSION["username"].'</li>
							<li class="nav-item"><a href="logout.php">Logout</a></li>
							';
							} else {
							echo '
							<li class="nav-item nav-text">Hello, '.$_SESSION["username"].'</li>
							<li class="nav-item"><a href="admin.php">PANEL</a></li>
							<li class="nav-item"><a href="logout.php">Logout</a></li>
							';
							};
							
						}
						?>
						<li class="nav-item"><a href="index.php">Home</a></li>
						<li class="nav-item"><i class="fas fa-search" id="search"></i></li>
						<li class="search-form">
							<form action="search.php#product" method="post">
								<i class="nav-search2"></i>
								<input type="text" name="search" placeholder="Search here">
								<a class="close1"><i class="fa fa-times"></i></a>
							</form>
						</li>
						<a href ="map.php"><li class="nav-item"><i class="fas fa-map-marker-alt"></i></li></a>
						<a href ="orderlist.php#product"><li class="nav-item"><i class="fas fa-wallet"></i></li></a>
						<a href ="cart.php#product"><li class="nav-item"><i class="fas fa-cart-arrow-down"></i></li></a>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- End Header Section-->
	
	<!-- Home Section -->
	<div id="home">
		<div class="home container">
			<div class="slider">
							<?php 
								$brgs=mysqli_query($conn,"SELECT * from vmm_slider");
								while($p=mysqli_fetch_array($brgs)){
									?>
				
				<div class="myslide fade">
					<div class="txt">
						<h1><?php echo $p['title'] ?></h1>
						<p><?php echo $p['content'] ?></p>
					</div>
					<img src="<?php echo $p['image']?>" style="width: 100%; height: 100%;">
				</div>
				
					<?php }?>
				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="next" onclick="plusSlides(1)">&#10095;</a>
				
			</div>
		</div>
	</div>
	
	<!-- End Home Section -->
	
	<!-- Cart Section-->
	<div id="product">
		<div class="product container">
			<div class="product-title">Confirmation</div>
			<div class="login-form-grids">
				<div class="confirm-text">Order Code</div><br>
				<form method="post">
					<input type="text" name="orderid" class="form-control" value="<?php echo $idorder ?>" disabled><br>
				<br>
				<div class="confirm-text">Payment Information</div><br>
					
					<input type="text" name="name" class="form-control" placeholder="Account Holder Name" required><br>
					<br>
					<div class="confirm-text">Method</div><br>
					<select name="method" class="form-control">
						
						<?php
						$method = mysqli_query($conn,"select * from vmm_payment");
						
						while($a=mysqli_fetch_array($method)){
						?>
							<option value="<?php echo $a['method'] ?>"><?php echo $a['method'] ?> | <?php echo $a['norek'] ?></option>
							<?php
						};
						?>
						
					</select>
					<br><br>
					<div class="confirm-text">Pay Date</div><br>
					<input type="date" class="form-control" name="date">
					<br>
					<br>
					<input type="submit" name="confirm" value="Confirm" class="confirm-submit">
				</form>
			</div>
			<div class="cancel-form">
				<a href="index.php">Cancel</a>
			</div>
		</div>
	</div>
	<!-- End Cart Section-->
	
	<!-- Footer Section -->
	
	<div id="copyright">
		<div class="copyright container">
			<div class="copyright-text">
			  <p>Copyright © 2020 SSIP2021-VMM.</p>
			</div>
		</div>
	</div>
	
	<!-- End Footer Section -->
	<script src="./ast/index.js"></script>
	
</body>
</html>