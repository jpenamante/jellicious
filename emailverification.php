<?php
session_start();
error_reporting(0);
include('includes/config.php');

$email=$_POST['emailid'];
$SixDigitRandomNumber = rand(100000,999999);

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Alllow-Headers, Content-Type, Acess-Control-Allow-Methods, Authorization");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

$data = json_decode(file_get_contents("php://input"), true);
//Declared variables for patient
try {
    //Server settings
    $mail->SMTPDebug = 2; //Enable verbose debug output
    $mail->isSMTP();  //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';  //Set the SMTP server to send through
    $mail->SMTPAuth   = true; //Enable SMTP authentication
    $mail->Username   = 'noreply@jellicious.empatechph.com'; //SMTP username
    $mail->Password   = 'Bwwehezdzjyzxzgs123.';                               //SMTP password
    $mail->SMTPSecure = 'tls';   //Enable implicit TLS encryption
    $mail->Port       = 587;   //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('noreply@jellicious.empatechph.com');
    $mail->addAddress($email);     //Add a recipient             //Name is optional
    $mail->addReplyTo('noreply@jellicious.empatechph.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Jellicious';
    $mail->Body    =  ' 
    <html> 
    <body> 
        <h2>Verify your email address to complete your registration</h2> 
        <h4>To finish setting up your account, we just need to make sure that this email address is yours.</h4>
        <h4>To verify your email address use this security code: <b>'.$SixDigitRandomNumber.'</b></h4>
        <br>
        <h4>Thankyou</h4>
    </body> 
    </html>';
    
              
    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    if (isset($_POST['fullname']) === true) {
        $name=$_POST['fullname'];
        $contactno=$_POST['contactno'];
        $password=md5($_POST['password']);
        $query=mysqli_query($con,"insert into users(name,email,contactno,password,verifynum) values('$name','$email','$contactno','$password','$SixDigitRandomNumber')");
        
    } else {
        $query=mysqli_query($con,"update users set verifynum='$SixDigitRandomNumber' where email='$email'");
    }
    $extra="verify.php";
    $host=$_SERVER['HTTP_HOST'];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

    header("location:http://$host$uri/$extra");
