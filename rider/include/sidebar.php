<div class="span3">
    <div class="sidebar">

        <ul class="widget widget-menu unstyled">
            <li>

                <a class="" data-toggle="collapse" href="#togglePages">
                    <i class="menu-icon icon-cog"></i>
                    <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>Order
                    Management
                </a>

                <ul id="togglePages" class="unstyled in collapse">

                    <li>
                        <a href="ready-for-pickup-orders.php">
                            <i class="icon-tasks"></i>Ready for Pickup Orders
                            <?php
					$f1="00:00:00";
					$from=date('Y-m-d')." ".$f1;
					$t1="23:59:59";
					$to=date('Y-m-d')." ".$t1;
					$result = mysqli_query($con,"SELECT * FROM Orders where orderDate Between '$from' and '$to'");
					$num_rows1 = $result ? mysqli_num_rows($result) : 0;
					{
					?>

                            <b class="label orange pull-right"><?php echo htmlentities($num_rows1); ?></b>
                            <?php } ?>
                        </a>
                    </li>
                    <li>
                        <a href="delivered-orders.php">
                            <i class="icon-inbox"></i>
                            Delivered Orders
                            <?php	
	$status='Delivered';									 
$rt = mysqli_query($con,"SELECT * FROM Orders where orderStatus='$status'");
$num1 = $rt ? mysqli_num_rows($rt) : 0;
{?><b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
                            <?php } ?>

                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="widget widget-menu unstyled">

            <li>
                <a href="logout.php">
                    <i class="menu-icon icon-signout"></i>
                    Logout
                </a>
            </li>
        </ul>

    </div>
    <!--/.sidebar-->
</div>
<!--/.span3-->