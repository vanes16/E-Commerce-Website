<?php
session_start();

if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
    if($_SESSION['role']=='Admin'){
        
    }   else{
        header('location:index.php');
    }
};
include 'dbconnect.php';

$orderids = $_GET['orderid'];	
$liatcust = mysqli_query($conn,"select * from vmm_sign l, vmm_cart c where orderid='$orderids' and l.userid=c.userid");
$checkdb = mysqli_fetch_array($liatcust);

if(isset($_POST['kirim']))
	{
		$updatestatus = mysqli_query($conn,"update vmm_cart set status='Sent' where orderid='$orderids'");
		$del =  mysqli_query($conn,"delete from vmm_confirmation where orderid='$orderids'");
		
		if($updatestatus&&$del){
			echo " <div class='alert alert-success'>
			<center>Your Order sent</center>
		  </div>
		<meta http-equiv='refresh' content='1; url= admin.php'/>  ";
		} else {
			echo "<div class='alert alert-warning'>
			Error to submit, try again
		  </div>
		 <meta http-equiv='refresh' content='1; url= admin.php'/> ";
		}
		
	};

if(isset($_POST['selesai']))
	{
		$updatestatus = mysqli_query($conn,"update vmm_cart set status='Completed' where orderid='$orderids'");
		
		if($updatestatus){
			echo " <div class='alert alert-success'>
			<center>Transaction Is Finished.</center>
		  </div>
		<meta http-equiv='refresh' content='1; url= admin.php'/>  ";
		} else {
			echo "<div class='alert alert-warning'>
			Error to submit , try again
		  </div>
		 <meta http-equiv='refresh' content='1; url= admin.php'/> ";
		}
		
	};

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <title>Dashboard</title>
	
	<script src="https://kit.fontawesome.com/b4aece989d.js" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Admin Dashboard</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="post">
        <div class="input-group">
          <div class="input-group-append">
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" >Hello , <?php echo"$username"?></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Your Customer Status</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="admin-product-add.php">Add a Product</a>
			<a class="dropdown-item" href="admin-product.php">Product List</a>
			<a class="dropdown-item" href="admin-customer.php">Customer Data</a>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="fas fa-store"></i>
            <span>Back To Store</span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
		



          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Customer Status</div>
            <div class="card-body" id="container">
              <div class="table-responsive">
				<h2>Order Id : <?php echo"$orderids"?></h2>
				<p>Username : <?php echo $checkdb['username']; ?> (<?php echo $checkdb['address']; ?>)</p>
				<p>Order Date : <?php echo $checkdb['orderdate']; ?></p>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Price</th>
                    </tr>
                  </thead>
					<?php
							$no=1;
							$brgs=mysqli_query($conn,"SELECT * from vmm_detailorder d, vmm_product p where orderid='$orderids' and d.idproduct=p.idproduct order by d.idproduct ASC");
							while($p=mysqli_fetch_array($brgs)){
							$orderids = $p['orderid'];
							?>	
                  <tbody>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $p['productname'] ?></td>
					  <td><?php echo $p['qty'] ?></td>
					  <td><?php echo $p['price'] ?></td>
                    </tr>
                  </tbody>
				  	<?php 
							}
					?>
				  <tfoot>
					<tr>
						<td>Total (Include Tax 3%):</td>
						<td>Rp 
				  <?php
					
										$result1 = mysqli_query($conn,"SELECT SUM(qty*price)+SUM(qty*price*3/100) AS count FROM vmm_detailorder d, vmm_product p where d.orderid='$orderids' and p.idproduct=d.idproduct order by d.idproduct ASC");
										$cekrow = mysqli_num_rows($result1);
										$row1 = mysqli_fetch_assoc($result1);
										$count = $row1['count'];
										if($cekrow > 0){
											echo number_format($count);
										} else {
											echo 'No data';
										}
										?>
						</td>
					</tr>
				  </tfoot>
                </table>
				<br>
				<?php
									
									if($checkdb['status']=='Confirmed'){
										$ambilinfo = mysqli_query($conn,"select * from vmm_confirmation where orderid='$orderids'");
										while($tarik=mysqli_fetch_array($ambilinfo)){		
										$met = $tarik['payment'];
										$namarek = $tarik['accountname'];
										$tglb = $tarik['paydate'];
										echo '
										Payment Information
									<div class="data-tables datatable-dark">
									<table  class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Metode</th>
													<th>Pemilik Rekening</th>
													<th>Tanggal Pembayaran</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>'.$met.'</td>
													<td>'.$namarek.'</td>
													<td>'.$tglb.'</td>
												</tr>
											</tbody>
										</table>
									</div>
									<br><br>
									<form method="post">
									<input type="submit" name="kirim" class="form-control btn btn-success" value="Sent" \>
									</form>
									';
									}
									;
									} else {
										echo '
									<form method="post">
									<input type="submit" name="selesai" class="form-control btn btn-success" value="Completed" \>
									</form>
									';
									}
									?>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © 2020 SSIP2021-VMM.</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
	<script src="ast/admin.js"></script>
  </body>

</html>
