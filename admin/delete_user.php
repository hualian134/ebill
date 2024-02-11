<?php include('../includes/config.php'); 
    if(isset($_GET['id']))
    {   global $con;
        $id=$_GET['id'];

        $delete_query="DELETE FROM user WHERE id=$id";
        $con->query( $delete_query);

    }


header("location: users.php");
exit;
?>