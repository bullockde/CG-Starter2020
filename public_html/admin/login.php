<?php
  include "../src/crutchphp/config.php";

  $LOGOUT_URL = $site_base;
  $LOGDIN_URL = $site_base."admin/";
  $TIMEOUT_COOKIE = time() + 360 * 60;

  foreach ($_POST as $key => $value) {
    # code...
    //echo $key . " - " . $value;
  }


  function login_form($emsg){

    include "../src/crutchphp/config.php";
    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

    $tquery = "SELECT * FROM blog_images WHERE  name='logo'";

    $tres = mysqli_query( $link, $tquery);

    $tnr = mysqli_num_rows($tres);

    $row  = mysqli_fetch_array($tres);

    $logo_url = $row['location'];

    //echo $logo_url;

  ?>
    <!--
    #######################################
        - THE LOGIN FORM -
    ######################################
    -->

    <!DOCTYPE html>
    <html>
 
      <?php include "includes/head.php"; ?>


      <<body class="login-body">

    <div class="container">

      <form class="form-signin" method="post" >
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <input type="text" name="access_login" class="form-control" placeholder="User ID" autofocus>
            <input type="password" name="access_password" class="form-control" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
            <p>or you can sign in via social network</p>
            <div class="login-social-link">
                <a href="index.html" class="facebook">
                    <i class="fa fa-facebook"></i>
                    Facebook
                </a>
                <a href="index.html" class="twitter">
                    <i class="fa fa-twitter"></i>
                    Twitter
                </a>
            </div>
            <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Forgot Password ?</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>
      </body>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </html>

  <?php
  }

  function clean_data($field)
  {
    $cdata = mysqli_real_escape_string( $link, $field );
    return $cdata;
  }


  if(isset($_POST['access_password']))
  {

    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

    mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());


    $login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
    $pass = $_POST['access_password'];


    $query = "SELECT * FROM users WHERE name = '".$login."' AND `pass` = PASSWORD('".$pass."')";

    $resp = mysqli_query ( $link , $query );


    $qnrs = mysqli_num_rows($resp);
    

    if($qnrs > 0)
    {
      setcookie("verified", md5($login.'%'.$pass), $TIMEOUT_COOKIE, '/');
      setcookie("access_login", $_POST['access_login'], $TIMEOUT_COOKIE, '/');
      
      unset($_POST['access_login']);
        unset($_POST['access_password']);
        unset($_POST['Submit']);

        header("Location: ".$LOGDIN_URL);

    }else{
      login_form("Login Information Not Found!");
    }
    
  }else{
    
    if(isset($_GET['logout']))
    {
      unset($_COOKIE['verified']);
      setcookie("verified", "", $ctimeout, "/");
      header("Location: ".$LOGOUT_URL);
    }else{
      if(!isset($_COOKIE['verified']))
      {
        login_form("");
      }else{
        header("Location: ".$LOGDIN_URL);
      }
    }
  
  }
?>