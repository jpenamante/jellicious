<?php
session_start();
error_reporting(0);
include('includes/config.php');
            $query = "SELECT * FROM `tbl_chat` ORDER BY id DESC";
            $run = $con->query($query);
            while($row = $run->fetch_array()):
        ?>
        <div class="chating_data">
            <span id="name"><?php echo htmlentities($row['name']);?></span><br>
            <span id="message"><?php echo htmlentities($row['message']);?></span>
            <span id="date"><?php echo htmlentities($row['date']);?></span>
        </div>
<?php endwhile; ?>