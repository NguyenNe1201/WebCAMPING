<?php
$sql_sanpham = mysqli_query($con, "SELECT * FROM tbl_danhmucsanpham,tbl_sanpham WHERE tbl_danhmucsanpham.danhmucsanpham_id=tbl_sanpham.danhmucsanpham_id AND tbl_sanpham.danhmucsanpham_id='$_GET[id]' ORDER BY tbl_sanpham.sanpham_id ASC");
$row_title = mysqli_fetch_array($sql_sanpham);

?>
<?php
  $sql_category = mysqli_query($con, 'SELECT  * FROM tbl_danhmucsanpham ORDER BY danhmucsanpham_id	ASC');

  ?>
<div class="breadcrumb-product">
    <nav class="breadcrumb-product-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ĐỒ CẮM TRẠI</li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $row_title['danhmucsanpham_name'] ?></li>
        </ol>
    </nav>
</div>
<body>
    <div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
</body>