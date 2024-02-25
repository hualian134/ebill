<?php 

/*include("signup.php");
//Load Composer's autoloader
include("Includes/config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

require 'phpmailer/src/SMTP.php';
//$valid= email_valid('zawkhantwin134@gmail.com');
//echo $valid;
//function email_valid($email){
$email=$_SESSION['email'];
$verify=rand(10000,99999);
try{
    $mail = new PHPMailer(true);
    //Create an instance; passing `true` enables exceptions
   
    $mail->From='electricitybilling37@example.com';
    $mail->FromName="Electricity Billing";
    $mail->addAddress($email);
    //$mail->addReplyTo("zawkhantwin@gmail.com","Zaw");
    
    $mail->Subject = 'Verification Code';
    $mail->Body    = 'The verification code is: '.$verify;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo "SENT";
    
   

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
//}*/
if(isset($_POST['confirm'])){
    $verify1=$_POST['verify'];
        
        if ($verify1 == $_SESSION['verify']){
            $sql="Update user SET verify=1 where email='$email'";
            $con->query($sql);
            $_SESSION['error']="Register Successful!";
            
        }else{
            $_SESSION['error']="Incorrect verification code";;
        }    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{
    padding: 60px;
    margin: auto;
    
}
h1{
    text-align: center;
    padding-bottom: 35px;
    font-weight:bold;
    color:blue;
    text-shadow: 2px 4px lightskyblue;
    
}


.container{
    padding-top:50px;
    max-width: 600px;
    margin: auto;
    padding: 50px;
    background-color: white(75, 70, 70);
    box-shadow: deepskyblue 0px 7px 29px 0px;
}

.group{
    margin-bottom: 30px;
}
    </style>
</head>
<body>
<div class="container">
    
        <h1>Verify Email</h1>
        
    <?php
        if(isset($_SESSION['error'])){
        $e=$_SESSION['error'];
        echo "<div class='alert alert-danger'> $ ['error']</div>";
        //unset($_SESSION['error']);
    }?>
    <form action="popup.php" method="post">

            <div class="group">
            <label>Enter  verification code</label>
                <input type="text" class="form-control" name="verify" id="verify" placeholder="">
            </div>
        <center>
                    <div class="group">
                        
                        <input type="submit" class="btn btn-success col-lg-3" value="Comfirm" name="confirm">        
                    </div>
        </center>  
    </form>

    </div>
    
</body>
</html>
