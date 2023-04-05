<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
	// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Billing Address has been updated');</script>";
		}
	} else if (isset($_POST['submit-payment'])) {

        mysqli_query($con,"update orders set estimation='".$_POST['estimation']."', paymentMethod='".$_POST['paymethod']."', transaction_code='".$_POST['transaction_code']."' where userId='".$_SESSION['id']."' and paymentMethod is null ");
        unset($_SESSION['cart']);
        header('location:order-history.php');

    }


// code for Delivery address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Delivery Address has been updated');</script>";
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

    <title>My Account</title>

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

    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/images/favicon.ico">

</head>

<body class="cnt-home" style=";">
    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>

    </header>

    <div class="body-content">
        <div class="container">
            <div class="checkout-box inner-bottom-sm">
                <div class="row">

                    <div class="col-md-8">
                        <div>
                            <?php
                                $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                while($row=mysqli_fetch_array($query))
                                {
                                ?>

                            <form class="register-form" role="form" method="post">
                                <div class="form-group">
                                    <label class="info-title" for="Delivery Address">Delivery
                                        Address<span>*</span></label>
                                    <textarea class="form-control unicase-form-control text-input" " name="shippingaddress"
                                        required="required"><?php echo $row['shippingAddress'];?></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="Billing State ">Barangay
                                        <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input"
                                        id="shippingstate" name="shippingstate"
                                        value="<?php echo $row['shippingState'];?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="Billing City"> City
                                        <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input"
                                        id="shippingcity" name="shippingcity" required="required"
                                        value="<?php echo $row['shippingCity'];?>">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="Billing Pincode">Zip Code
                                        <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input"
                                        id="shippingpincode" name="shippingpincode" required="required"
                                        value="<?php echo $row['shippingPincode'];?>">
                                </div>
                                <button type="submit" name="shipupdate"
                                    class="btn-upper btn btn-primary checkout-page-button">Update</button>
                            </form>
                            <?php } ?>

                        </div>
                    </div>
                    <?php include('includes/myaccount-sidebar2.php');?>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->

        </div>
    </div>
    <?php include('includes/footer.php');?>
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


    <script>
    <?php
        $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
        while($row=mysqli_fetch_array($query))
        {
        ?>
    const localAddress =
        "<?php echo $row['shippingAddress'] . ' ' . $row['shippingState'] . ' ' . $row['shippingCity'] . ' ' . $row['shippingPincode']; ?> ";
    <?php } ?>

    localStorage.setItem('gLocalAddress', localAddress);

    $('[name=paymethod]').on('change', function() {
        if ($(this).val().trim().toLowerCase() !== 'cod') {
            $('#gcashpayment').find('input').attr('required', 'required');
            $('#gcashpayment').show();
        } else {
            $('#gcashpayment').hide();
            $('#gcashpayment').find('input').removeAttr('required');
        }
    });


    // if (localStorage.getItem('gLocalAddress') === localAddress && localStorage.getItem('generatedCoor') != undefined) {
    //     $.getJSON(
    //         `https://api.mapbox.com/directions/v5/mapbox/driving/${localStorage.getItem('generatedCoor')}?alternatives=true&geometries=geojson&language=en&overview=simplified&steps=true&access_token=pk.eyJ1Ijoia2FrYXJzdWhhaWwiLCJhIjoiY2tpaWxsa205MjhjbDJ5cGVhaWRkaWI1MCJ9.9wW7P75jPB9RE7xLfdZEaA`,
    //         function(o) {
    //             const time = o.routes[0].duration;
    //             const minutes = Math.floor(time / 60);
    //             const seconds = Math.floor(time - minutes * 60);

    //             $('#estimated').text(
    //                 `${minutes} mins ${((seconds > 0)? seconds + 'sec' : '')}`
    //             );

    //         });
    // } else {
        $.getJSON(
            `https://api.opencagedata.com/geocode/v1/json?q=${localAddress}&key=e7c6b0e7aab747ae8364ca03258843f2&no_annotations=1&language=en`,
            function(users_place) {
                let usersCoor = '';
                if (users_place.results.length > 0) {
                    usersCoor = users_place.results[0].geometry.lng + ', ' + users_place.results[0].geometry.lat;
                }

                let generatedCoor = '121.1068574,14.6892715;' + usersCoor;
                localStorage.setItem('generatedCoor', generatedCoor);
                $.getJSON(
                    `https://api.mapbox.com/directions/v5/mapbox/driving/${generatedCoor}?alternatives=true&geometries=geojson&language=en&overview=simplified&steps=true&access_token=pk.eyJ1Ijoia2FrYXJzdWhhaWwiLCJhIjoiY2tpaWxsa205MjhjbDJ5cGVhaWRkaWI1MCJ9.9wW7P75jPB9RE7xLfdZEaA`,
                    function(o) {
                        const time = o.routes[0].duration;
                        $('#estimation_seconds').val(time);
                        const minutes = Math.floor(time / 60);
                        const seconds = Math.floor(time - minutes * 60);

                        $('#estimated').text(
                            `${minutes} mins ${((seconds > 0)? seconds + 'sec' : '')}`
                        );

                    });
            }
        );

    // }
    </script>
</body>

</html>
<?php } ?>