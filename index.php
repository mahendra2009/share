<?php
ob_start();
session_start();
require_once( 'library/conn.php' ); 
require_once( 'library/class.db.php' );


include('include/constants.php');

$database = new DB();

if(isset($_SESSION['user_email']))

{

  header('location:dashboard.php');

exit;

}

?>

<?php

if(isset($_POST['submit']))

 {

   $name=$_POST['user_name'];

   $passowrd=md5($_POST['pass']);

   

   

 

if(isset($_POST['remember'])) {

$year = time() + 31536000;

setcookie('remember_me', $_POST['user_name'], $year);

}

elseif(!$_POST['remember']) {

  if(isset($_COOKIE['remember_me'])) {

    $past = time() - 100;

    setcookie(remember_me, gone, $past);

  }

}



$query = "SELECT * FROM see_users WHERE user_email='".$name."' AND user_pass ='".$passowrd."'";

if( $database->num_rows( $query ) > 0 )

{

    $_SESSION['user_email']=$name;

      header('location:dashboard.php');

      exit;

}

else

{

header('location:index.php?msg=1');

exit;

}

 

 

 }

?>

<!doctype html>
<html class="home1">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>  
    <script src="assets/js/jquery.min.js"></script>
    <link href="assets/css/style-front.css" rel="stylesheet" type="text/css">
    <style type="text/css" media="screen">

    body{ background-color: #024484; }
      .login_panels {
    background-color: #fff;}
    .banner2 h3, .banner_hing{ color: #333; }
    </style>
    </head>
    <body   class=" nav_white ">
    
<div class="banner2"   > 
      <div class="container">
    <div class="row  login_form">
          <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="login_panels">
              <div class="rows"> 
            <h3 style="margin:10px 0;">ADMIN  LOGIN</h3>
         <?php

if(isset($_GET['err']))

{

 echo '<div class="alert alert-danger fade in" role="alert"><a href="#" data-dismiss="alert" class="close">×</a>Access Denied From Administrator</div>';

}



if(isset($_GET['msg']))

{

 echo '<div class="alert alert-danger fade in" role="alert"><a href="#" data-dismiss="alert" class="close">×</a>Username and Password Not Correct</div>';

}





?> 
<form class="form-signin" role="form" action="" method="post">
  



            <div class="form-group"  >
                <div class="  place_type2"><i class="fa fa-envelope"></i>
                      <input type="text"  id="useremail" class="form-control"   placeholder="Enter your email id" name="user_name" value="<?php if(isset($_COOKIE['remember_me'])){echo $_COOKIE['remember_me']; }?>" required autofocus maxlength="50">
                    </div>
                <span class="text-danger white"  > </span> </div>


 

<div class="form-group"   >
                <div class="  place_type2"><i class="fa fa-lock"></i>
                      <input type="password" id="password" class="form-control" placeholder="Password" name="pass" required>
                    </div> </div>


 
        <label class="checkbox  "> <input type="checkbox" name="remember" value="1" <?php if(isset($_COOKIE['remember_me'])) {

    echo 'checked="checked"';

  }

  else {

    echo '';

  }

  ?>> Remember me

        </label>

        <input type="hidden" name="submit" >
  <button class="btn btn-success   form-control" id="login_button" type="submit"><i class="fa fa-lock"></i> Log In</button>

        

      </form>

                 
            
          </div>
            </div>
      </div>
        </div>
  </div>
    </div> 
 
<script type="text/javascript">
 $(document).ready(function(){
$('#login_button').click(function () {
    var useremail=$("#useremail").val();
    var password=$("#password").val();

    if(useremail!="" && password!=""){ }
    else{
        alert('Please Enter Login Details');
          return false;
    }
  
}); 

  });

</script>


</body>
</html>