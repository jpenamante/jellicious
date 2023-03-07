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
                    <h5 class="modal-title">Get Code</h5>
                    <a href="signup.php">
                        <button type="button" class="close">&times;</button>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="emailverification.php" method="post" onSubmit="return valid();">
                        <label for="email" style="font-weight: bold;">Email Address &nbsp; :</label>
                        <input style="margin-left: 40px;" type="email" name="emailid" id="email">
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
    <script type="text/javascript">
    function valid() {
        return true;
    }
    </script>

</html>