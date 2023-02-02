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
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Khách hàng</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
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
		color: #E64419;
		cursor: pointer;
	}

	.User-login a:hover {
		color: #51B848 !important;
	}

	.nav-link:hover {
		color: #51B848 !important;
	}
	.select-del-hover a{
     color: #8470FF !important;
	 font-size: 18px;
	}
	.select-del-hover a:hover{
		color: #51B848 !important;
	}
</style>

<body>
	<header>
		<nav class="navbar navbar-expand-lg " style="background-color: white !important;">
			<div class="container-fluid">
				<a class="navbar-brand" href="../admin/dashboard.php"><img style="width: 85px;" src="../img/logosmall.jpg" alt=""></a>
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
	<main style="margin-top: 90px;">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<h4 style="text-align: center; padding: 15px 0; font-weight: 700; color:#E64419 ">Quản Lý Khách Hàng</h4>
					<?php
					$sql_select_khachhang = mysqli_query($con, "SELECT * FROM tbl_khachhang,tbl_giaodich WHERE tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhang.khachhang_id DESC");
					?>
					<table class="table table-bordered ">
						<tr>
							<th>Thứ tự</th>
							<th>Tên khách hàng</th>
							<th>Số điện thoại</th>
							<th>Địa chỉ</th>
							<th>Email</th>
							<th>Ngày mua</th>
							<th>Quản lý</th>
						</tr>
						<?php
						$i = 0;
						while ($row_khachhang = mysqli_fetch_array($sql_select_khachhang)) {
							$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>

								<td><?php echo $row_khachhang['khachhang_name']; ?></td>
								<td><?php echo $row_khachhang['khachhang_phone']; ?></td>
								<td><?php echo $row_khachhang['khachhang_address']; ?></td>

								<td><?php echo $row_khachhang['khachhang_email'] ?></td>
								<td><?php echo $row_khachhang['ngaythang'] ?></td>
								<td class="select-del-hover"><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>">Xem giao dịch</a></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
				<div class="col-md-12" style="margin-bottom: 30px;">
					<h4 style="text-align: center; padding: 15px 0; font-weight: 700; color: #E64419;  ">Liệt kê lịch sử đơn hàng</h4>
					<?php
					if (isset($_GET['khachhang'])) {
						$magiaodich = $_GET['khachhang'];
					} else {
						$magiaodich = '';
					}
					$sql_select = mysqli_query($con, "SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC");
					?>
					<table class="table table-bordered ">
						<tr>
							<th>Thứ tự</th>
							<th>Mã giao dịch</th>
							<th>Tên sản phẩm</th>
							<th>Ngày đặt</th>

						</tr>
						<?php
						$i = 0;
						while ($row_donhang = mysqli_fetch_array($sql_select)) {
							$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>

								<td><?php echo $row_donhang['magiaodich']; ?></td>

								<td><?php echo $row_donhang['sanpham_name']; ?></td>

								<td><?php echo $row_donhang['ngaythang'] ?></td>


							</tr>
						<?php
						}
						?>
					</table>
				</div>

			</div>
		</div>
	</main>

</body>

</html>