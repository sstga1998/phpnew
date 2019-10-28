<?php 
session_start();
if (isset($_SESSION["user"]))
    header("location:baiso6.php");
include_once("model/user.php");
$infomation = "";
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $userName = $_REQUEST["email"]; //ở dòng email address đặt name là gì thì ở trong request sẽ đặt theo
    $passWord = $_REQUEST["password"];
    $user = User::authentication($userName, $passWord);
    var_dump($user);
    if ($user!=null){
        //var_dump(serialize($user));
        $_SESSION["user"] =serialize($user);
        header("location:baiso6.php");
    }
    else{
        $infomation="Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Login</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <?php if (strlen($infomation)!=0) {?>
            <div class="alert alert-danger" role="alert">
            <?php 
            echo $infomation; 
            ?>
                </div>
          <?php }?>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>