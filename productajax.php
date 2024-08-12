<?php
include 'dbconnect.php';
$s = $_GET["keyword"];
?>                <table class="table table-bordered table-sortable" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Product Name</th>
                      <th>Image</th>
                      <th>Descriptions</th>
                      <th>Prices</th>
                    </tr>
                  </thead>
					<?php
							$no=1;
							$brgs=mysqli_query($conn,"SELECT * from vmm_product where productname like '%$s%' or deskripsi like '%$s%' or price like '%$s%' order by idproduct ASC");
							while($p=mysqli_fetch_array($brgs)){
							?>	
                  <tbody>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $p['productname'] ?></td>
                      <td><img src="<?php echo $p['image'] ?>"></td>
                      <td><?php echo $p['deskripsi'] ?></td>
					  <td><?php echo $p['price'] ?></td>
                  </tbody>
				  	<?php 
							}
					?>
                </table>
								<style>
					img{
						width:73px;
						height:73px;
					}
				</style>