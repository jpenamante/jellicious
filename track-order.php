<?php
session_start();
include_once 'includes/config.php';
$oid=intval($_GET['oid']);

if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{
    if(isset($_POST['delivered'])) {
    $status=$_POST['status'];
    $remark=$_POST['remarks'];//space char

    $query=mysqli_query($con,"insert into ordertrackhistory(orderId,status,remark) values('$oid','$status','$remark')");
    $sql=mysqli_query($con,"update orders set orderStatus='$status' where id='$oid'");
    echo "<script>alert('Order Received...'); window.close(); </script>";

    }
}
?>
<?php date_default_timezone_set('Asia/Hong_Kong'); ?>
<script language="javascript" type="text/javascript">
function f2() {
    window.close();
}


function f3() {
    window.print();
}
</script>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Order Tracking Details</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link href="anuj.css" rel="stylesheet" type="text/css">
    <style>
    .base-timer {
        position: relative;
        width: 300px;
        height: 300px;
        margin: auto;
    }

    .base-timer__svg {
        transform: scaleX(-1);
    }

    .base-timer__circle {
        fill: none;
        stroke: none;
    }

    .base-timer__path-elapsed {
        stroke-width: 7px;
        stroke: grey;
    }

    .base-timer__path-remaining {
        stroke-width: 7px;
        stroke-linecap: round;
        transform: rotate(90deg);
        transform-origin: center;
        transition: 1s linear all;
        fill-rule: nonzero;
        stroke: currentColor;
    }

    .base-timer__path-remaining.green {
        color: rgb(65, 184, 131);
    }

    .base-timer__path-remaining.orange {
        color: orange;
    }

    .base-timer__path-remaining.red {
        color: red;
    }

    .base-timer__label {
        position: absolute;
        width: 300px;
        height: 300px;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }
    </style>
</head>

<body>

    <div style="margin:2rem 50px;">
        <form method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr height="50">
                    <td colspan="2" class="fontkink2" style="padding-left:0px;">
                        <div class="fontpink2"> <b>Order Tracking Details !</b></div>
                    </td>

                </tr>
                <tr height="30">
                    <td class="fontkink1"><b>Order Number:</b></td>
                    <td class="fontkink"><?php echo $oid;?></td>
                </tr>
                <?php 
$ret = mysqli_query($con,"SELECT *, orders.estimation FROM ordertrackhistory inner join orders on ordertrackhistory.orderId = orders.id  WHERE orderId='$oid'");
$num=mysqli_num_rows($ret);
if($num>0)
{
    $remaining_seconds = 0;
    $current_status = '';
while($row=mysqli_fetch_array($ret))
      {
     ?>



                <tr height="20">
                    <td class="fontkink1"><b>At Date:</b></td>
                    <td class="fontkink"><?php echo $row['postingDate'];?></td>
                    <?php $current_status = strtolower($row['status']); if (strtolower($row['status']) == 'in process') { $remaining_seconds = ($row['estimation']) - (time() - strtotime($row['postingDate'])); } ?>
                </tr>
                <tr height="20">
                    <td class="fontkink1"><b>Status:</b></td>
                    <td class="fontkink"><?php echo $row['status'];?></td>
                </tr>
                <tr height="20">
                    <td class="fontkink1"><b>Remark:</b></td>
                    <td class="fontkink"><?php echo $row['remark'];?></td>
                </tr>


                <tr>
                    <td colspan="2">
                        <hr />
                    </td>
                </tr>
                <?php }
    $isProcessed = true;
}

else{
    $isProcessed = false;
   ?>
                <tr>
                    <td colspan="2" style="padding:1rem 0; color: salmon;"><i>Order Not Process Yet</i></td>
                </tr>
                <?php  }
$st='Delivered';
   $rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
     while($num=mysqli_fetch_array($rt))
     {
     $currrentSt=$num['orderStatus'];
   }
     if($st==$currrentSt)
     { ?>
                <tr>
                    <td colspan="2"><b>
                            Product Delivered successfully </b></td>
                    <?php } 
 
  ?>
            </table>

        </form>
        <div id="timer"></div>
        <?php if ($isProcessed == true) {?>
        <form style="text-align: center; margin: 1em;" method=post 
                            onsubmit="return confirm('Are you sure you want to received your item?');">
            <input type=hidden name=orderid value='<?php echo $oid ?>'/>
            <input type=hidden name=status value='Delivered'>
            <input type=hidden name=remarks value='Received By Customer'>
            <input type=submit value=Received name=delivered>
        </form>
        <?php } ?>
    </div>


    <script>
    // Credit: Mateusz Rybczonec

    const FULL_DASH_ARRAY = 283;
    const WARNING_THRESHOLD = 10;
    const ALERT_THRESHOLD = 5;

    const COLOR_CODES = {
        info: {
            color: "green"
        },
        warning: {
            color: "orange",
            threshold: WARNING_THRESHOLD
        },
        alert: {
            color: "red",
            threshold: ALERT_THRESHOLD
        }
    };

    const TIME_LIMIT = <?php echo round($remaining_seconds); ?>;
    let timePassed = 0;
    let timeLeft = TIME_LIMIT;
    let timerInterval = null;
    let remainingPathColor = COLOR_CODES.info.color;

    document.getElementById("timer").innerHTML = `
    <div class="base-timer">
      <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <g class="base-timer__circle">
          <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
          <path
            id="base-timer-path-remaining"
            stroke-dasharray="283"
            class="base-timer__path-remaining ${remainingPathColor}"
            d="
              M 50, 50
              m -45, 0
              a 45,45 0 1,0 90,0
              a 45,45 0 1,0 -90,0
            "
          ></path>
        </g>
      </svg>
      <span id="base-timer-label" class="base-timer__label">${formatTime(
        timeLeft
      )}</span>
    </div>`;

    startTimer();

    function onTimesUp() {
        clearInterval(timerInterval);
    }

    function startTimer() {
        if (TIME_LIMIT <= 0) {
            if ('<?php echo $current_status; ?>' == 'in process') {
                alert('Your item for delivery is passed due, please understand and wait as possible, thank you!');
            }
            document.getElementById('timer').style.display = 'none';
        }
        timerInterval = setInterval(() => {
            timePassed = timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            document.getElementById("base-timer-label").innerHTML = formatTime(
                timeLeft
            );
            setCircleDasharray();
            setRemainingPathColor(timeLeft);

            if (timeLeft <= 0) {
                onTimesUp();
            }
        }, 1000);
    }

    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        if (seconds < 10) {
            seconds = `0${seconds}`;
        }

        return `${minutes}:${seconds}`;
    }

    function setRemainingPathColor(timeLeft) {
        const {
            alert,
            warning,
            info
        } = COLOR_CODES;
        if (timeLeft <= alert.threshold) {
            document
                .getElementById("base-timer-path-remaining")
                .classList.remove(warning.color);
            document
                .getElementById("base-timer-path-remaining")
                .classList.add(alert.color);
        } else if (timeLeft <= warning.threshold) {
            document
                .getElementById("base-timer-path-remaining")
                .classList.remove(info.color);
            document
                .getElementById("base-timer-path-remaining")
                .classList.add(warning.color);
        }
    }

    function calculateTimeFraction() {
        const rawTimeFraction = timeLeft / TIME_LIMIT;
        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
    }

    function setCircleDasharray() {
        const circleDasharray = `${(
    calculateTimeFraction() * FULL_DASH_ARRAY
  ).toFixed(0)} 283`;
        document
            .getElementById("base-timer-path-remaining")
            .setAttribute("stroke-dasharray", circleDasharray);
    }
    </script>
</body>

</html>