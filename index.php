<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] == "add") {
	$id = intval($_GET['id']);
	if (isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]['quantity']++;
		header('location:my-cart.php');
	} else {
		$sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p);
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
			header('location:index.php');
		} else {
			$message = "Product ID is invalid";
		}
	}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">

	<title>Home Page</title>

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Customizable CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/green.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

	<!-- Demo Purpose Only. Should be removed in production -->
	<link rel="stylesheet" href="assets/css/config.css">

	<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<link rel="icon" href="https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png" type="image/gif" sizes="16x16">
	<link href='./style.css' rel='stylesheet' />

	<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
	<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css" />


</head>
<style>
	#map {
		width: 70%;
		height: 500px;
		margin:auto;
	}

	.complex-container {
		padding: 20px 40px;
		display: flex;
		height: 70vh;
	}

	.complex-container p,
	h1 {
		margin-bottom: 10px;
	}

	.complex-container>div {
		border: 3 solid #ccc;
	}

	.complex-container .pbold {
		font-weight: bold;
	}

	.content-1 {
		flex: 1;
		margin-top: 200px;
		margin-left: 100px;
	}
</style>

<body class="cnt-home" style="background-color: white;">



	
	<header class="header-style-1">
		<?php include('includes/top-header.php'); ?>
		<?php include('includes/main-header.php'); ?>



	</header>
	

	<div class="body-content" id="top-banner-and-menu" style="background-color: white">
		<div class="container">
			<div class="furniture-container homepage-container">
				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
						<!-- ================================== TOP NAVIGATION ================================== -->
					</div><!-- /.sidemenu-holder -->

					<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
					</div><!-- /.homebanner-holder -->

				</div><!-- /.row -->

				
				<div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
					<div class="more-info-tab clearfix" style="font-weight: lighter;">
						<h3 class="new-product-title pull-left" style="color: black; font-weight: lighter;">Featured Products</h3>
					</div>

					<div class="tab-content outer-top-xs">
						<div class="tab-pane in active" id="all">
							<div class="product-slider">
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
									<?php
									$ret = mysqli_query($con, "select * from products");
									while ($row = mysqli_fetch_array($ret)) {
										# code...
									?>
										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"height="300" alt=""></a>
														</div><!-- /.image -->


													</div><!-- /.product-image -->


													<div class="product-info text-left">
														<h3 class="name"><a style="color: black; font-weight: lighter;" href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price" style="color: #001515;">
																Php<?php echo htmlentities($row['productPrice']); ?> </span>
															<span class="price-before-discount" style="color: #001515;">Php<?php echo htmlentities($row['productPriceBeforeDiscount']); ?> </span>

														</div><!-- /.product-price -->

													</div><!-- /.product-info -->
													<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary" style="color: white; background-color: #00292a;">Add to Cart</a></div>
												</div><!-- /.product -->

											</div><!-- /.products -->
										</div><!-- /.item -->
									<?php } ?>

								</div><!-- /.home-owl-carousel -->
							</div><!-- /.product-slider -->
						</div>




						<div class="tab-pane" id="books">
							<div class="product-slider">
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
									<?php
									$ret = mysqli_query($con, "select * from products where category=3");
									while ($row = mysqli_fetch_array($ret)) {
										# code...


									?>

										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"height="300" alt=""></a>
														</div><!-- /.image -->


													</div><!-- /.product-image -->


													<div class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																Php <?php echo htmlentities($row['productPrice']); ?> </span>
															<span class="price-before-discount">Php<?php echo htmlentities($row['productPriceBeforeDiscount']); ?></span>

														</div><!-- /.product-price -->

													</div><!-- /.product-info -->
													<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
												</div><!-- /.product -->

											</div><!-- /.products -->
										</div><!-- /.item -->
									<?php } ?>


								</div><!-- /.home-owl-carousel -->
							</div><!-- /.product-slider -->
						</div>


						<div class="tab-pane" id="furniture">
							<div class="product-slider">
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
									<?php
									$ret = mysqli_query($con, "select * from products where category=5");
									while ($row = mysqli_fetch_array($ret)) {
									?>


										<div class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"height="300" alt=""></a>
														</div>


													</div>


													<div class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																Php<?php echo htmlentities($row['productPrice']); ?> </span>
															<span class="price-before-discount">Php<?php echo htmlentities($row['productPriceBeforeDiscount']); ?></span>

														</div>

													</div>
													<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a></div>
												</div>

											</div>
										</div>
									<?php } ?>


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('includes/footer.php'); ?>

		<script src="assets/js/jquery-1.11.1.min.js"></script>

		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>

		<script src="assets/js/echo.min.js"></script>
		<script src="assets/js/jquery.easing-1.3.min.js"></script>
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<script src="assets/js/jquery.rateit.min.js"></script>
		<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
		<script src="assets/js/bootstrap-select.min.js"></script>
		<script src="assets/js/wow.min.js"></script>
		<script src="assets/js/scripts.js"></script>

</body>

</html>