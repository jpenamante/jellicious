<?php
session_start();
include_once 'include/config.php';

if(strlen($_SESSION['rlogin'])==0)
  { 
header('location:index.php');
}
else{
$oid=intval($_GET['oid']);
if(isset($_POST['submit2'])){
$status=$_POST['status'];
$remark=$_POST['remark'];//space char

$query=mysqli_query($con,"insert into ordertrackhistory(orderId,status,remark) values('$oid','$status','$remark')");
$sql=mysqli_query($con,"update orders set orderStatus='$status' where id='$oid'");
echo "<script>alert('Order updated sucessfully...');</script>";

}

 ?>
<?php date_default_timezone_set('Asia/Hong_Kong'); ?>
<script language="javascript" type="text/javascript">
function f2() {
    window.close();
}
ser

function f3() {
    window.print();
}
</script>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Update Order</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="anuj.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div style="margin-left:50px;">
        <form  method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr height="50">
                    <td colspan="2" class="fontkink2" style="padding-left:0px;">
                        <div class="fontpink2"> <b>Update Order !</b></div>
                    </td>

                </tr>
                <tr height="30">
                    <td class="fontkink1"><b>order Id:</b></td>
                    <td class="fontkink"><?php echo $oid;?></td>
                </tr>
                <?php
                  $remaining_seconds = 0;
                  $current_status = '';

                  $ret = mysqli_query($con,"SELECT *, orders.estimation FROM ordertrackhistory inner join orders on ordertrackhistory.orderId = orders.id  WHERE orderId='$oid'");
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
                <?php } ?>
                <?php 
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
                            Product Delivered </b></td>
                    <?php }else  {
      ?>

                <tr height="50">
                    <td class="fontkink1">Status: </td>
                    <td class="fontkink"><span class="fontkink1">
                            <select name="status" class="fontkink" required="required">
                                <option value="">Select Status</option>
                                <option value="In Process">In Process</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                        </span></td>
                </tr>

                <tr style=''>
                    <td class="fontkink1">Remark:</td>
                    <td class="fontkink" align="justify"><span class="fontkink">
                            <textarea cols="50" rows="7" name="remark"></textarea>
                        </span></td>
                </tr>
                <tr>
                    <td class="fontkink1">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="fontkink"> </td>
                    <td class="fontkink"> <input type="submit" name="submit2" value="update" size="40"
                            style="cursor: pointer;" /> &nbsp;&nbsp;
                        <input name="Submit2" type="submit" class="txtbox4" value="Close this Window "
                            onClick="return f2();" style="cursor: pointer;" />
                    </td>
                </tr>
                <?php } ?>
            </table>
        </form>
    </div>
</body>

</html>
<?php } ?>