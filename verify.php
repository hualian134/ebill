<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>
<div class="container">
    
        <h1>Verify Email</h1>
        
    <?php
        if(isset($_SESSION['error'])){
        $e=$_SESSION['error'];
        echo "<div class='alert alert-danger'> $e</div>";
        unset($e);
    }?>
    <form action="verification.php" method="post">

            <div class="group">
            <label>Enter  verification code</label>
                <input type="text" class="form-control" name="verify" id="verify" placeholder="">
            </div>
        <center>
                    <div class="row mx-auto g-3 " >
                       <div class="group">
                            
                            <a href="index.php" class="btn btn-primary btn-lg" >Back</a>
                            
                            <input type="submit" class="btn btn-success btn-lg" value="Comfirm" name="confirm"> 
                            <div>
                                <div>
                                    <input type="submit" class="btn btn-warning" value="Send verification code" name="get">
                                </div>
                            </div>
                       </div>   
                    </div>
        </center>
    </form>

    </div>
    
</body>
</html>
