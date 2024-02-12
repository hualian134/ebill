<?php 
require_once('../Includes/config.php');

if(isset($_POST['rate_change'] ) && isset($_POST['unitrate'])){
    $rate=$_POST['unitrate'];
    $update_rate="UPDATE unitsrate SET rate=$rate";
    $con->query($update_rate);
    header("location: index.php");
    exit;
}
else{
    header("location: index.php");
}

?>

