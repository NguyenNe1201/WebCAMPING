<?php
$con = mysqli_connect("localhost","root","","camping");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " .mysqli_connect_errno();
  exit();
}
// Change character set to utf8
$con -> set_charset("utf8");

?>          