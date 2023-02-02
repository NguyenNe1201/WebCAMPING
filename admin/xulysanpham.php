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
if (isset($_POST['themsanpham'])) {
	$tensanpham = $_POST['tensanpham'];
	$hinhanh = $_FILES['hinhanh']['name'];
	$sphot = $_POST['sp_hot'];
	$soluong = $_POST['soluong'];
	$gia = $_POST['giasanpham'];
	$giakhuyenmai = $_POST['giakhuyenmai'];
	$danhmuc = $_POST['danhmuc'];
	$chitiet = $_POST['chitiet'];
	$mota = $_POST['mota'];
	$path = '../img/';

	$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
	$sql_insert_product = mysqli_query($con, "INSERT INTO tbl_sanpham(sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_hot,sanpham_soluong,sanpham_image,danhmucsanpham_id) values ('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$sp_hot','$soluong','$hinhanh','$danhmuc')");
	move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
} elseif (isset($_POST['capnhatsanpham'])) {
	$id_update = $_POST['id_update'];
	$tensanpham = $_POST['tensanpham'];
	$hinhanh = $_FILES['hinhanh']['name'];
	$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
	$sphot = $_POST['sp_hot'];
	$soluong = $_POST['soluong'];
	$gia = $_POST['giasanpham'];
	$giakhuyenmai = $_POST['giakhuyenmai'];
	$danhmuc = $_POST['danhmuc'];
	$chitiet = $_POST['chitiet'];
	$mota = $_POST['mota'];
	$path = '../img/';
	if ($hinhanh == '') {
		$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_hot='$sphot',sanpham_soluong='$soluong',danhmucsanpham_id='$danhmuc' WHERE sanpham_id='$id_update'";
	} else {
		move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
		$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_hot='$sphot',sanpham_soluong='$soluong',sanpham_image='$hinhanh',danhmucsanpham_id='$danhmuc' WHERE sanpham_id='$id_update'";
	}
	mysqli_query($con, $sql_update_image);
}

?>
<?php
if (isset($_GET['xoa'])) {
	$id = $_GET['xoa'];
	$sql_xoa = mysqli_query($con, "DELETE FROM tbl_sanpham WHERE sanpham_id='$id'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Sản phẩm</title>
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
	.text-cnsp label{
      font-size: 19px;
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
		<div class="container" style="max-width: 1400px; ">
			<div class="row">
				<?php
				if (isset($_GET['quanly']) == 'capnhat') {
					$id_capnhat = $_GET['capnhat_id'];
					$sql_capnhat = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE sanpham_id='$id_capnhat'");
					$row_capnhat = mysqli_fetch_array($sql_capnhat);
					$id_category_1 = $row_capnhat['danhmucsanpham_id'];
				?>
					<div class="col-md-4">
						<h4 style="text-align: center; color: #E64419; font-size: 30px; padding: 10px; ">Cập nhật sản phẩm</h4>
						<form action="" method="POST" enctype="multipart/form-data" class="text-cnsp" style="">
							<label>Tên sản phẩm</label>
							<input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"><br>
							<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>">
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<img src="../img/<?php echo $row_capnhat['sanpham_image'] ?>" height="80" width="80"><br>
							<label>Giá</label>
							<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['sanpham_gia'] ?>"><br>
							<label>Giá khuyến mãi</label>
							<input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>"><br>
							<label>Sản phẩm hot</label>
							<input type="text" class="form-control" name="sp_hot" value="<?php echo $row_capnhat['sanpham_hot'] ?>"><br>
							<label>Số lượng</label>
							<input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br>
							<label>Mô tả</label>
							<textarea class="form-control" rows="10" name="mota"><?php echo $row_capnhat['sanpham_mota'] ?></textarea><br>
							<label>Mô tả chi tiết</label>
							<textarea class="form-control" rows="10" name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea><br>
							<label>Danh mục</label>
							<?php
							$sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_danhmucsanpham ORDER BY danhmucsanpham_id ASC");
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">-----Chọn danh mục-----</option>
								<?php
								while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
									if ($id_category_1 == $row_danhmuc['danhmucsanpham_id']) {
								?>
										<option selected value="<?php echo $row_danhmuc['danhmucsanpham_id'] ?>"><?php echo $row_danhmuc['danhmucsanpham_name'] ?></option>
									<?php
									} else {
									?>
										<option value="<?php echo $row_danhmuc['danhmucsanpham_id'] ?>"><?php echo $row_danhmuc['danhmucsanpham_name'] ?></option>
								<?php
									}
								}
								?>
							</select><br>
							<div style="text-align: center;"><input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-success"></div>
						</form>
					</div>
				<?php
				} else {
				?>
					<div class="col-md-4">
						<h4 style="text-align: center; color: #E64419; font-size: 30px; padding: 10px; ">Thêm sản phẩm</h4>

						<form action="" method="POST" enctype="multipart/form-data" class="text-cnsp">
							<label>Tên sản phẩm</label>
							<input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm"><br>
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<label>Giá</label>
							<input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm"><br>
							<label>Giá khuyến mãi</label>
							<input type="text" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi"><br>
							<label>Sản phẩm hot</label>
							<input type="text" class="form-control" name="sp_hot" placeholder="Sản phẩm hot"><br>
							<label>Số lượng</label>
							<input type="text" class="form-control" name="soluong" placeholder="Số lượng"><br>
							<label>Mô tả</label>
							<textarea class="form-control" name="mota"></textarea><br>
							<label>Mô tả chi tiết</label>
							<textarea class="form-control" name="chitiet"></textarea><br>
							<label>Danh mục</label>
							<?php
							$sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_danhmucsanpham ORDER BY danhmucsanpham_id AsC");
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">-----Chọn danh mục-----</option>
								<?php
								while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
								?>
									<option value="<?php echo $row_danhmuc['danhmucsanpham_id'] ?>"><?php echo $row_danhmuc['danhmucsanpham_name'] ?></option>
								<?php
								}
								?>
							</select><br>
							<div style="text-align: center;"><input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-success"></div>
						</form>
					</div>
				<?php
				}

				?>
				<div class="col-md-8">
					<h4 style="text-align: center; color: #E64419; font-size: 30px; padding: 10px; ">Liệt kê sản phẩm</h4>
					<?php
					$sql_select_sp = mysqli_query($con, "SELECT * FROM tbl_sanpham,tbl_danhmucsanpham WHERE tbl_sanpham.danhmucsanpham_id=tbl_danhmucsanpham.danhmucsanpham_id ORDER BY tbl_sanpham.sanpham_id ASC");
					?>
					<table class="table table-bordered ">
						<tr>
							<th>Thứ tự</th>
							<th>Tên sản phẩm</th>
							<th>Hình ảnh</th>
							<th>Số lượng</th>
							<th>Danh mục</th>
							<th>Giá sản phẩm</th>
							<th>Giá khuyến mãi</th>
							<th>Quản lý</th>
						</tr>
						<?php
						$i = 0;
						while ($row_sp = mysqli_fetch_array($sql_select_sp)) {
							$i++;
						?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row_sp['sanpham_name'] ?></td>
								<td><img src="../img/<?php echo $row_sp['sanpham_image'] ?>" height="100" width="80"></td>
								<td><?php echo $row_sp['sanpham_soluong'] ?></td>
								<td><?php echo $row_sp['danhmucsanpham_name'] ?></td>
								<td><?php echo number_format($row_sp['sanpham_gia']) . 'đ' ?></td>
								<td><?php echo number_format($row_sp['sanpham_giakhuyenmai']) . 'đ' ?></td>
								<td  class="select-del-hover"><a href="?xoa=<?php echo $row_sp['sanpham_id'] ?>">Xóa</a> || <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['sanpham_id'] ?>">Cập nhật</a></td>
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