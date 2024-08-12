<?php
include 'dbconnect.php';
$s = $_GET["keyword"];
?>   
                <table class="table table-bordered table-sortable" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>User Name</th>
                      <th>Telegram ID</th>
                      <th>Address</th>
                      <th>Email</th>
					  <th>Join Date</th>
                    </tr>
                  </thead>
					<?php
							$no=1;
							$brgs=mysqli_query($conn,"SELECT * from vmm_sign where username like '%$s%' or email like '%$s%' or phonenum like '%$s%' or address like '%$s%'order by userid ASC");
							while($p=mysqli_fetch_array($brgs)){
							?>	
                  <tbody>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $p['username'] ?></td>
                      <td><?php echo $p['phonenum'] ?></td>
                      <td><?php echo $p['address'] ?></td>
					  <td><?php echo $p['email'] ?></td>
					  <td><?php echo $p['joindate'] ?></td>
                  </tbody>
				  	<?php 
							}
					?>
                </table>