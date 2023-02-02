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
if (isset($_POST['capnhatdonhang'])) {
	$xuly = $_POST['xuly'];
	$mahang = $_POST['mahang_xuly'];
	$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
	$sql_update_giaodich = mysqli_query($con, "UPDATE tbl_giaodich SET tinhtrangdon='$xuly' WHERE magiaodich='$mahang'");
}

?>
<?php
if (isset($_GET['xoadonhang'])) {
	$mahang = $_GET['xoadonhang'];
	$sql_delete = mysqli_query($con, "DELETE FROM tbl_donhang WHERE mahang='$mahang'");
	header('Location:xulydonhang.php');
}
if (isset($_GET['xacnhanhuy']) && isset($_GET['mahang'])) {
	$huydon = $_GET['xacnhanhuy'];
	$magiaodich = $_GET['mahang'];
} else {
	$huydon = '';
	$magiaodich = '';
}
$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
$sql_update_giaodich = mysqli_query($con, "UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Đơn hàng</title>
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
    .select-del-hover a{
     color: #8470FF !important;
	}
	.select-del-hover a:hover{
		color: #51B848 !important;
	}
	.User-login a:hover {
		color: #51B848 !important;
	}
	.nav-link:hover {
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
			<p class="User-login" >Admin: <?php echo $_SESSION['dangnhap'] ?> <a href="?login=dangxuat">Đăng xuất</a></p>
		</nav>
	</header>
	<main style="    margin-top: 60px;">
		<div class="container-fluid" >
			<div class="row" style="max-width: 1400px; margin:0 auto">
				<?php
				if (isset($_GET['quanly']) == 'xemdonhang') {
					$mahang = $_GET['mahang'];
					$sql_chitiet = mysqli_query($con, "SELECT * FROM tbl_donhang,tbl_sanpham WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.mahang='$mahang'");
				?>
					<div class="col-md-6" style="    margin-top: 40px;">
						<h4 style="text-align: center; color:#E64419;  font-weight: 700;" >Xem chi tiết đơn hàng</h4>
						<form action="" method="POST" style="text-align: center;">
							<table class="table table-bordered ">
								<tr>
									<th>Thứ tự</th>
									<th>Mã hàng</th>
									<th>Tên sản phẩm</th>
									<th>Số lượng</th>
									<th>Giá</th>
									<th>Tổng tiền</th>
									<th>Ngày đặt</th>
									<!-- <th>Quản lý</th> -->
								</tr>
								<?php
								$i = 0;
								while ($row_donhang = mysqli_fetch_array($sql_chitiet)) {
									$i++;
								?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row_donhang['mahang']; ?></td>

										<td><?php echo $row_donhang['sanpham_name']; ?></td>
										<td><?php echo $row_donhang['soluong']; ?></td>
										<td><?php echo $row_donhang['sanpham_giakhuyenmai']; ?></td>
										<td><?php echo number_format($row_donhang['soluong'] * $row_donhang['sanpham_giakhuyenmai']) . 'đ'; ?></td>

										<td><?php echo $row_donhang['ngaythang'] ?></td>
										<input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>">

									</tr>
								<?php
								}
								?>
							</table>

							<select class="form-control" name="xuly">
								<option value="1">Đã xử lý | Giao hàng</option>
								<option value="0">Chưa xử lý</option>
							</select><br>

							<input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success">
						</form>
					</div>
				<?php
				} else {
				?>

					<!-- <div class="col-md-7">
						<p>Đơn hàng</p>
					</div> -->
				<?php
				}

				?>
				<div class="col-md-6" style="    margin-top: 40px;">
					<h4 style="text-align: center; color: #E64419;  font-weight: 700;">Liệt kê đơn hàng</h4>
					<?php
					$sql_select = mysqli_query($con, "SELECT * FROM tbl_sanpham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang ");
					?>
					<table class="table table-bordered ">
						<tr>
							<th>Thứ tự</th>
							<th>Mã hàng</th>
							<th>Tình trạng đơn hàng</th>
							<th>Tên khách hàng</th>
							<th>Ngày đặt</th>
							<th>Ghi chú</th>
							<th>Hủy đơn</th>
							<th>Quản lý</th>
						</tr>
						<?php
						$i = 0;
						while ($row_donhang = mysqli_fetch_array($sql_select)) {
							$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>

								<td><?php echo $row_donhang['mahang']; ?></td>
								<td><?php
									if ($row_donhang['tinhtrang'] == 0) {
										echo 'Chưa xử lý';
									} else {
										echo 'Đã xử lý';
									}
									?></td>
								<td><?php echo $row_donhang['khachhang_name']; ?></td>

								<td><?php echo $row_donhang['ngaythang'] ?></td>
								<td><?php echo $row_donhang['khachhang_note'] ?></td>
								<td><?php if ($row_donhang['huydon'] == 0) {
									} elseif ($row_donhang['huydon'] == 1) {
										echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang=' . $row_donhang['mahang'] . '&xacnhanhuy=2">Xác nhận hủy đơn</a>';
									} else {
										echo 'Đã hủy';
									}
									?></td>

								<td class="select-del-hover" style="font-size: 18px;"><a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> || <a style=" text-decoration: none;" href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem </a></td>
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