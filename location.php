<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>::Message::</title>
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


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script>
    function ajax() {
        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status == 200) {
                document.getElementById('chat').innerHTML = req.responseText;
            }
        }
        req.open('GET', 'chat.php', true);
        req.send();
    }
    setInterval(function() {
        ajax()
    }, 1000);
    </script>
</head>

<body onload="ajax();">
    <header class="header-style-1">
        <?php include('includes/top-header.php');?>

    </header>
    <div class="page" style="height: 550px; margin-top: 100px; padding: 0 25%">
        <div class="display-box">
            <div id="chat"></div>
        </div>
        <div class="form">
            <form action="" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" style="border-color: transparent;"
                    value="<?php echo htmlentities($_SESSION['username']);?>" placeholder="Your name" required><br>
                <label for="message">Your Message:</label><br>
                <textarea name="message" id="message-write" cols="86" rows="5" required></textarea><br>
                <input type="submit" name="submit" value="Send"
                    class="btn btn-primary">
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