<?php
session_start();
include('../connect.php');
?>
<?php
if (isset($_POST['dangnhap'])) {
  $taikhoan = $_POST['taikhoan'];
  $matkhau = md5($_POST['matkhau']);
  if ($taikhoan == '' || $matkhau == '') {
    echo '<script>alert("Không được để trống")</script>';
  } else {
    $sql_select_admin = mysqli_query($con, "SELECT * FROM tbl_admin where email='$taikhoan'AND tbl_admin.password ='$matkhau'");
    $count = mysqli_num_rows($sql_select_admin);
    $row_dangnhap = mysqli_fetch_array($sql_select_admin);
    if ($count > 0) {
      $_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
      $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
      header('Location: dashboard.php');
    } else {
      echo '<script>alert("tài khoản hoặc mật khẩu sai")</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="/style1.css">
  <link rel="stylesheet" href="/reset.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <style>
    /* ------------------------ login---------------------------- */
    .register-photo {
      background: #f1f7fc;
      padding: 80px 0
    }

    .register-photo .image-holder {
      display: table-cell;
      width: auto;
      background: url(https://havicotour.com.vn/wp-content/uploads/2020/08/l%E1%BB%81u-c%E1%BA%AFm-tr%E1%BA%A1i.jpg);
      background-size: cover
    }

    .register-photo .form-container {
      display: table;
      max-width: 900px;
      width: 90%;
      margin: 0 auto;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1)
    }

    .register-photo form {
      display: table-cell;
      width: 400px;
      background-color: #ffffff;
      padding: 40px 60px;
      color: #505e6c
    }

    @media (max-width:991px) {
      .register-photo form {
        padding: 40px
      }
    }

    .register-photo form h2 {
      font-size: 24px;
      line-height: 1.5;
      margin-bottom: 30px
    }

    .register-photo form .form-control {
      background: transparent;
      border: none;
      color: #61acb3;
      border-bottom: 1px solid #dfe7f1;
      border-radius: 0;
      box-shadow: none;
      outline: none;
      color: inherit;
      text-indent: 0px;
      height: 40px
    }

    .register-photo form .form-check {
      font-size: 13px;
      line-height: 20px
    }

    .register-photo form .btn-primary {
      background: #61acb3;
      border: none;
      border-radius: 25px;
      padding: 11px;
      box-shadow: none;
      margin-top: 35px;
      text-shadow: none;
      outline: none !important
    }

    .register-photo form .btn-primary:hover,
    .register-photo form .btn-primary:active {
      background: #61acb3
    }

    .register-photo form .btn-primary:active {
      transform: translateY(1px)
    }

    .register-photo form .already {
      display: block;
      text-align: center;
      font-size: 12px;
      color: #6f7a85;
      opacity: 0.9;
      text-decoration: none
    }
  </style>
</head>

<body>
  <div class="register-photo">
    <h3 style="text-align: center; margin-bottom: 20px; color: #36393B;">Shop Bán Đồ Camping - Leo Núi - Đồ Dã Ngoại</h3>
    <div class="form-container">

      <div class="image-holder"></div>
      <form method="POST">
        <h2 class="text-center"><strong>Đăng Nhập</strong></h2>
        <div class="form-group"><input class="form-control" type="Username" name="taikhoan" placeholder="Tên Đăng Nhập"></div>
        <div class="form-group"><input class="form-control" type="password" name="matkhau" placeholder="Mật Khẩu"></div>
        <div class="form-group">
          <div class="" style="display: flex; justify-content: space-between;">
            <!-- <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> Hiển thị mật khẩu </label> </div> -->
            <div> <a href="#" class="text-info">Quên mật khẩu?</a> </div>
          </div>
        </div>
        <div class="form-group"><button class="btn btn-success btn-block btn-info" type="submit" name="dangnhap">Đăng nhập</button></div><a class="already" href="#"></a>
      </form>
    </div>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>