<?php
//session_start();

?>

<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">
                    <?php if (strlen($_SESSION['login']) > 0 && strlen($_SESSION['id']) > 0) {   ?>
                    <!-- <li><a href="index.php"><i class="icon fa fa-user"></i>Welcome - <?php echo htmlentities($_SESSION['username']); ?></a></li> -->
                    <li><a href="index.php"><i class="icon fa fa-home"></i>Home</a></li>
                    <li><a href="my-account.php"><i class="icon fa fa-user"></i>My Account</a></li>
                    <?php } ?>
                    <li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                    <!-- <li><a href="track-orders.php"><i class="icon fa fa-search"></i>Track Order</a></li> -->
                    <?php if (strlen($_SESSION['login']) <= 0 && strlen($_SESSION['id']) <= 0) {   ?>
                    <li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
                    <li><a href="signup.php"><i class="icon fa fa-sign-in"></i>Sign Up</a></li>
                    <?php } else { ?>
                    <li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                    <li><a href="order-history.php"><i class="icon fa fa-book"></i>Orders</a></li>
                    <li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
                    <?php } ?>
                    
                </ul>
            </div>

            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    <li class="dropdown dropdown-small">
                        <a href="/" style="background-color: black; color: white; border-color: black;"
                            class="dropdown-toggle"><span class="key">Jellicious</b></a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div><!-- /.header-top-inner -->
    </div><!-- /.container -->
</div><!-- /.header-top -->