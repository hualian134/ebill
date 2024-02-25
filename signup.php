<!-- NOTE
SINGLE PAGE FORM ALONG WITH VALIDATION
NO PHP LEAKS BACK TO THE INDEX 
 -->
<?php

include('Includes/config.php');

require_once("Includes/session.php");

//$nameErr = $phoneErr = $addrErr = $emailErr = $passwordErr = $confpasswordErr = "";
//$name = $email = $password = $confpassword = $address = "";
global $error;
global $message;
$error=array();
$message=array();
//$flag=0;

//CHECK IF A VALID FORM STRING
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
if(isset($_POST["reg_submit"])) {
       
        $email = test_input($_POST['email']); 
        $password = test_input($_POST["inputPassword"]);
        $confpassword = test_input($_POST["confirmPassword"]);
        $address = test_input($_POST["address"]);
        $phone=$_POST["contactNo"];
        $name = test_input($_POST["name"]);


        $_SESSION['verfiy_email']=$email;
        $_SESSION['verfiy_password']=$password;
        $_SESSION['verfiy_address']=$address;
        $_SESSION['verfiy_phone']=$phone;
        $_SESSION['verfiy_name']=$name;
        
        if(empty($email) OR empty($password) OR empty($confpassword) OR empty($address) OR empty($name) OR empty($phone)){
            array_push($error,'Fill all field');
        }else{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    array_push($error,"Invalid email");
                }
                if(is_numeric($name)){
                    array_push($error,"Invalid name");
                }
                if (strlen($name)<3){
                    array_push($error,"Name  must be at least 3 characters long");
                }
                $sql="SELECT * FROM user WHERE email='$email'and verify=1";
                $result = mysqli_query($con,$sql);
                $count = mysqli_num_rows($result);
                $result1=mysqli_fetch_assoc($result);
                if($count>0){
                    array_push($error,"Email already exist");
                }
                
                if($password!==$confpassword){
                    array_push($error,"Password not match");                
                }
                if(strlen($password)<8 OR strlen($password)>20){
                    array_push($error,"Password length must be  between 8 to 20");
                }
                if(!preg_match("/^\d{11}$/",$phone)){
                    array_push($error,"11 digit phone number is allowed");
                }
                
                $sql1="SELECT * FROM user where phone='$phone' AND verify=1";
                $result2 = mysqli_query($con,$sql1);
                $count1 = mysqli_num_rows($result2);
                
                if($count1>0){
                    array_push($error,"Phone number is already exist!");
                }
                
                if (empty($error)){
                    $_SESSION['email']=$email;
                    $date=date("Y/M/D");
                    $query = "INSERT INTO user (`name`,`email`,`phone`,`pass`,`address`)
                    VALUES(?,?,?,?,?)";
                    $stmt = mysqli_prepare($con, $query);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $password, $address);
                        if (mysqli_stmt_execute($stmt)) {
                            $update="Update user SET create_date=curdate() Where  name='$name' and email='$email' and phone='$phone'
                                    and pass='$password' and address='$address'";
                            $con->query($update);
                            array_push($message,"Registration successful!");
                            
                            header("Location:verification.php");
                        } else {
                            array_push($error, "Error: " . mysqli_error($con));
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        array_push($error, "Error: " . mysqli_error($con));
                    }
                }
            }
            
           
            
            


        /*$sql1 = "SELECT * FROM user WHERE email='$email'";
        $result1 = mysqli_query($con,$sql1);
        $count = mysqli_num_rows($result1);
        if ($count == 1) {
            $flag=1;
            echo "Already exist";
        }
        // NAME VALIDATION
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $flag=1;
            echo $nameErr;
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed"; 
                $flag=1;
                echo $nameErr;
            }
        }

        // EMAIL VALIDATION
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $flag=1;
            } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
                $flag=1;
                echo $emailErr;
            }
        }

        // PASSWORD VALIDATION
        if (empty($_POST["inputPassword"])) 
        {
            $passwordErr = "PASSWORD missing";
            $flag=1;
        }
        else 
        {
            $password = $_POST["inputPassword"];
        }
        // CONFIRM PASSWORD
        if (empty($_POST["confirmPassword"])) 
        {
            $confpasswordErr = "missing";
            $flag=1;
        }
        else 
        {
            if($_POST['confirmPassword'] == $password)
            {
                $confpassword = $_POST["confirmPassword"];
            }
            else
            {
                $confpasswordErr = "Not same as password!";
                $flag = 1;
            }
        }

        // ADDRESS VALIDATION
        if (empty($_POST["address"])) {
            $addrErr = "Address is required";
            $flag=1;
            echo $addrErr;
        } else {
            $address = test_input($_POST["address"]);
            // check if address only contains letters and whitespace
            // if (!preg_match("/^[a-zA-Z1-9]*$/",$address)) {
            //     $addrErr = "Only letters, numbers and white space allowed";
            //     // $flag=1; 
            //     echo $addrErr;
            // }
        }

        //CONTACT VALIDATION
        if (empty($_POST["contactNo"])) {
            $flag=1;
            $contactNo = "";
            // echo "error here";
        } else {
            $contactNo = $_POST["contactNo"];
            
            $regex = "/^(?:\+?(\d{1,3}))?[-. (]*(\d{1,3})[-. )]*(\d{1,4})[-. ]*(\d{1,9})[-. ]*(\d{1,9})?(?: *x(\d+))?$/";
        
            // Test the phone number against the regular expression
            if (preg_match($regex, $contactNo)) {
                $flag=0;
            } else {
                 $flag=1;
            
        

            //if(!preg_match("/^/d{10}$/", $_POST["contactNo"])){
                $phoneErr="10 digit phone no allowed.";
                // $flag=1;
                // echo "or here";
                //echo $_POST['contactNo'];
            }
        }


        // Only if succeed from the validation thourough put  
        echo $flag; 
        if($flag == 0)
        {
            require_once("Includes/config.php");
            $sql = "INSERT INTO user (`name`,`email`,`phone`,`pass`,`address`)
                    VALUES('$name','$email','$contactNo','$password','$address')";
                    echo $sql;
            if (!mysqli_query($con,$sql))
            {
                die('Error: ' . mysqli_error($con));
            }
            header("Location:index.php");
        }*/
    }
    //if(isset($error)){
       // header("Location:index.php");
        //foreach($error as $e){
          //  echo $e;
        //}
    //}
?>

<?php
    // if(isset($flag)) {
    //     if($flag === 0) {
    //         echo '
    //             <table class="table"> 
    //             <tr class="success">Account Created</tr>
    //             </table>
    //         ';
    //     } elseif ($flag === 1) {
    //         echo '
    //             <table class="table"> 
    //             <tr class="danger">There were errors in the form.</tr>
    //             </table>
    //         ';
    //     } 
    // }
?>
    
