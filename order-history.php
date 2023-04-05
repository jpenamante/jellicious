<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

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

    <title>Order History</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
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
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script language="javascript" type="text/javascript">
    var popUpWin = 0;

    function popUpWindow(URLStr, left, top, width, height) {
        if (popUpWin) {
            if (!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr, 'popUpWin',
            'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
            600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    }
    </script>

</head>

<body class="cnt-home">



    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>
    </header>
    <?php $query=mysqli_query($con,"select products.productPrice as pprice, products.shippingCharge as shippingcharge, orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.paymentMethod is not null");

while ($row = mysqli_fetch_array($query)){
    $sum += $row['pprice'];
}
?>

    <?php $query=mysqli_query($con,"select products.productPrice as pprice, products.shippingCharge as shippingcharge, orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.paymentMethod is not null");

$rows = mysqli_fetch_assoc($query); 
$shippcharge = $rows['shippingcharge'];
?>
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li class='active'>Total Amount: <?php echo $sum + $shippcharge ?></li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <?php  ?>

    <div class="body-content">
        <div class="container">
            <div class="row inner-bottom-sm">
                <div class="shopping-cart">
                    <div class="col-md-12 col-sm-12 shopping-cart-table ">
                        <div class="table-responsive">
                            <form name="cart" method="post">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="">
                                            <th class="cart-romove item" style="font-weight: lighter;">#</th>
                                            <th class="cart-description item" style="font-weight: lighter;">Image</th>

                                            <th class="cart-qty item" style="font-weight: lighter;">Quantity</th>
                                            <th class="cart-sub-total item" style="font-weight: lighter;">Price Per unit
                                            </th>
                                            <th class="cart-sub-total item" style="font-weight: lighter;">Delivery Fee
                                            </th>
                                            <th class="cart-total item" style="font-weight: lighter;">Grand Total</th>
                                            <th class="cart-total item" style="font-weight: lighter;">Payment Method
                                            </th>
                                            <th class="cart-description item" style="font-weight: lighter;">Order Date
                                            </th>
                                            <th class="cart-total last-item" style="font-weight: lighter;">Action/
                                                Status</th>
                                        </tr>
                                    </thead><!-- /thead -->

                                    <tbody>

                                        <?php $query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid, orders.transaction_code from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.paymentMethod is not null order by orders.id desc ");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
                                        <tr style="">
                                            <td><?php echo $cnt;?></td>
                                            <td class="cart-image">
                                                <a class="entry-thumbnail"
                                                    href="product-details.php?pid=<?php echo $row['proid'];?>">
                                                    <img src="admin/productimages/<?php echo $row['proid'];?>/<?php echo $row['pimg1'];?>"
                                                        alt="" width="auto" height="130">
                                                </a>
                                                <h4 class='cart-product-description' style="text-align:center;"><a
                                                        href="product-details.php?pid=<?php echo $row['opid'];?>">
                                                        <?php echo $row['pname'];?></a></h4>
                                            </td>
                                            <td class="cart-product-quantity">
                                                <?php echo $qty=$row['qty']; ?>
                                            </td>
                                            <td class="cart-product-sub-total"><?php echo $price=$row['pprice']; ?>
                                            </td>
                                            <td class="cart-product-sub-total">
                                                <?php echo $shippcharge=$row['shippingcharge']; ?> </td>
                                            <td class="cart-product-grand-total">
                                                <?php echo (($qty*$price)+$shippcharge);?></td>
                                            <td class="cart-product-sub-total"><?php echo $row['paym']; ?>
                                                <?php echo (strlen($row['transaction_code']) > 0) ? ' <br/> <i>' . $row['transaction_code'] . '</i>' : ''; ?>
                                            </td>
                                            <td class="cart-product-sub-total"><?php echo $row['odate']; ?> </td>

                                            <td>
                                                <?php
                                                $actionResults = mysqli_query($con, "select * from ordertrackhistory where orderId = " . htmlentities($row['orderid']) . " order by id desc");
                                                $actionRow = mysqli_fetch_array($actionResults);
                                                if (strtolower($actionRow['status']) != 'delivered') { echo "<center><p> " . ucwords(@$actionRow['status'] ?? 'Not Processed') . "</p><center>"; 
                                                ?>
                                                <a href="javascript:void(0);"
                                                    onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['orderid']);?>');"
                                                    title="Track order">Track</a>
                                                <a href="cancel.php?ID=<?php echo $row['orderid'];?> "
                                                    style="color: lightblue;">Cancel</a>

                                                <?php } else {echo "<strong style='color:green'>Delivered</strong>";} ?>
                                            </td>
                                        </tr>
                                        <?php $cnt=$cnt+1;} ?>

                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->

                        </div>
                    </div>

                </div><!-- /.shopping-cart -->
            </div> <!-- /.row -->
            </form>
        </div><!-- /.container -->
    </div><!-- /.body-content -->

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
<?php } ?>