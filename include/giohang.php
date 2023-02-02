<?php
if (isset($_POST['themgiohang'])) {
    $tensanpham = $_POST['tensanpham'];
    $sanpham_id = $_POST['sanpham_id'];
    $hinhanh = $_POST['giohang_image'];
    $gia = $_POST['giasanpham'];
    $soluong = $_POST['soluong'];
    $size1 = $_POST['size'];
    $sql_select_giohang = mysqli_query($con, "SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
    $count = mysqli_num_rows($sql_select_giohang);
    if ($count > 0) {
        $row_sanpham = mysqli_fetch_array($sql_select_giohang);
        $soluong = $row_sanpham['soluong'] + 1;
        $sql_giohang = "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'";
    } else {
        $soluong = $soluong;
        $sql_giohang = "INSERT INTO tbl_giohang(tensanpham,sanpham_id,giasanpham,giohang_image,soluong,size)
         values ('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong','$size1')";
    }
    $insert_row = mysqli_query($con, $sql_giohang);
    if ($insert_row == 0) {
        header('Location:index.php?quanly=chitietsp&id=' . $sanpham_id);
    }
} elseif (isset($_POST['capnhatsoluong'])) {
    for ($i = 0; $i < count($_POST['product_id']); $i++) {
        $sanpham_id = $_POST['product_id'][$i];
        $soluong = $_POST['soluong'][$i];
        if ($soluong <= 0) {
            $sql_delete = mysqli_query($con, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
        } else {
            $sql_update = mysqli_query($con, "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");
        }
    }
} elseif (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $sql_delete = mysqli_query($con, "DELETE FROM tbl_giohang WHERE giohang_id='$id'");
} elseif (isset($_GET['dangxuat'])) {
    $id = $_GET['dangxuat'];
    if ($id == 1) {
        unset($_SESSION['dangnhap_home']);
    }
} elseif (isset($_POST['thanhtoan'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $note = $_POST['note'];
    $giaohang = $_POST['giaohang'];

    $sql_khachhang = mysqli_query($con, "INSERT INTO tbl_khachhang(khachhang_name,khachhang_phone,khachhang_address,khachhang_email,khachhang_password,khachhang_note,giaohang) value ('$name','$phone','$address','$email','$password','$note','$giaohang')");
    echo '<script>alert("Đặt hàng thành công")</script>';
    if ($sql_khachhang) {
        $sql_select_khachhang = mysqli_query($con, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
        $mahang = rand(0, 9999);
        $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
        $khachhang_id = $row_khachhang['khachhang_id'];
        $_SESSION['dangnhap_home'] = $row_khachhang['khachhang_name'];
        $_SESSION['khachhang_id'] = $khachhang_id;
        for ($i = 0; $i < count($_POST['thanhtoan_product_id']); $i++) {

            $sanpham_id = $_POST['thanhtoan_product_id'][$i];
            $soluong = $_POST['thanhtoan_soluong'][$i];
            $sql_donhang = mysqli_query($con, "INSERT INTO tbl_donhang(sanpham_id,soluong,mahang,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
            $sql_giaodich = mysqli_query($con, "INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
            $sql_delete_thanhtoan = mysqli_query($con, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
        }
    }
} elseif (isset($_POST['thanhtoandangnhap'])) {

    $khachhang_id = $_SESSION['khachhang_id'];
    $sql_select_khachhang = mysqli_query($con, "SELECT * FROM tbl_khachhang WHERE khachhang_id='$khachhang_id'");
    $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
    $address = $row_khachhang['khachhang_address'];
    $note = $_POST['notedangnhap'];
    $giaohang = $_POST['giaohangdangnhap'];
    $mahang = rand(0, 9999);
    echo '<script>alert("Đặt hàng thành công")</script>';
    for ($i = 0; $i < count($_POST['thanhtoan_product_id']); $i++) {
        $sanpham_id = $_POST['thanhtoan_product_id'][$i];
        $soluong = $_POST['thanhtoan_soluong'][$i];
        $sql_donhang = mysqli_query($con, "INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
        $sql_giaodich = mysqli_query($con, "INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
        $sql_delete_thanhtoan = mysqli_query($con, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
    }
}
?>
<?php
$sql_lay_giohang = mysqli_query($con, "SELECT * FROM tbl_giohang ORDER BY giohang_id ASC");
?>
<!-- main shoping cart -->
<div class="breadcrumb-product">
    <nav class="breadcrumb-product-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #eee;">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" style="margin-left: 0px;" aria-current="page">ĐỒ CẮM TRẠI</li>
            <li class="breadcrumb-item active" style="margin-left: 0px; text-transform: uppercase;" aria-current="page">GIỎ HÀNG VÀ THANH TOÁN</li>
            <li class="breadcrumb-item active" style="margin-left: 0px;" aria-current="page">GIỎ HÀNG:
                <?php
                if (isset($_SESSION['dangnhap_home'])) {
                    echo $_SESSION['dangnhap_home'];
                } else {
                    echo '';
                }
                ?>
            </li>

        </ol>
    </nav>
</div>

<section class="bg0 p-b-85" style="padding-top: 50px;">
    <div class="shopping-cart-container" style="max-width: 1300px;">
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                      
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1" style="padding-left: 40px;">SẢN PHẨM</th>
                                    <th class="column-2"></th>
                                    <th class="column-3" style="text-align: center;">GIÁ</th>
                                    <th class="column-4" style="text-align: center;">MÀU</th>
                                    <th class="column-4" style="text-align: center;">Sl</th>
                                    <th class="column-4" style="text-align: center;">THÀNH TIỀN</th>
                                    <th class="column-5" style="padding-right: 40px;">Xóa</th>
                                </tr>
                                <?php
                                $i = 0;
                                $tongtien = 0;
                                $tongsoluong = 0;
                                while ($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)) {
                                    $giatong = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];
                                    $tongsoluong = $tongsoluong + $row_fetch_giohang['soluong'];
                                    $tongtien += $giatong;
                                    $i++;
                                ?>
                                    <tr class="table_row">
                                        <td class="column-1" style="padding-left: 40px;">
                                            <div class="how-itemcart1">
                                                <img src="img/<?php echo $row_fetch_giohang['giohang_image'] ?>" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2"><?php echo $row_fetch_giohang['tensanpham'] ?></td>
                                        <td class="column-3" style="text-align: center;"><?php echo number_format($row_fetch_giohang['giasanpham']) . ' đ' ?></td>
                                        <td class="column-4" style="text-align: center;"><?php echo $row_fetch_giohang['size'] ?></td>
                                        <td class="column-4">
                                            <div style="width: 32px; margin:0 auto;">
                                                <input style="width: 32px; margin-left: 12px;" type="number" value="<?php echo $row_fetch_giohang['soluong'] ?>" min="0" name="soluong[]">
                                                <input style="width: 32px; margin-left: 12px;" type="hidden" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>" name="product_id[]">
                                            </div>
                                        </td>
                                        <td class="column-4" style="text-align: center; font-size: 16px;"><?php echo number_format($giatong) . ' đ' ?></td>
                                        <td class="column-5" style="padding-right: 40px;"><a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>">X</a></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </table>
                       
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div style="margin: auto; width: 220px;" class="flex-w flex-m m-r-20 m-tb-5">

                                <input class="btn4 hov-btn3" value="cập nhật giỏ hàng" type="submit" name="capnhatsoluong">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm" style="padding-top: 20px;">
                        <h4 class="Cart-h4" style="padding-bottom: 15px;">Tổng giỏ hàng</h4>
                        <div class="flex-w flex-t p-b-13" style="font-size: 16px;">
                            <div class="size-2081">
                                <span class="stext-110 cl2">Tổng sản phẩm:</span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2"><?php echo number_format($tongsoluong)  ?></span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-b-13" style="font-size: 16px;">
                            <div class="size-2081">
                                <span class="stext-110 cl2">Tổng tiền:</span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2"><?php echo number_format($tongtien) . ' đ' ?></span>
                            </div>
                        </div>
                        <!-- thông tin đơn hàng -->
                        <?php
                        if (!isset($_SESSION['dangnhap_home'])) {
                        ?>
                            <div class=" bor12 p-t-15 p-b-30">
                                <div style="margin: 10px 0; text-transform: uppercase; ">
                                    <span style="font-family: 'Josefin Sans', sans-serif; font-size: 18px; font-weight: 600; color: #FB5849;">
                                        thông tin đơn hàng
                                    </span>
                                </div>
                                <div class=" w-full-ssm" style="display: flex;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Họ tên:
                                    </span>
                                    <div class="bor8 bg0 m-b-12" style="margin: auto;">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15"  type="text" placeholder="Nguyễn Văn A" name="name">
                                    </div>

                                </div>
                                <div class=" w-full-ssm" style="display: flex; margin-top: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Số điện thoại:
                                    </span>
                                    <div class="bor8 bg0 m-b-12" style="margin: auto;">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15"  type="number" placeholder="+84" name="phone">
                                    </div>

                                </div>
                                <div class=" w-full-ssm" style="display: flex; margin-top: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Địa chỉ:
                                    </span>
                                    <div class="bor8 bg0 m-b-12" style="margin: auto;">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" placeholder="phường,Quận,Thành Phố" name="address">
                                    </div>
                                </div>
                                <div class=" w-full-ssm" style="display: flex; margin-top: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Email:
                                    </span>
                                    <div class="bor8 bg0 m-b-12" style="margin: auto;">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email"  placeholder="abc@gmail.com" name="email">
                                    </div>

                                </div>
                                <div class=" w-full-ssm" style="display: flex; margin-top: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Mật khẩu:
                                    </span>
                                    <div class="bor8 bg0 m-b-12" style="margin: auto;">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15"  type="password" name="password">
                                    </div>

                                </div>
                                <div class=" w-full-ssm" style="display: flex; margin-top: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Ghi chú:
                                    </span>
                                    <div class="bor8 bg0 m-b-12" style="margin: auto;">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15"  type="text" placeholder="ghi chú về đơn hàng" name="note">
                                    </div>

                                </div>
                                <!-- payment -->
                                <div class=" w-full-ssm" style="display: flex; margin-top: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Thanh toán:
                                    </span>
                                    <div class=" bg0 m-b-12" style="margin: auto;">
                                        <select name="giaohang" class=" bor8  " style="height: 40px; width: 202px;">
                                            <option class=" form-control stext-111 cl8 plh3 size-111 p-lr-15 " value="0">thanh toán onl</option>
                                            <option class=" form-control stext-111 cl8 plh3 size-111 p-lr-15 " value="1">thanh toán khi nhận hàng</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div style="margin-top: 15px;">
                                <?php
                                $sql_lay_giohang = mysqli_query($con, "SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
                                while ($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)) {
                                ?>
                                    <input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
                                    <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
                                <?php
                                }
                                ?>
                                <input style="margin:auto;" type="submit" class="btn3 hov-btn3" value="tiến hành mua hàng" name="thanhtoan">
                            </div>
                        <?php } ?>
                        <form action="" method="post">
                            <?php
                            $sql_giohang_select = mysqli_query($con, "SELECT * FROM tbl_giohang");
                            $count_giohang_select = mysqli_num_rows($sql_giohang_select);

                            if (isset($_SESSION['dangnhap_home']) && $count_giohang_select > 0) {
                            ?>
                                <div style="margin: 10px 0; text-transform: uppercase; ">
                                    <span style="font-family: 'Josefin Sans', sans-serif; font-size: 18px; font-weight: 600; color: #FB5849;">
                                        thông tin đơn hàng
                                    </span>
                                </div>
                              
                                <div class=" w-full-ssm" style="display: flex; margin-top: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Ghi chú:
                                    </span>
                                    <div class="bor8 bg0 m-b-12" style="margin: auto;">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" placeholder="ghi chú về đơn hàng" name="notedangnhap">
                                    </div>

                                </div>
                                <!-- payment -->
                                <div class=" w-full-ssm bor12" style="display: flex; margin-top: 15px; padding-bottom: 15px;">
                                    <span class="stext-110 cl2" style="margin: auto auto auto 0px; width: 100px;">
                                        Thanh toán:
                                    </span>
                                    <div class=" bg0 m-b-12" style="margin: auto;">
                                        <select name="giaohangdangnhap" class=" bor8  " style="height: 40px; width: 202px;">
                                            <option class=" form-control stext-111 cl8 plh3 size-111 p-lr-15 " value="0">thanh toán onl</option>
                                            <option class=" form-control stext-111 cl8 plh3 size-111 p-lr-15 " value="1">thanh toán khi nhận hàng</option>
                                        </select>
                                    </div>
                                </div>

                                <?php
                                while ($row_1 = mysqli_fetch_array($sql_giohang_select)) {
                                ?>

                                    <div class="cart-content-right-button">

                                        <input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">
                                        <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
                                    <?php
                                }
                                    ?>
                                    <div style="margin-top: 15px;">
                                        <input style="margin:auto;" type="submit" class="btn3 hov-btn3" value="tiến hành mua hàng" name="thanhtoandangnhap">

                                    </div>
                                    <!-- <input style="border-radius: 5px;" type="submit" name="thanhtoandangnhap" class="btn btn-success" value="MUA HÀNG"></input> -->
                                    </div>
                                <?php
                            }
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>