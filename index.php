<?php
session_start();
include_once('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>web bán đồ camping</title>
	<!--  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style1.css">
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="css/util.css">
	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
	<!-- bootstrap product -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<!-- boostrap menu product -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/lib/styles/snippets-2.2.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.google-analytics.com/analytics.js">
	<script type="text/javascript" async="" src="https://cdn4.buysellads.net/pub/tutorialrepublic.js"></script>
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-40117907-1"></script>
	<!-- test -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,700&subset=latin-ext" rel="stylesheet">
	<!-- boostrap category -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<style>
		.userdangxuat:hover {
			color: #51B848 !important;
		}
	</style>
</head>

<body>
	<!------------------------------------ Header ------------------------- -->
	<header>
		<?php
		include("include/header.php");
		?>
	</header>
	<main style="margin-top: 5px;">
		<?php
		if (isset($_GET['quanly'])) {
			$tam = $_GET['quanly'];
		} else {
			$tam = '';
		}
		if ($tam == 'danhmuc') {
			include('include/danhmuc.php');
		} elseif ($tam == 'chitietsp') {
			include('include/chitietsp.php');
		} elseif ($tam == 'giohang') {
			include('include/giohang.php');
		} elseif ($tam == 'timkiemtheogia') {
			include('include/timkiemtheogia.php');
		} elseif ($tam == 'timkiem') {
			include('include/timkiem.php');
		} elseif ($tam == 'xemdonhang') {
			include('include/xemdonhang.php');
		} else {
			include('include/home.php');
		}
		?>
	</main>
	<footer style="height: 250px;">
		<?php
		include("include/footer.php");
		?>
	</footer>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<!-- bootstrap product -->
	<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>
<script src="js/product-details.js"></script>
<script>
	$(document).ready(function() {
		$(".wish-icon i").click(function() {
			$(this).toggleClass("fa-heart fa-heart-o");
		});
	});

	$('#myModal').on('shown.bs.modal', function() {
		$('#myInput').trigger('focus')
	});
	const header = document.querySelector("header")
	window.addEventListener("scroll", function() {
		x = window.pageYOffset
		console.log(x)
		if (x > 0) {
			header.classList.add("sticky")
		} else {
			header.classList.remove("sticky")
		}
	})
	// menu product
	$(document).ready(function() {

		$('#itemslider').carousel({
			interval: 3000
		});

		$('.carousel-showmanymoveone .item').each(function() {
			var itemToClone = $(this);

			for (var i = 1; i < 6; i++) {
				itemToClone = itemToClone.next();

				if (!itemToClone.length) {
					itemToClone = $(this).siblings(':first');
				}

				itemToClone.children(':first-child').clone()
					.addClass("cloneditem-" + (i))
					.appendTo($(this));
			}
		});
	});

</script>

</html>