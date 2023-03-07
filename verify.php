<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration

if(isset($_POST['submit'])) {

    $number=$_POST['number'];
    $email=$_POST['email'];
    $isValid = false;
    $query=mysqli_query($con,"select * from users where verifynum='$number' and email='$email'");
    while($row=mysqli_fetch_array($query))
    {
        $isValid = true;
    }
    if($isValid)
    {
        $sql=mysqli_query($con,"update users set verify=1 where verifynum='$number' and email='$email'");
        $_SESSION['errmsg']="Account Verified !!";
        header("location:login.php");
    }
    else{
        $_SESSION['errmsg']="Wrong Verification Code !!";
    header("location:verify.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
    </script>
</head>

<body>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account Verification - <a href="get-code.php">Get Code</a></h5>
                    <a href="signup.php">
                        <button type="button" class="close">&times;</button>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="verify.php" method="post">
                        <label for="email" style="font-weight: bold;">Email Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                        <input style="margin-left: 40px;" type="email" name="email" id="email" required>
                        <br>
                        <label for="number" style="font-weight: bold;"> Verification Code &nbsp;:</label>
                        <input style="margin-left: 40px;" type="number" name="number" id="number" required>
                        <br>
                        <input
                            style="background-color: blue; border: 2px solid blue; border-radius: 2px; color: white; padding: 2px 10px;"
                            type="submit" name="submit" value="Verify">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>