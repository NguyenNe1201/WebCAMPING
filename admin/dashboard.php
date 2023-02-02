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
	<title>Welcome Admin</title>

	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</head>
<style>
	header {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		z-index: 1;

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

	.nav-item,
	.User-login a:hover {
		color: #51B848 !important;
	}
</style>

<body>
	<header>
		<nav class="navbar navbar-expand-lg " style="background-color: white !important;">
			<div class="container-fluid">
				<a class="navbar-brand" href="?login=dangxuat"><img style="width: 85px;" src="../img/logosmall.jpg" alt=""></a>
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>