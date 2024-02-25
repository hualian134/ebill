<?php

require_once("Includes/config.php");
include("signup.php");
    //Load Composer's autoloader
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    
        $email=$_SESSION['verfiy_email'];
        $password=$_SESSION['verfiy_password'];
        $address=$_SESSION['verfiy_address'];
        $phone=$_SESSION['verfiy_phone'];
        $name=$_SESSION['verfiy_name'];
        
       
if(isset($_POST["get"]) && !empty($email)){
    try{
        $ver=rand(100000, 999999);
        $_SESSION['varify_code']=$ver;
        $mail = new PHPMailer(true);
        //Create an instance; passing `true` enables exceptions
       
        $mail->From='electricitybilling37@example.com';
        $mail->FromName="Electricity Billing";
        $mail->addAddress($email);
        //$mail->addAddress("zawkhantwin@gmail.com","Zaw");
        
        $mail->Subject = 'Verification Code';
        $mail->Body    = 'The verification code is: '.$_SESSION['varify_code'];
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();

       
        
       
    
    } catch (Exception $e) {
    
}
}
    
if(isset($_POST['confirm'])){
    $verify=$_POST['verify'];
        $set=1;
        if ($verify==$_SESSION['varify_code']){
            $sql="Update user SET verify=$set where name='$name' AND email='$email' and phone='$phone' AND pass='$password' AND address='$address'
                    ORDER BY id desc LIMIT 1";
                    if($con->query($sql)){
                        $query="DELETE  FROM user WHERE email='".$email."' AND  verify!=1";
                        if($con->query($query)){
                         $_SESSION['success']='<script>alert.success("Registration Successful")</script>';
                        header('Location: index.php');
                        }
                    }   
        }
        else{
            $_SESSION['error']="Incorrect verification code";;
        }    
}
/*if($valid){
echo "<script>
//window.open('popup.php','','width=600/ 2,height=600 / 2');
let url = 'popup.php';
let height = 600;
let width = 600;
var left = (screen.width - width) / 2;
var top = (screen.height - height) / 2;

let popup=window.open(url, 'popUpWindow', 'height=' + height + ', width=' + width + ', top=' + top + ', left=' + left);

</script>";
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>
<div class="container">
    
        <h1>Verify Email</h1>
        
    <?php
        if(isset($_SESSION['error'])){
        $e=$_SESSION['error'];
        echo "<div class='alert alert-danger'> $e</div>";
        unset($e);
    }?>
    <form action="verification.php" method="post">

            <div class="group">
            <label>Enter  verification code</label>
                <input type="text" class="form-control" name="verify" id="verify" placeholder="">
            </div>
        <center>
                    <div class="row mx-auto g-3 " >
                       <div class="group">
                            
                            <a href="index.php" class="btn btn-primary btn-lg" >Back</a>
                            
                            <input type="submit" class="btn btn-success btn-lg" value="Comfirm" name="confirm"> 
                            <div>
                            <input type="submit" class="btn btn-dafault btn-lg" value="Send verification code" name="get">
                            </div>
                       </div>   
                    </div>
        </center>
    </form>

    </div>
    
</body>
</html>
