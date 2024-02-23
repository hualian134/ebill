<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //$mail->isSMTP();                                            //Send using SMTP
    //$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    //$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //$mail->Username   = 'electricitybilling37@gmail.com';                     //SMTP username
    //$mail->Password   = 'fgvv vfif iegk yljm';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    //$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
    //$mail->Port       = 587;     
    //Recipients
    //$mail->setFrom('electricitybilling37@gmail.com', 'Electricity Billing');
    //$mail->addAddress('zawkhantwin134@gmail.com', 'Terran');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('electricitybilling37@gmail.com', 'Electricity Billing');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    // $mail->isHTML(true);                                  //Set email format to HTML
    // $mail->Subject = 'Hello';
    // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->From='zawkhantwin@gmail.com';
    $mail->FromName="Zaw";
    $mail->addAddress("zawkhantwin134@gmail.com");
    $mail->addReplyTo("zawkhantwin@gmail.com","Zaw");
    
    $mail->Subject = 'Hello';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}