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
	$itungtrans = mysqli_query($conn,"select count(detailid) as jumlahtrans from vmm_detailorder where orderid='$orderidd'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
if(isset($_POST["checkout"])){
	
	$q3 = mysqli_query($conn, "update vmm_cart set status='Payment' where orderid='$orderidd'");
	if($q3){
		echo "<div class='alert-success'>
		Checkout Successful
		</div>
		<meta http-equiv='refresh' content='1; url= orderlist.php'/>";
	} else {
		echo "<div class='alert-warning'>
		checkout Failed
		</div>
		<meta http-equiv='refresh' content='1; url= orderlist.php'/>";
	}
} else {
	
}
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
				<div class="product-title">You have bought : <span><?php echo $itungtrans3 ?> Products</span></div>
			</div>
			<div class="cart-content">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>	
							<th>Product</th>
							<th>Product Name</th>
							<th>Quantity</th>
							
						
							<th>Unit Price</th>
						</tr>
					</thead>
					
					<?php 
						$brg=mysqli_query($conn,"SELECT * from vmm_detailorder d, vmm_product p where orderid='$orderidd' and d.idproduct=p.idproduct order by d.idproduct ASC");
						$no=1;
						while($b=mysqli_fetch_array($brg)){

					?>
					<tr class="rem1"><form method="post">
						<td class="invert"><?php echo $no++ ?></td>
						<td class="invert"><img src="<?php echo $b['image'] ?>" width="100px" height="100px" /></td>
						<td class="invert"><?php echo $b['productname'] ?></td>
						<td class="invert">
							 <div class="quantity">                     
								<input type="number" name="jumlah" class="form-control" height="150px" value="<?php echo $b['qty'] ?>" \>
								<input type="hidden" name="idproduknya" value="<?php echo $b['idproduct'] ?>" \>								
							</div>
						</td>
				
						<td class="invert">Rp<?php echo number_format($b['price']) ?></td>
					</tr>
					<?php
						}
					?>
				
				</table>
			</div>
			<div class="checkout-content">	
				<div class="checkout-left-basket">
					<h4>Total Price</h4>
					<ul>
						<?php 
						$brg=mysqli_query($conn,"SELECT * from vmm_detailorder d, vmm_product p where orderid='$orderidd' and d.idproduct=p.idproduct order by d.idproduct ASC");
						$no=1;
						$subtotal = 0;
						$tax = 0;
						while($b=mysqli_fetch_array($brg)){
						
						$hrg = $b['price'];
						$qtyy = $b['qty'];
						$totalharga = $hrg * $qtyy;
						$tax = $totalharga * 3 /100 ;
						$subtotal += $totalharga + $tax ;
						
						}
						?>
						<li>Total  <span>Rp<?php echo number_format($subtotal) ?></span></li>
					</ul>
					<h4>Your Code ID</h4>
					<h1><input type="text" value="<?php echo $orderidd ?>"disabled/></h1>
				</div>
			</div>
			
			<br>
			<br>
			<center>
			<h2>When you have made a payment, please confirm your payment.</h2>
			<br>
			
			
			<?php 
			$method = mysqli_query($conn,"select * from vmm_payment");
			
			while($p=mysqli_fetch_array($method)){
				
			?>
			
			<img src="<?php echo $p['logo'] ?>" width="300px" height="200px"><br>
			<h4><?php echo $p['method'] ?> - <?php echo $p['norek'] ?><br>
			a/n. <?php echo $p['an'] ?></h4><br>
			<br>
			<hr>
			
			<?php
			}
		?>
		
			<br>
			<br>
			<p>Your order will be processed immediately 1x24 hours after you make your payment to our ATM and include personal information making the payment such as the name of the account holder / source of funds, payment date, payment method and amount paid..</p>
      
			<br>
			<form method="post">
				<input type="submit" class="form-control checkout-btn" name="checkout" value="I Agree and Check Out" \>
			</form>
		
			</center>
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