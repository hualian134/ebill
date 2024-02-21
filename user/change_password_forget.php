<?php 

include('../Includes/config.php');
include("password.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{
    padding: 60px;
    margin: auto;
    
}
h1{
    text-align: center;
    padding-bottom: 35px;
    font-weight:bold;
    color:blue;
    text-shadow: 2px 4px lightskyblue;
    
}


.container{
    padding-top:50px;
    max-width: 600px;
    margin: auto;
    padding: 50px;
    background-color: white(75, 70, 70);
    box-shadow: deepskyblue 0px 7px 29px 0px;
}

.group{
    margin-bottom: 30px;
}
    </style>
</head>
<body>
<div class="container">
        <h1>Forget Password?</h1>
        
    <?php if(isset($_SESSION['error'])){
       // $m=$_SESSION['error'];
        //echo "<div class='alert alert-danger'>$m</div>";
    }?>
    <form action="forget_password.php" method="post">

            <div class="group">
                <label>New Password</label>
                <input type="password" class="form-control" name="new_p" id="new_p" placeholder="">
            </div>
            <div class="group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="c_pass" id="c_pass" placeholder="">
            </div>
        <center>
                    <div class="group">
                        <input type="submit" class="btn btn-primary" value="Update" name="update">        
                        
                    </div>
        </center>  
    </form>

    </div>
    
</body>
</html>