<?php
session_start();
include 'dbconnect.php';


if(isset($_POST['addprod'])){
	if(!isset($_SESSION['log']))
		{	
			header('location:login.php');
		} else {
				$idproduct = $_POST['idproduct'];
				$ui = $_SESSION['id'];
				$cek = mysqli_query($conn,"select * from vmm_cart where userid='$ui' and status='Cart'");
				$liat = mysqli_num_rows($cek);
				$f = mysqli_fetch_array($cek);
				$orid = $f['orderid'];
				
				//kalo ternyata udeh ada order id nya
				if($liat>0){
							
							//cek barang serupa
							$cekbrg = mysqli_query($conn,"select * from vmm_detailorder where idproduct='$idproduct' and orderid='$orid'");
							$liatlg = mysqli_num_rows($cekbrg);
							$brpbanyak = mysqli_fetch_array($cekbrg);
							$jmlh = $brpbanyak['qty'];
							
							//kalo ternyata barangnya ud ada
							if($liatlg>0){
								$i=1;
								$baru = $jmlh + $i;
								
								$updateaja = mysqli_query($conn,"update vmm_detailorder set qty='$baru' where orderid='$orid' and idproduct='$idproduct'");
								
								if($updateaja){
									echo " <div class='alert-success'>
								The item has been added to the cart before, the amount will be added
							  </div>
							  <meta http-equiv='refresh' content='1'; url=index.php#product/>";
								} else {
									echo "<div class='alert-warning'>
								Failed to add item to cart
							  </div>
							  <meta http-equiv='refresh' content='1'; url= index.php#product/>";
								}
								
							} else {
							
							$tambahdata = mysqli_query($conn,"insert into vmm_detailorder (orderid,idproduct,qty) values('$orid','$idproduct','1')");
							if ($tambahdata){
							echo " <div class='alert-success'>
								Success to add item to cart
							  </div>
							<meta http-equiv='refresh' content='1'; url= index.php#product/>  ";
							} else { echo "<div class='alert-warning'>
								Failed to add item to cart
							  </div>
							 <meta http-equiv='refresh' content='1'; url= index.php#product/> ";
							}
							};
				} else {
					
					//kalo belom ada order id nya
						$oi = crypt(rand(22,999),time());
						
						$bikincart = mysqli_query($conn,"insert into vmm_cart (orderid, userid) values('$oi','$ui')");
						
						if($bikincart){
							$tambahuser = mysqli_query($conn,"insert into vmm_detailorder (orderid,idproduct,qty) values('$oi','$idproduct','1')");
							if ($tambahuser){
							echo " <div class='alert-success'>
								Success to add item to cart
							  </div>
							  ";
							} else { echo "<div class='alert-warning'>
								Failed to add item to cart
							  </div>
							 ";
							}
						} else {
							echo "Failed to make a cart";
						}
				}
		}
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
								<input type="text" name="search" placeholder="Search here" id="keyword">
								<a class="close1"><i class="fa fa-times"></i></a>
							</form>
						</li>
						<a href ="map.php"><li class="nav-item"><i class="fas fa-map-marker-alt"></i></li></a>
						<a href ="orderlist.php#product"><li class="nav-item"><i class="fas fa-wallet"></i></li></a>
						<a href ="cart.php"><li class="nav-item"><i class="fas fa-cart-arrow-down"></i></li></a>
						
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
	
	<!-- Product Section-->
	<div id="product">
		<div class="product container">
			<div class="top-content">
				<div class="product-title"><span>O</span>ur <span>L</span>ocation</div>
			</div>
			<div class="bottom-content">	
				<div id="map"></div>
			</div>
		</div>
	</div>
	    <style>
        #map {
            height: 600px;
            width: 800px;
           }
    </style>
	<!-- End Product Section-->
	
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
	<script>
            function initMap() {
            const uluru = { lat: -6.1751843971945775, lng: 106.8271527971587 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: uluru,
            });
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
            }
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8aDkZmQJObbA2Beci22SCGx5oex6TEF4&callback=initMap">
	</script>
</body>
</html>