<?php 
session_start();
                //Load Composer's autoloader
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                use PHPMailer\PHPMailer\Exception;

                require '../phpmailer/src/Exception.php';
                require '../phpmailer/src/PHPMailer.php';
                require '../phpmailer/src/SMTP.php';
                $mail = new PHPMailer(true);
if(isset($_POST['send'])){
    $email=$_POST['email'];
    if(!empty($email)){
            $query="SELECT * from user where email='$email'";
            $result=mysqli_query($con,$query);
            $user=mysqli_fetch_assoc($result);
            $count=mysqli_num_rows($result);
            if($count>0){
                $id=$user['id'];
                $_SESSION['id']=$user['id'];
                $_SESSION['verification'] = rand(100000, 999999);
                //$sql = "UPDATE user SET  pass='$one_time_password' WHERE id=$id";
                //$con->query($sql);
                //$to = $user['email'];
                //$subject = "Verification Code";
                //$message = "Your verification code is: " . $_SESSION['verification'];
                //$headers = "From: ebilling@example.com" . "\r\n";
                //$headers .= "Reply-To: ebilling@example.com" . "\r\n";
                //$headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n";
                //mail($to, $subject, $message, $headers);
                



                try{
                //Create an instance; passing `true` enables exceptions
                
                $mail->From='electricitybilling37@example.com';
                $mail->FromName="Electricity Billing";
                $mail->addAddress($user['email']);
                //$mail->addReplyTo("zawkhantwin@gmail.com","Zaw");
                
                $mail->Subject = 'Verification Code"';
                $mail->Body    = $_SESSION['verification'];
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                echo 'Message has been sent';
                header("Location: verify.php");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
                
                
           
                
            }
            else{
                $_SESSION['fail']='Account does not exist.';
        }
           
    }
        
}
if(isset($_POST['confirm'])){
    $valid=$_POST['valid'];
    $id=$_SESSION['id'];
    $same=$_SESSION['verification'];
    //$query="SELECT pass From user where id=$id";
    //$result=mysqli_query($con,$query);
    //$row=mysqli_fetch_assoc($result);
    if($valid==$same){
        header("location: change_password_forget.php");
    }else{
        $_SESSION['fail']='Incorrect varification code';
        header("location: verify.php");
    }

}
if(isset($_POST['update'])){
    $new_password=$_POST['new_p'];
    $confirm=$_POST['c_pass'];
    $id=$_SESSION['id'];
    if( $new_password== $confirm){
        $sql = "UPDATE user SET  pass='$new_password' WHERE id=$id";
        if($con->query($sql)){
            $_SESSION['success']='<div class="alert alert-success">Your password is Update!</div>';
        }
        
    }

}
?>