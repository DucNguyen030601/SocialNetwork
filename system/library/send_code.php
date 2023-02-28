<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//Create an instance; passing `true` enables exceptions
function SendMail($address)
{
    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sdt0944256436@gmail.com';                     //SMTP username
    $mail->Password   = 'ppaqqbydteqhbxzo';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sdt0944256436@gmail.com', 'Pictogram');
    $mail->addAddress($address);     //Add a recipient

    //Content
    $code = rand(111111,999999);
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verify Your Email';
    $mail->Body    = "Your Verification code is: <b>$code</b>";
    if($mail->send())
    {
    //Session
    $_SESSION['resendcode']=$code;
    return true;
    }
    return false;

}
if(isset($_GET['resendcode']))
{
      if(SendMail($_POST['email']))
      {
        return '<p class="text-sucess">Verification code resended!</p>';
      }
      else
      {
        return '<p class="text-danger">Verification code have not resended!</p>';
      }
}
if(isset($_GET['checkdigitcode']))
{
    $session = $_SESSION['resendcode'];
    $code = $_POST['code'];
    $url = $_POST['url'];
    if($code==$session) 
    {
        if($url=='/pictogram/signin')
        {
            echo 1;
        }
        else echo 2;
    }
    else{
        echo 0;
    }
}
