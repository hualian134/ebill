<?php  
include("../Includes/config.php") ;                                           
$queryforpunit="SELECT current_unit from bill,user where user.id=bill.uid And user.id=21 and ddate < curdate() Limit 1;" ;
$punit=mysqli_query($con, $queryforpunit);
$row2 = mysqli_fetch_assoc($punit);
if($row2['current_unit']==null){
    echo $row2['current_unit']=0;
}
else{
echo $row2['current_unit'];
}                       
?>