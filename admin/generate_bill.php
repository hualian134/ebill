<?php 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php');
    require_once('../Includes/admin.php');

    $aid = $_SESSION['aid'];
    //set dafaulted variables

    $query  = "SELECT curdate() AS bdate , adddate( curdate(),INTERVAL 30 DAY ) AS ddate , user.id AS uid , user.name AS uname FROM user ";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);
    
    $bdate = $row['bdate'];
    $ddate = $row['ddate'];


    // if (isset($_POST['bdate'])) {
    //     $bdate = $_POST['bdate'];
    // }
    // if (isset($_POST['ddate'])) {
    //     $ddate = $_POST['ddate'];    }
    if (isset($_POST['uid'])) {
        $uid = $_POST['uid'];
    }if (isset($_POST['cunits'])) {
        $cunits = round($_POST['cunits']); 
        
        
    }if (isset($_POST['uname'])) {
        $uname = $_POST['uname']; 
    }

    if (isset($_POST['generate_bill'])) {
        if(isset($_POST["cunits"]) && !empty($_POST["cunits"]))
        {   

// CONVERTING UNITS TO AMOUNT
$queryforpunit="SELECT current_unit from bill,user where user.id=bill.uid And user.id=$uid  ORDER BY bill.id DESC Limit 1 ;" ;
$punit=mysqli_query($con, $queryforpunit);
$punit1=mysqli_fetch_assoc($punit);
            $punits=$punit1['current_unit'];
            if($punits==null) $punits=0;
        if($cunits>$punits){
                $units=$cunits-$punits;
                $query1 = "call unitstoamount({$units} , @x)";
                $result1 = mysqli_query($con,$query1);  

    // INSERTING VALUES INTO BILL
                $query  = " INSERT INTO bill (aid , uid , previous_unit , current_unit , units , amount , status , bdate , ddate )";
                $query .= " VALUES ( {$aid} , {$uid} ,{$punits},{$cunits}, {$units} , @x , 'PENDING' , '{$bdate}' , '{$ddate}' )";
                $result2 = mysqli_query($con,$query);  
                if (!mysqli_query($con,$query1))
                {
                    die('Error: ' . mysqli_error($con));
                }
    
// INSERTING VALUES INTO TRANSACTION            

            $query2 = "SELECT id , amount FROM bill WHERE aid={$aid} AND uid={$uid} AND units={$units} ";
            $query2 .= "AND status='PENDING'  AND bdate='{$bdate}' AND ddate='{$ddate}' ";

            $result3 =mysqli_query($con,$query2);
            if (!mysqli_query($con,$query2))
            {
                die('Error: ' . mysqli_error($con));
            } 

            $row = mysqli_fetch_row($result3);

            $bid = $row[0];$amount=$row[1];
            insert_into_transaction($bid,$amount);
            
        }  
    }
}else
{
    $_SESSION['generate_error']='Generate bill error';
}
    header("Location:bill.php");
?>