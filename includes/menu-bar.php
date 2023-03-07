<div class="header-nav animate-dropdown" style="background-color: white;">
    <div class="container">
        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class" style="background-color: #ffde59;">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer" style="hover: background-color: black;">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown" style="background-color: brown; pointer-events:none">
                                <a href="javascript:" data-hover="dropdown" class="dropdown-toggle">Categories: </a>
                            </li>
                            <?php $sql=mysqli_query($con,"select id, categoryName from category limit 6");
                            while($row=mysqli_fetch_array($sql))
                            {
                                ?>

                            <li class="dropdown <?php if($_GET['cid'] === $row['id']) echo 'active';?>">
                                <a href="category.php?cid=<?php echo $row['id'];?>">
                                    <?php echo $row['categoryName'];?>
                                </a>
                            </li>
                            <?php } ?>


                        </ul><!-- /.navbar-nav -->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>