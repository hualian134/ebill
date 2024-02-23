<?php
    session_start();
    //Load Composer's autoloader
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    
    require 'phpmailer/src/SMTP.php';
    $valid= email_valid('zawkhantwin134@gmail.com');
    echo $valid;
    function email_valid($email){
    
    try{
        $mail = new PHPMailer(true);
        //Create an instance; passing `true` enables exceptions
        $_SESSION['verify']=rand(100000, 999999);
        $mail->From='electricitybilling37@example.com';
        $mail->FromName="Electricity Billing";
        $mail->addAddress($email);
        //$mail->addReplyTo("zawkhantwin@gmail.com","Zaw");
        
        $mail->Subject = 'Verification Code';
        $mail->Body    = 'The verification code is: '.$_SESSION['verify'];
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();

        return true;
        
       
    
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if($valid){
echo "<script>
//window.open('popup.php','','width=600/ 2,height=600 / 2');
let url = 'popup.php';
let height = 600;
let width = 600;
var left = (screen.width - width) / 2;
var top = (screen.height - height) / 2;

let popup=window.open(url, 'popUpWindow', 'height=' + height + ', width=' + width + ', top=' + top + ', left=' + left);

</script>";
}
?>
