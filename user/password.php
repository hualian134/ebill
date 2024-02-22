<?php 
session_start();

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
                $to = $user['email'];
                $subject = "Verification Code";
                $message = "Your verification code is: " . $_SESSION['verification'];
                $headers = "From: ebilling@example.com" . "\r\n";
                $headers .= "Reply-To: ebilling@example.com" . "\r\n";
                $headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n";
                mail($to, $subject, $message, $headers);
                header("Location: verify.php");
                
           
                
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
        header("location: forget_password.php");
    }

}
if(isset($_POST['update'])){
    $new_password=$_POST['new_p'];
    $confirm=$_POST['c_pass'];
    $id=$_SESSION['id'];
    if( $new_password== $confirm){
        $sql = "UPDATE user SET  pass='$new_password' WHERE id=$id";
        if($con->query($sql)){
            header('location: ../index.php');
        }
        
    }

}
?>