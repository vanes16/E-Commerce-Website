<?php
session_start();
include 'dbconnect.php';

$s = $_POST['search'];
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
									echo " <div class='alert alert-success'>
								The item has been added to the cart before, the amount will be added
							  </div>
							  <meta http-equiv='refresh' content='1'; url=index.php#product/>";
								} else {
									echo "<div class='alert alert-warning'>
								Failed to add item to cart
							  </div>
							  <meta http-equiv='refresh' content='1'; url= index.php#product/>";
								}
								
							} else {
							
							$tambahdata = mysqli_query($conn,"insert into vmm_detailorder (orderid,idproduct,qty) values('$orid','$idproduct','1')");
							if ($tambahdata){
							echo " <div class='alert alert-success'>
								Success to add item to cart
							  </div>
							<meta http-equiv='refresh' content='1'; url= index.php#product/>  ";
							} else { echo "<div class='alert alert-warning'>
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
							echo " <div class='alert alert-success'>
								Success to add item to cart
							  </div>
							<meta http-equiv='refresh' content='1'; url= index.php#product/>  ";
							} else { echo "<div class='alert alert-warning'>
								Failed to add item to cart
							  </div>
							 <meta http-equiv='refresh' content='1'; url= index.php#product/> ";
							}
						} else {
							echo "Failed to add item to cart";
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
	
	<!-- Product Section-->
	<div id="product">
		<div class="product container">
			<div class="top-content">
				<div class="product-title"><span>O</span>ur <span>P</span>roducts</div>
			</div>
			<div class="bottom-content">
				<?php 
				$brgs=mysqli_query($conn,"SELECT * from vmm_product where productname like '%$s%' or deskripsi like '%$s%' order by idproduct ASC");
				$x = mysqli_num_rows($brgs);
				
				if($x>0){
				while($p=mysqli_fetch_array($brgs)){
				?>
					<div class="product-item">
								<figure>
							<div class="item" >
								<div class="slide-img">
									<img title=" " alt=" " src="<?php echo $p['image']?>" alt="1" />
								</div>
								<div class="overlay">
									<form action="index.php#product" method="post">
										<input type="submit" class="buy-btn" name="addprod" value="Add To Cart"/>
										<input type="hidden" name="idproduct" value="<?php echo $p['idproduct'] ?>" \>
									</form>
								</div>
								<div class="detail-box">
									<div class="type-left">
										<a class="price"><?php echo $p['productname'] ?></a>
										<span>Special Offer</span>	
									</div>
									<div class="type-right">
										<a class="price">Rp. <?php echo number_format($p['price']) ?></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
					<?php
						}
				}
					else {
					echo "<div class='product-title'>
			No data found, try other keywords
		    </div>";
				}
					?>														
			</div>
		</div>
	</div>
	
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
var keyword = document.getElementById('keyword');
var container = document.getElementById('product');

keyword.addEventListener('keyup', function(){

	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			container.innerHTML = xhr.responseText;
		}
	}
	xhr.open('GET','searchajax.php?keyword='+ keyword.value,true)
	xhr.send();
});
	</script>
</body>
</html>