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
$username = $_SESSION['username'];

	if(isset($_POST["submit"])) {
		$productname=$_POST['productname'];
		$msg=$_POST['msg'];
		$price=$_POST['price'];
		
		$nama_file = $_FILES['uploadimage']['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$random = crypt($nama_file, time());
		$ukuran_file = $_FILES['uploadimage']['size'];
		$tipe_file = $_FILES['uploadimage']['type'];
		$tmp_file = $_FILES['uploadimage']['tmp_name'];
		$pathdb = "img/".$random.'.'.$ext;


		if($tipe_file == "image/png" || $tipe_file == "image/jpg" || $tipe_file == "image/jpeg" ){
			if($ukuran_file <= 40000){ 
				if(move_uploaded_file($tmp_file, $pathdb)){ 
				
				$sql = mysqli_query($conn,"INSERT INTO vmm_product (productname, image, deskripsi, price) 
				values('$productname','$pathdb','$msg','$price')");
				if($sql){ 		

					echo "<div class='alert-success'>
				Successful To Add Product
				</div>
				<meta http-equiv='refresh' content='1; url= admin.php'/>  ";
				  }else{
					echo "<div class='alert-warning'>
				Fail To Add Product
				</div>
				<meta http-equiv='refresh' content='1; url= admin-product-add.php'/>  ";
				  }
				}else{
				  // Jika gambar gagal diupload
				  echo "<div class='alert-warning'>Sorry, there's a problem while uploading the file.</div>";
				  echo "<br><meta http-equiv='refresh' content='5; URL=admin-product-add.php'> You will be redirected to the form in 5 seconds";
				}
			  }else{
				// Jika ukuran file lebih dari 40kb
				echo "<div class='alert-warning'>Sorry, the file size is not allowed to more than 40kb </div>";
				echo "<br><meta http-equiv='refresh' content='5; URL=admin-product-add.php'> You will be redirected to the form in 5 seconds";
			  }
			}else{
			  // Jika tipe file yang diupload bukan PNG , JPG ,JPEG
			  echo "<div class='alert-warning'>Sorry, the image format should be PNG , JPG , And JPEG.</div>";
			  echo "<br><meta http-equiv='refresh' content='5; URL=admin-product-add.php'> You will be redirected to the form in 5 seconds";
			}
	
	};


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <title>Dashboard</title>
	
	<script src="https://kit.fontawesome.com/b4aece989d.js" crossorigin="anonymous"></script>

	<link href="ast/form.css" rel="stylesheet">
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



          <!-- DataTables Example -->
		<div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-plus"></i>
              Add Product
			</div>
			<div class="card-body" id="container">
				<div class="table-responsive">
					<form method="post" enctype="multipart/form-data">
						<div class="login-form-grids">	
							<div class="login-item">
							
							<div class="confirm-text">Product Name : </div>
								<input name="productname" type="text" class="form-control"required><br>
							</div>
							<div class="login-item">
								<input name="uploadimage" type="file"><br>
							</div>
							<div class="login-item">
								<br><div class="confirm-text">Description : </div>
								<textarea name="msg" type="text" class="form-control" required></textarea><br>
							</div><div class="login-item">
								<div class="confirm-text">Price : </div>
								<input name="price" type="number" class="form-control" required><br><br>
							</div>

							<div>
								<input name="submit" type="submit" value="Submit" class="form-control" class="submit">
							</div>
						</div>
					</form>
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
