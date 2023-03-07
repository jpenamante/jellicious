<?php
session_start();
error_reporting(0);
include('include/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>::Message::</title>
    <link rel="stylesheet" href="../newstyle.css">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>




    <script>
        function ajax() {
            var req =  new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                } 
            }
            req.open('GET','chat.php', true);
            req.send();
        }
        setInterval(function(){ajax()},1000);
    </script>
</head>
<body onload="ajax();" >
<header class="header-style-1">
<?php include('include/header.php');?>
<?php include('include/newside.php');?>		

</header>
<div class="page" style="height: 620px; margin-top: 50px;">
    <div class="display-box">
        <div id="chat"></div>
    </div>
    <div class="form">
        <form action="" method="post">
            <input type="text" name="name" style="border-color: transparent;" value="<?php echo htmlentities($_SESSION['alogin']);?>" placeholder="Your name" required><br>
            <label for="message">Your Message:</label><br>
            <textarea name="message" id="message-write" cols="86" rows="5"></textarea><br>
            <input type="submit" name="submit" value="Send" style="padding: 10px 25px; background-color: blue; color: white;">
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $message = $_POST['message'];

            $query = "INSERT INTO tbl_chat (name, message) VALUES ('$name','$message')";
            $run = $con->query($query);
            if ($run) {
                echo "<embed loop='false' src='plink.wav' hidden='true' autoplay='true'/>";
            }
        }
        ?>
    </div>
</div>
    
</body>
</html>
