<?php include('../includes/config.php'); 
    if(isset($_POST['delete_id']))
    {   global $con;
        $id=$_POST['delete_id'];
       
        $delete_query="DELETE FROM user WHERE id=$id";
        $con->query( $delete_query);

    }


header("location: users.php");
exit;
?>