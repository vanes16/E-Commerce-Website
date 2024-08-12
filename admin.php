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

$itungcust = mysqli_query($conn,"select count(userid) as jumlahcust from vmm_sign where role='Member'");
$itungcust2 = mysqli_fetch_assoc($itungcust);
$itungcust3 = $itungcust2['jumlahcust'];
	
$itungorder = mysqli_query($conn,"select count(idcart) as jumlahorder from vmm_cart where status!= 'Selesai' and status!='Canceled'");
$itungorder2 = mysqli_fetch_assoc($itungorder);
$itungorder3 = $itungorder2['jumlahorder'];
	
$username = $_SESSION['username'];



?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <title>Dashboard</title>
	
	<script src="https://kit.fontawesome.com/b4aece989d.js" crossorigin="anonymous"></script>
	<link href="ast/admin.css" rel="stylesheet">
    <!-- Bootstrap core CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Page level plugin CSS -->
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
          <input type="text" class="form-control" placeholder="Search Data" id="keyword">
		  <input type="hidden" id="search">
          <div class="input-group-append">
            <div class="btn btn-primary">
              <i class="fas fa-search"></i>
            </div>
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
            <span>Customer Status</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="admin-product-add.php">Add Product</a>
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
		
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">Total Customer</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left"><?php echo"$itungcust3"?></span>
                  <span class="float-right">
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">test</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">test</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">Total Order</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left"><?php echo"$itungorder3"?></span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">13 New Tickets!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>


          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Customer Status</div>
            <div class="card-body" id="container">
              <div class="table-responsive">
                <table class="table table-bordered table-sortable" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Order</th>
                      <th>Name</th>
                      <th>Order Date</th>
                      <th>Total</th>
                      <th>Status</th>
                    </tr>
                  </thead>
					<?php
							$no=1;
							$brgs=mysqli_query($conn,"SELECT * from vmm_cart c, vmm_sign l where c.userid=l.userid and status!='Cart' and status!='Completed' order by idcart ASC");
							while($p=mysqli_fetch_array($brgs)){
							$orderids = $p['orderid'];
							?>	
                  <tbody>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><a href="order.php?orderid=<?php echo $p['orderid'] ?>"><?php echo $p['orderid'] ?></a></td>
                      <td><?php echo $p['username'] ?></td>
                      <td><?php echo $p['orderdate'] ?></td>
                      <td>								Rp<?php
										$ordid = $p['orderid'];
										$result1 = mysqli_query($conn,"SELECT SUM(qty*price)+SUM(qty*price*3/100) AS count FROM vmm_detailorder d, vmm_product p where d.orderid='$ordid' and p.idproduct=d.idproduct order by d.idproduct ASC");
										$cekrow = mysqli_num_rows($result1);
										$row1 = mysqli_fetch_assoc($result1);
										$count = $row1['count'];
										if($cekrow > 0){
											echo number_format($count);
											} else {
										echo 'No data';
									}?></td>
                      <td>								<?php 
										$orders = $p['orderid'];
										$cekkonfirmasi = mysqli_query($conn,"select * from vmm_confirmation where orderid='$orders'");
										$cekroww = mysqli_num_rows($cekkonfirmasi);
														
										if($cekroww > 0){
											echo 'Confirmed';
										} else {
										if($p['status']!='Sent'){
											echo "Waiting For Confirmation";
											} else {
												echo "Order Sent";
											};
										}
									?></td>
                    </tr>
                  </tbody>
				  	<?php 
							}
					?>
                </table>
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
	<script type="text/javascript">
var keyword = document.getElementById('keyword');
var container = document.getElementById('container');

keyword.addEventListener('keyup', function(){

	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			container.innerHTML = xhr.responseText;
		}
	}
	xhr.open('GET','ajax.php?keyword='+ keyword.value,true)
	xhr.send();
});
	</script>
	<script src="ast/admin.js"></script>
  </body>

</html>
