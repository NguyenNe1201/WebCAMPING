<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$sql_cate = mysqli_query($con, "SELECT * FROM tbl_danhmucsanpham,tbl_sanpham WHERE tbl_danhmucsanpham.danhmucsanpham_id=tbl_sanpham.danhmucsanpham_id AND tbl_sanpham.danhmucsanpham_id='$_GET[id]' ORDER BY tbl_sanpham.sanpham_id ASC");
$sql_cate1 = mysqli_query($con, "SELECT * FROM tbl_danhmucsanpham,tbl_sanpham WHERE tbl_danhmucsanpham.danhmucsanpham_id=tbl_sanpham.danhmucsanpham_id AND tbl_sanpham.danhmucsanpham_id='$_GET[id]' ORDER BY tbl_sanpham.sanpham_id ASC");

$row_title = mysqli_fetch_array($sql_cate1);
$title = $row_title['danhmucsanpham_name'];
?>
<div class="breadcrumb-product">
    <nav class="breadcrumb-product-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #eee;">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" style="margin-left: 0px;" aria-current="page">ĐỒ CẮM TRẠI</li>
            <li class="breadcrumb-item active" style="margin-left: 0px; text-transform: uppercase;" aria-current="page"><?php echo $title ?></li>
        </ol>
    </nav>
</div>
<div class="wrapper">
    <div class="content py-md-0 py-3">
        <div id="sidebar">
            <div class="py-3">
                <h5 class="font-weight-bold category-product ">Danh mục sản phẩm</h5>
                <ul class="list-group" style="font-size: 15px;">
                    <?php
                    $sql_category = mysqli_query($con, 'SELECT  * FROM tbl_danhmucsanpham ORDER BY danhmucsanpham_id	ASC');

                    while ($row_category = mysqli_fetch_array($sql_category)) {

                    ?>
                        <li class="list-group-item1 list-group-item-action d-flex justify-content-between align-items-center category">
                            <a class="danhmuc-hover" href="?quanly=danhmuc&id=<?php echo $row_category['danhmucsanpham_id'] ?>"><?php echo $row_category['danhmucsanpham_name'] ?></a>

                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="py-3">
                <h5 class="font-weight-bold category-product ">Tìm Giá sản phẩm</h5>
                <div class="sidebar-box-2">

                    <form action="index.php?quanly=timkiemtheogia" method="POST" class="colorlib-form-2">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="guests" style="font-weight: 500;">Price from:</label>
                                    <div class="form-field">
                                        <i class="icon icon-arrow-down3"></i>
                                        <select name="search_price1" id="search_price1" class="form-control" style="width: 160px; height: 38px;">
                                            <option>50000</option>
                                            <option>100000</option>
                                            <option>150000</option>
                                            <option>200000</option>
                                            <option>250000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="guests" style="font-weight: 500;">Price to:</label>
                                    <div class="form-field">
                                        <i class="icon icon-arrow-down3"></i>
                                        <select name="search_price2" id="search_price2" class="form-control" style="width: 160px; height: 38px;">
                                            <option>300000</option>
                                            <option>500000</option>
                                            <option>700000</option>
                                            <option>900000</option>
                                            <option>1100000</option>
                                        </select>
                                    </div>
                                    <button class="btn1" type="submit" name="search_button_price" style="margin-top: 15px; width: 120px;">Tìm theo giá</button>

                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Products Section -->
        <div id="products1">
            <div class="container py-3">
                <div class="row" style="    border-left: 1px solid #dddddd">
                    <?php

                    while ($row_sanpham = mysqli_fetch_array($sql_cate)) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">
                            <div class="card">
                                <div class="thumb-wrapper">
                                    <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><img src="img/<?php echo $row_sanpham['sanpham_image'] ?>" class="img-responsive center-block"></a>
                                    <div class="thumb-content">
                                        <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>">
                                            <h4 class="text-center"><?php echo $row_sanpham['sanpham_name'] ?></h4>
                                        </a>
                                        <div class="star-rating" style="text-align: center;">
                                            <ul class="list-inline" style="display: flex; justify-content: center;">
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item"><i style="opacity: 40%;" class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <p class="item-price" style="font-size: 17px; text-align: center; color: #747D89; font-weight: 600;"><strike style="font-size:13px; margin-right: 10px; color:#999"><?php echo $row_sanpham['sanpham_gia'] . ' đ'  ?></strike><?php echo $row_sanpham['sanpham_giakhuyenmai'] . ' đ'  ?></p>
                                        <form action="?quanly=giohang" method="post">
                                            <fieldset>
                                                <input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name'] ?>" />
                                                <input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id'] ?>" />
                                                <input type="hidden" name="giasanpham" value="<?php echo $row_sanpham['sanpham_gia'] ?>" />
                                                <input type="hidden" name="giohang_image" value="<?php echo $row_sanpham['sanpham_image'] ?>" />
                                                <input type="hidden" name="soluong" value="1" />
                                                <input type="hidden" name="size" value="màu ngẫu nhiên" />
                                                <input style="margin: auto;" type="submit" name="themgiohang" value="Thêm giỏ hàng" class="btn1 " />
                                            </fieldset>
                                        </form>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>
    </div>
</div>