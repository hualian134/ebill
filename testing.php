 <?php
 include('Includes/config.php');
 $selectDulicateEmail="Select * from user where verify!=1";
                        $result=$con->query($selectDulicateEmail);
                        $row=mysqli_fetch_assoc($result);
                        while(mysqli_num_rows($result)){
                            echo $row['id'];
                        }
?>
                        