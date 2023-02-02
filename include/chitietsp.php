<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  $id = '';
}
$sql_chitiet = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE sanpham_id='$id'");

?>


<section class="product">
  <!-- Page -->

  <div class="breadcrumb-product">
    <nav class="breadcrumb-product-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb" style="background-color: #eee;">
        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">ĐỒ CẮM TRẠI</li>
        <li class="breadcrumb-item active" aria-current="page">CHI TIẾT SẢN PHẨM</li>
      </ol>
    </nav>
  </div>
  <?php
  while ($row_chitiet = mysqli_fetch_array($sql_chitiet)) {
  ?>
    <!-- Single Page  -->
    <div class="body-product-details" style="margin: 30px 0px;">
      <div class="product-content d-flex " style="max-width: 1350px; margin: 0px 30px auto auto;">
        <div class="product-content-left col-md-6 ">
          <div class="product-content-left-big-img">
            <img src="img/<?php echo $row_chitiet['sanpham_image'] ?>" alt="">
          </div>
        </div>
        <!-- content ctsp -->
        <div class="product-content-right col-md-6">
          <div class="product-content-right-product-name ">
            <h3><?php echo $row_chitiet['sanpham_name'] ?></h3>
            <p style="margin-bottom: 0px; color: #999999; font-size: 18px;">MSP: <?php echo $row_chitiet['sanpham_id'] ?></p>
          </div>
          <div class="product-content-right-product-price">
            <p style="color:#D60404; font-size: 25px; margin-right: 15px;"><?php echo number_format($row_chitiet['sanpham_giakhuyenmai']) ?><sup>đ</sup></p>
            <p style="font-size: 20px;"><s><?php echo number_format($row_chitiet['sanpham_gia']) ?><sup>đ</sup></s></p>
          </div>
          <form action="?quanly=giohang" method="post">
            <input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['sanpham_name'] ?>">
            <input type="hidden" name="sanpham_id" value="<?php echo $row_chitiet['sanpham_id'] ?>">
            <input type="hidden" name="giasanpham" value="<?php echo $row_chitiet['sanpham_giakhuyenmai'] ?>">
            <input type="hidden" name="giohang_image" value="<?php echo $row_chitiet['sanpham_image'] ?>">
            <div class="product-content-right-product-color">
              <label for="size" style=" color:#212529; line-height: 16px; font-size: 18px; padding-bottom:10px;">Chọn màu sắc:</label>
              <select id="size" name="size" class="form-control" style="width:158px; height: auto;">
                <option>Chọn màu cần mua</option>
                <option>Cam</option>
                <option>Xanh dương</option>
                <option>Xám</option>
                <option>Xanh lá</option>
              </select>
              <div class="product-count">
                
                  <label for="size " style=" color:#212529; line-height: 16px; font-size: 18px; padding-bottom:10px;">Số Lượng</label>
                  <div class="display-flex">
                  <div class="qtyminus">-</div>
                  <input type="text" name="soluong" value="1" class="qty">
                  <div class="qtyplus">+</div>
                </div>
              </div>
            </div>
            <input style="margin-top: 15px; width: 160px; font-size: 13px; border-radius: 8px; height: 40px;" type="submit" name="themgiohang" value="THÊM VÀO GIỎ HÀNG" class="btn3 hov-btn3">
            <!-- <fieldset class="themgiohang d-flex product-button-cart btn btn-success" style="margin-top: 15px;">
             
            </fieldset> -->
          </form>



        </div>

      </div>
      <div class="product-info-tabs" style="max-width: 1350px; margin: 30px auto;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a style=" font-size: 18px; font-weight: 600; color: #0000008A" class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Mô tả sản phẩm</a>
          </li>
          <li class="nav-item">
            <a style=" font-size: 18px; font-weight: 600; color: #0000008A" class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Chi tiết sản phẩm</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="margin-top: 30px;">
          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
            <?php echo $row_chitiet['sanpham_mota'] ?>
          </div>
          <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
            <?php echo $row_chitiet['sanpham_chitiet'] ?>

          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</section>