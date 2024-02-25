<!-- NOTE
SINGLE PAGE FORM ALONG WITH VALIDATION
NO PHP LEAKS BACK TO THE INDEX 
 -->
<?php
  require_once("Includes/config.php");
  require_once("Includes/session.php");
  /*if(!(isset($_POST['email']&&isset($_POST['pass'])))) {
    location('index.php');
  }*/
   // if ($count === 0) {
  // echo "There were some problem";
// }
  ?>

<form action="" class="navbar-form navbar-right" role="form" method="post">
    <div class="form-group">
        <input type="text" placeholder="Email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" placeholder="Password" name="pass" id="pass" class="form-control">
    </div>
    <button type="login_submit" class="btn btn-success" onclick=" validateForm();">Sign In</button>
    <button  class="btn btn-warning" onclick="forgetpassword();">Forget Passsword?</a></button>
</form>

<script>
//window.open('popup.php','','width=600/ 2,height=600 / 2');
function forgetpassword(){
let url = 'user/forget_password.php';
let height = 600;
let width = 600;
var left = (screen.width - width) / 2;
var top = (screen.height - height) / 2;

let popup=window.open(url, 'popUpWindow', 'height=' + height + ', width=' + width + ', top=' + top + ', left=' + left);
}
</script>

