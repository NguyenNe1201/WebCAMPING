<?php
include('../connect.php');
?>
<?php
session_start();
if (!isset($_SESSION['dangnhap'])) {
	header('Location: index.php');
}
if (isset($_GET['login'])) {
	$dangxuat = $_GET['login'];
} else {
	$dangxuat = '';
}
if ($dangxuat == 'dangxuat') {
	session_destroy();
	header('Location: index.php');
}
?>
<?php
if (isset($_POST['themdanhmuc'])) {
	$tendanhmuc = $_POST['danhmuc'];
	$sql_insert = mysqli_query($con, "INSERT INTO tbl_danhmucsanpham(danhmucsanpham_name) values ('$tendanhmuc')");
} elseif (isset($_POST['capnhatdanhmuc'])) {
	$id_post = $_POST['id_danhmuc'];
	$tendanhmuc = $_POST['danhmuc'];
	$sql_update = mysqli_query($con, "UPDATE tbl_danhmucsanpham SET danhmucsanpham_name='$tendanhmuc' WHERE danhmucsanpham_id='$id_post'");
	header('Location:xulydanhmuc.php');
}
if (isset($_GET['xoa'])) {
	$id = $_GET['xoa'];
	$sql_xoa = mysqli_query($con, "DELETE FROM tbl_danhmucsanpham WHERE danhmucsanpham_id='$id'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Danh mục</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<style>
		header {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			z-index: 1;
			background: #fff;

		}

		a {
			color: #212529 !important;
			text-decoration: none !important;

		}

		.nav-item {
			font-size: 16px;
			font-weight: bolder;
		}

		.User-login {
			margin-right: 100px;
			font-size: 18px;
			font-weight: 600;
			align-items: center;
			margin-bottom: 0px !important;
			cursor: pointer;
			color: #E64419;
		}

		.User-login a:hover {
			color: #51B848 !important;
		}

		.nav-link:hover {
			color: #51B848 !important;
		}

		.select-del-hover a {
			color: #8470FF !important;
			font-size: 18px;
		}

		.select-del-hover a:hover {
			color: #51B848 !important;
		}
	</style>
</head>

<body>
	<!-- header admin -->
	<header>
		<nav class="navbar navbar-expand-lg " style="background-color: white !important;">
			<div class="container-fluid">
				<a class="navbar-brand" href="../admin/dashboard.php"><img style="width: 85px;" src="../img/logosmall11.png" alt=""></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav nav-menu">
						<li class="nav-item">
							<a class="nav-link" href="xulydonhang.php">ĐƠN HÀNG </a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="xulydanhmuc.php">DANH MỤC</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="xulybaiviet.php">BÀI VIẾT</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="xulysanpham.php">SẢN PHẨM</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="xulykhachhang.php">KHÁCH HÀNG</a>
						</li>
					</ul>
				</div>
			</div>
			<p class="User-login">Admin: <?php echo $_SESSION['dangnhap'] ?> <a href="?login=dangxuat">Đăng xuất</a></p>
		</nav>
	</header>
	<!--  -->
	<div class="container" style="margin-top: 85px;">
		<div class="row">
			<?php
			if (isset($_GET['quanly']) == 'capnhat') {
				$id_capnhat = $_GET['id'];
				$sql_capnhat = mysqli_query($con, "SELECT * FROM tbl_danhmucsanpham WHERE danhmucsanpham_id='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
			?>
				<div class="col-md-4">
					<h4 style="text-align: center; color: #E64419; font-size: 30px; padding: 10px; ">Cập nhật danh mục</h4>
					<label style="font-size: 18px;">Tên danh mục</label>
					<form action="" method="POST" style="text-align: center;">
						<input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['danhmucsanpham_name'] ?>"><br>
						<input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['danhmucsanpham_id'] ?>">

						<input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" class="btn btn-success">
					</form>
				</div>
			<?php
			} else {
			?>
				<div class="col-md-4">
					<h4 style="text-align: center; color: #E64419; font-size: 30px; padding: 10px; ">Thêm danh mục</h4>
					<label style="font-size: 18px;">Tên danh mục</label>
					<form action="" method="POST" style="text-align: center;">
						<input type="text" class="form-control" name="danhmuc" placeholder="Tên danh mục"><br>
						<input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-success">
					</form>
				</div>
			<?php } ?>
			<div class="col-md-8">
				<h4 style="text-align: center; color: #E64419; font-size: 30px; padding: 10px; ">Liệt kê danh mục</h4>
				<?php
				$sql_select = mysqli_query($con, "SELECT * FROM tbl_danhmucsanpham ORDER BY danhmucsanpham_id ASC ");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên danh mục</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_category = mysqli_fetch_array($sql_select)) {
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_category['danhmucsanpham_name'] ?></td>
							<td class="select-del-hover"><a href="?xoa=<?php echo $row_category['danhmucsanpham_id'] ?>">Xóa</a> || <a href="?quanly=capnhat&id=<?php echo $row_category['danhmucsanpham_id'] ?>">Cập nhật</a></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>