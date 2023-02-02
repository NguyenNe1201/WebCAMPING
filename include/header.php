
<?php
// session_destroy();
// unset('dangnhap');

// 
if (isset($_POST['dangnhap_home'])) {
    $taikhoan = $_POST['email_login'];
    $matkhau = $_POST['password_login'];
    if ($taikhoan == '' || $matkhau == '') {
        echo '<script>alert("Làm ơn không để trống")</script>';
    } else {
        $sql_select_admin = mysqli_query($con, "SELECT * FROM tbl_khachhang WHERE khachhang_email='$taikhoan' AND khachhang_password='$matkhau' LIMIT 1");
        $count = mysqli_num_rows($sql_select_admin);
        $row_dangnhap = mysqli_fetch_array($sql_select_admin);
        if ($count > 0) {
            $_SESSION['dangnhap_home'] = $row_dangnhap['khachhang_name'];
            $_SESSION['khachhang_id'] = $row_dangnhap['khachhang_id'];
        } else {
            echo '<script>alert("Tài khoản mật khẩu sai")</script>';
        }
    }
} elseif (isset($_POST['dangky'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $address = $_POST['address'];
    $giaohang = $_POST['giaohang'];

    $sql_khachhang = mysqli_query($con, "INSERT INTO tbl_khachhang(khachhang_name,khachhang_phone,khachhang_email,khachhang_address,giaohang,khachhang_password) values ('$name','$phone','$email','$address','$giaohang','$password')");
    $sql_select_khachhang = mysqli_query($con, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
    $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
    $_SESSION['dangnhap_home'] = $name;
    $_SESSION['khachhang_id'] = $row_khachhang['khachhang_id'];

    // header('Location:cart.php');
} elseif (isset($_GET['dangxuat'])) {
    $id = $_GET['dangxuat'];
    if ($id == 1) {
        unset($_SESSION['dangnhap_home']);
    }
} elseif (isset($_POST['capnhat'])) {
    $id_thongtin = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $sql_update = mysqli_query($con, "UPDATE tbl_khachhang SET khachhang_name='$name',khachhang_phone='$phone',khachhang_email='$email',khachhang_password='$password',khachhang_address='$address' WHERE khachhang_id='$id_thongtin'");
}

?>
<?php
$sql_category = mysqli_query($con, 'SELECT  * FROM tbl_danhmucsanpham ORDER BY danhmucsanpham_id	asc');
$sql_cate1 = mysqli_query($con, "SELECT SUM(tbl_giohang.soluong) FROM tbl_giohang");
$row_title = mysqli_fetch_array($sql_cate1);
$title = $row_title['SUM(tbl_giohang.soluong)'];
?>

<!-- main nav -->
<nav class="navbar navbar-expand-lg " style="background-color: white !important; margin-bottom: 0px;">
    <div class="container-fluid">
        <a   href="index.php"><img style=" width: 85px;" src="../TTCM_Camping/img/logosmall.jpg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav nav-menu">
                <li class="nav-item dropdown header-danhmuc">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ĐỒ CẮM TRẠI
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                        while ($row_category = mysqli_fetch_array($sql_category)) {
                        ?>
                            <li><a class="dropdown-item " href="?quanly=danhmuc&id=<?php echo $row_category['danhmucsanpham_id'] ?>">
                                    <?php echo $row_category['danhmucsanpham_name'] ?>
                                </a></li>
                        <?php } ?>
                    </ul>
                </li>

                <li class="nav-item header-danhmuc">
                    <a class="nav-link " href="#about">GIỚI THIỆU</a>
                </li>
              
                <li class="nav-item header-danhmuc">
                    <a class="nav-link" href="#reservation">LIÊN HỆ</a>
                </li>
                <li class="nav-item header-danhmuc">
                    <a class="nav-link" href="#">CHIA SẼ KINH NGHIỆM</a>
                </li>
            </ul>
        </div>
        <nav class=" bg-light" style="background-color: white !important;">
            <div class="container-fluid">
                <form class="d-flex" role="search" action="index.php?quanly=timkiem" method="POST">
                    <input class="form-control me-2" name="search_product" type="search" placeholder="TÌM KIẾM SẢN PHẨM" aria-label="Search">
                    <button class="btn btn-outline-success" style="border: 1px solid #ccc;" type="submit" name="search_button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </nav>
        <!-- head-right item -->

        <div class="header-actions">
            <!-- item wallet -->
            
            <?php
            if (!isset($_SESSION['dangnhap_home'])) {
            ?>
                <!-- item wallet -->
                <div>
                    <a class="icon cart-shopping" href="#" data-toggle="modal" data-target="#dangnhap">
                        <i class="fa fa-user"></i>
                    </a>
                </div>
                <!-- item wallet -->
            <?php } ?>
            <div>
                <a class="icon cart-shopping" href="?quanly=giohang">
                    <i class="fa fa-shopping-cart"></i>
              
                    <span class="badge-category badge-primary-category">[<?php echo $title ?>]</span>
            </a>
            </div>
            <?php
            if (isset($_SESSION['dangnhap_home'])) {
            ?>
                <div>
                    <a class="icon cart-shopping" href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>">
                        <i class="fas fa-clipboard-list"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php
        if (isset($_SESSION['dangnhap_home'])) {
            echo '<p  style="margin:0 15px; font-size: 15px; " ><a href="#" style="color: #E64419 !important;"  data-toggle="modal" data-target="#thongtin">' . $_SESSION['dangnhap_home'] . '</a><br><a class="userdangxuat" href="index.php?dangxuat=1">Đăng xuất</a></p>';
        } else {
            echo '<p style=" width: auto;"></p>';
        }
        ?>


    </div>

</nav>
<!-- Login -->
<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right: 0px !important; ">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ĐĂNG NHẬP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="text" class="form-control" placeholder=" " name="email_login" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder=" " name="password_login" required="">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" name="dangnhap_home" value="Đăng nhập">
                    </div>

                    <p class="text-center dont-do mt-3">Chưa có tài khoản?
                        <a href="#" data-toggle="modal" data-target="#dangky">
                            Đăng ký</a>
                    </p>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- dang ki tai khoan -->

<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true" style="padding-right: 0px !important; " >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng ký</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="col-form-label">Tên khách hàng</label>
                        <input type="text" class="form-control" placeholder=" " name="name" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="email" class="form-control" placeholder=" " name="email" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder=" " name="password" required="">
                        <input type="hidden" class="form-control" placeholder="" name="giaohang" value="0">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Số điện thoại</label>
                        <input type="number" class="form-control" placeholder=" " name="phone" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Địa chỉ</label>
                        <input type="text" class="form-control" placeholder=" " name="address" required="">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" name="dangky" value="Đăng ký">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>