<?php session_start();
require_once("configs/db_config.php");
include_once("models/System/user.model.php");
$base_url = "cpanel";
//require_once("library/classes/system_log.class.php");

if (isset($_POST["btnSignIn"])) {

  $email = trim($_POST["txtEmail"]);
  $password = trim($_POST["txtPassword"]);
  // echo $email, " ", $password;
  // die();
  //$result=$db->query("select u.id,u.username,r.name from {$tx}users u,{$tx}roles r where r.id=u.role_id and u.username='$username' and u.password='$password'");
  // $result = $db->query("select u.id,u.full_name,u.password,u.email,u.photo,u.mobile,u.role_id,r.role_name role from {$tx}users u,{$tx}roles r where r.id=u.role_id and u.name='$username' and u.inactive=0");


  $user = User::get_user($email);

  if ($user && password_verify($password, $user->password)) {

    $_SESSION["uid"] = $user->id;
    $_SESSION["fname"] = $user->first_name;
    $_SESSION["lname"] = $user->last_name;
    $_SESSION["uphoto"] = $user->image;
    $_SESSION["email"] = $user->email;
    $_SESSION["mobile"] = $user->phone;
    $_SESSION["role_id"] = $user->role_id;
    $_SESSION["urole"] = $user->role;

    header("location:home");
  } else {
    echo "Incorrect username or password";
  }



  //  $now=date("Y-m-d H:i:s");
  //  $log=new System_log("","LOGIN","Successfully logged in user : $uid-$_username",$now);
  //  $log->save();



}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>I-SHOP | Log in (v2)</title>

  <!--favicon-->
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet">
  <script src="assets/js/pace.min.js"></script>

  <!--plugins-->
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <!--bootstrap css-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
  <!--main css-->
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="sass/main.css" rel="stylesheet">
  <link href="sass/dark-theme.css" rel="stylesheet">
  <link href="sass/blue-theme.css" rel="stylesheet">
  <link href="sass/responsive.css" rel="stylesheet">
</head>

<body>
  <!--authentication-->
  <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
    <div class="container-fluid my-5 my-lg-0">
      <div class="row">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
          <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-5">
              <!-- <img src="assets/images/logo1.png" class="mb-4" width="145" alt=""> -->
              <h4 class="fw-bold">Log In Now</h4>
              <p class="mb-0">Enter your credentials to login your account</p>

              <div class="form-body my-5">
                <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                  <div class="col-12">
                    <label for="txtEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="jhon@example.com">
                  </div>
                  <div class="col-12">
                    <label for="txtPassword" class="form-label">Password</label>
                    <div class="input-group" id="show_hide_password">
                      <input type="password" class="form-control border-end-0" name="txtPassword" id="txtPassword" value="12345678" placeholder="Enter Password">
                      <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="chkRemember">
                      <label class="form-check-label" for="chkRemember">Remember Me</label>
                    </div>
                  </div>
                  <div class="col-md-6 text-end"> <a href="auth-basic-forgot-password.html">Forgot Password ?</a>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" name="btnSignIn" class="btn btn-grd-primary">Login</button>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="text-start">
                      <p class="mb-0">Don't have an account yet? <a href="auth-basic-register.html">Sign up here</a>
                      </p>
                    </div>
                  </div>
                </form>
              </div>

              <div class="separator section-padding">
                <div class="line"></div>
                <p class="mb-0 fw-bold">OR SIGN IN WITH</p>
                <div class="line"></div>
              </div>

              <div class="d-flex gap-3 justify-content-center mt-4">
                <a href="javascript:;" class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                  <i class="bi bi-google fs-5 text-white"></i>
                </a>
                <a href="javascript:;" class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-deep-blue">
                  <i class="bi bi-facebook fs-5 text-white"></i>
                </a>
                <a href="javascript:;" class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-info">
                  <i class="bi bi-linkedin fs-5 text-white"></i>
                </a>
                <a href="javascript:;" class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-royal">
                  <i class="bi bi-github fs-5 text-white"></i>
                </a>
              </div>

            </div>
          </div>
        </div>
      </div><!--end row-->
    </div>
  </div>
  <!--authentication-->


  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("bi-eye-slash-fill");
          $('#show_hide_password i').removeClass("bi-eye-fill");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("bi-eye-slash-fill");
          $('#show_hide_password i').addClass("bi-eye-fill");
        }
      });
    });
  </script>

  <script>
    $(function() {

      rememberStatus();

      $('#txtEmail').on("input", function() {
        remember();
      });

      $('#txtPassword').on("input", function() {
        remember();
      });

      $('#chkRemember').click(function() {
        remember();
      });

      function remember() {
        if ($('#chkRemember').is(':checked')) {
          // save username and password
          localStorage.username = $('#txtEmail').val().trim();
          localStorage.pass = $('#txtPassword').val().trim();
          localStorage.chkbox = $('#chkRemember').val();
        } else {
          localStorage.username = '';
          localStorage.pass = '';
          localStorage.chkbox = '';
        }
      }

      function rememberStatus() {
        if (localStorage.chkbox && localStorage.chkbox != '') {
          $('#chkRemember').attr('checked', 'checked');
          $('#txtEmail').val(localStorage.username);
          $('#txtPassword').val(localStorage.pass);
        } else {
          $('#chkRemember').removeAttr('checked');
          $('#txtEmail').val('');
          $('#txtPassword').val('');
        }
      }

    });
  </script>
</body>

</html>