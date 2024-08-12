<?php
include 'dbconnect.php';
$s = $_GET["keyword"];
?>
		<div class="product container">
			<div class="top-content">
				<div class="product-title"><span>O</span>ur <span>P</span>roducts</div>
			</div>
			<div class="bottom-content">
				<?php 
				$brgs=mysqli_query($conn,"SELECT * from vmm_product where productname like '%$s%' or deskripsi like '%$s%' or price like '%$s%' order by idproduct ASC");
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
										<span>Special Offers we have</span>	
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