﻿<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Your cart has been updated');</script>";
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{
	
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

	$quantity=$_POST['quantity'];
	$pdd=$_SESSION['pid'];
	$value=array_combine($pdd,$quantity);


		foreach($value as $qty=> $val34){



mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
header('location:shipping-addresses2.php');
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

    <title>My Cart</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

</head>

<body class="cnt-home">



    <header class="header-style-1">
        <?php include('includes/top-header.php');?>

    </header>
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li class='active'></li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="row inner-bottom-sm">
                <div class="shopping-cart">
                    <div class="col-md-12 col-sm-12 shopping-cart-table ">
                        <div class="table-responsive">
                            <form name="cart" method="post">
                                <?php
if(!empty($_SESSION['cart'])){
	?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="color: black;">
                                            <th class="cart-romove item" style="font-weight: lighter;">Remove</th>
                                            <th class="cart-description item" style="font-weight: lighter;">Image</th>
                                            <th class="cart-product-name item" style="font-weight: lighter;">Product
                                                Name</th>

                                            <th class="cart-qty item" style="font-weight: lighter;">Quantity</th>
                                            <th class="cart-sub-total item" style="font-weight: lighter;">Price Per unit
                                            </th>
                                            <th class="cart-sub-total item" style="font-weight: lighter;">Delivery Fee</th>
                                            <th class="cart-sub-total item" style="font-weight: lighter;">Subtotal</th>
                                            <th class="cart-total last-item" style="font-weight: lighter;">Grand Total
                                            </th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="8">
                                                <div class="shopping-cart-btn">
                                                    <span class="">
                                                        <a href="index.php" style="color: black; font-weight: bold;"
                                                            class="btn btn-upper btn-primary outer-left-xs">Continue
                                                            Shopping</a>
                                                        <input type="submit" style="color: black; font-weight: bold;"
                                                            name="submit" value="Update shopping cart"
                                                            class="btn btn-upper btn-primary pull-right outer-right-xs">
                                                    </span>
                                                </div><!-- /.shopping-cart-btn -->
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

				array_push($pdtid,$row['id']);
//print_r($_SESSION['pid'])=$pdtid;exit;
	?>

                                        <tr>
                                            <td class="romove-item"><input
                                                    id="checkox-cart-<?php echo htmlentities($row['id']);?>"
                                                    type="checkbox" name="remove_code[]"
                                                    value="<?php echo htmlentities($row['id']);?>" /></td>
                                            <td class="cart-image">
                                                <label class="entry-thumbnail"
                                                    for="checkox-cart-<?php echo htmlentities($row['id']);?>">
                                                    <img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>"
                                                        alt="" width="114" height="146">
                                                </label>
                                            </td>
                                            <td class="cart-product-name-info">
                                                <h4 class='cart-product-description'><a style="color: black;"
                                                        href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>"><?php echo $row['productName'];

$_SESSION['sid']=$pd;
						 ?></a></h4>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="rating rateit-small"></div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>
                                                        <div class="reviews">
                                                            ( <?php echo htmlentities($num);?> Reviews )
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div><!-- /.row -->

                                            </td>
                                            <td class="cart-product-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span></div>
                                                    </div>
                                                    <input min="1" type="text"
                                                        value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>"
                                                        name="quantity[<?php echo $row['id']; ?>]">

                                                </div>
                                            </td>
                                            <td class="cart-product-sub-total"><span style="color: black;"
                                                    class="cart-sub-total-price"><?php echo $row['productPrice']; ?>.00</span>
                                            </td>
                                            <td class="cart-product-sub-total"><span style="color: black;"
                                                    class="cart-sub-total-price"><?php echo $row['shippingCharge']; ?>.00</span>
                                            </td>

                                            <td class="cart-product-grand-total"><span style="color: black;"
                                                    class="cart-grand-total-price"><?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']); ?>.00</span>
                                            </td>
                                            <td class="cart-product-grand-total"><span style="color: black;"
                                                    class="cart-grand-total-price"><?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</span>
                                            </td>
                                        </tr>

                                        <?php } }
$_SESSION['pid']=$pdtid;
				?>

                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->

                        </div>
                    </div><!-- /.shopping-cart-table -->
                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <span style="color: black; font-weight: lighter;"
                                            class="estimate-title">Delivery Address</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="color: black; font-weight: lighter;">
                                    <td>
                                        <div class="form-group">
                                            <?php $qry=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while ($rt=mysqli_fetch_array($qry)) {
	echo htmlentities($rt['shippingAddress'])."<br />";
	echo htmlentities($rt['shippingCity'])."<br />";
	echo htmlentities($rt['shippingState']);
	echo htmlentities($rt['shippingPincode']);
}

						?>

                                        </div>

                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div>

                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                        <table class="table table-bordered">
                            
                        </table><!-- /table -->
                    </div>
                    <div class="col-md-4 col-sm-12 cart-shopping-total">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>

                                        <div class="cart-grand-total">
                                            Grand Total<span
                                                class="inner-left-md"><?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>
                                        </div>
                                    </th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <button type="submit" name="ordersubmit"
                                                style="color: black; font-weight: bold;" class="btn btn-primary">PROCCED
                                                TO CHEKOUT</button>

                                        </div>
                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table>
                        <?php } 
	else {
		echo "Your shopping cart is empty";
	}?>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

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