<?php
session_start();

if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
};
include 'dbconnect.php';


    $uid = $_SESSION['id'];
	$caricart = mysqli_query($conn,"select * from vmm_cart where userid='$uid' and status='Cart'");
	$fetc = mysqli_fetch_array($caricart);
	$orderidd = $fetc['orderid'];
	$itungtrans = mysqli_query($conn,"select count(orderid) as jumlahtrans from vmm_cart where userid='$uid' and status!='Cart'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	

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
		<div class="container product">
			<div class="top-content">
				<div class="product-title">There are: <span><?php echo $itungtrans3 ?> Transactions</span></div>
			</div>
			<div class="cart-content">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>	
							<th>Your Order Code</th>
							<th>Date</th>
							<th>Totals</th>				
							<th>Status</th>
						</tr>
					</thead>
					
					<?php 
						$brg=mysqli_query($conn,"SELECT DISTINCT(idcart), c.orderid, orderdate, status from vmm_cart c, vmm_detailorder d where c.userid='$uid' and d.orderid=c.orderid and status!='Cart' order by orderdate DESC");
						$no=1;
						while($b=mysqli_fetch_array($brg)){

					?>
					<tr class="rem1"><form method="post">
						<td class="invert"><?php echo $no++ ?></td>
						<td class="invert"><?php echo $b['orderid'] ?></td>
						<td class="invert"><?php echo $b['orderdate'] ?></td>
						<td class="invert">
						Rp<?php
								$ordid = $b['orderid'];
								$result1 = mysqli_query($conn,"SELECT SUM(qty*price)+SUM(qty*price*3/100) AS count FROM vmm_detailorder d, vmm_product p where d.orderid='$ordid' and p.idproduct=d.idproduct order by d.idproduct ASC");
								$cekrow = mysqli_num_rows($result1);
								$row1 = mysqli_fetch_assoc($result1);
								$count = $row1['count'];
								if($cekrow > 0){
									echo number_format($count);
									} else {
										echo 'No data';
									}?>
						</td>
						<td class="invert">
							<div class="rem">
								<?php
								if($b['status']=='Payment'){
								echo '
								<a href="confirm.php?id='.$b['orderid'].'" class="btn-primary">
								Confirm Payment
								</a>
								';}
								else if($b['status']=='Processed'){
								echo 'Order Processed(Payment Accepted)';
								}
								else if($b['status']=='Sent'){
									echo 'Order Sent';
								} else if($b['status']=='Completed'){
									echo 'Order Completed';
								} else if($b['status']=='Canceled'){
									echo 'Order Canceled';
								} else {
									echo 'Confirmation Received';
								}
								
								?>
							</form>
							</div>
						</td>
					</tr>
					<?php
						}
					?>
				
				</table>
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