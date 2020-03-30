<?php
  include "../src/crutchphp/config.php";
  if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }

  $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

    $users = "CREATE TABLE IF NOT EXISTS `users` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `name` text COLLATE utf8_unicode_ci NOT NULL,
       `pass` text COLLATE utf8_unicode_ci NOT NULL,
       `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
       `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`)
      ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

      mysqli_query($link,$users);



    if(isset($_POST['new_user'])){

            $name = $_POST['access_login'];
            $pass = $_POST['access_password'];
     
             $query = "INSERT INTO users(name,pass) VALUES('".$name."',PASSWORD('".$pass."'))";
             $tres = mysqli_query( $link, $query);

       }


    $tquery = "SELECT * FROM blog_images WHERE  name='logo'";

    $tres = mysqli_query( $link, $tquery);

    $tnr = mysqli_num_rows($tres);

    $row  = mysqli_fetch_array($tres);

    $logo_url = $row['location'];
  
?>
<!DOCTYPE html>
<html lang="en">
  <?php include "includes/head.php"; ?>

  <body class="light-sidebar-nav">

  <section id="container">
      <!--header start-->
      <?php include "includes/header.php"; ?>
      <!--header end-->
      <!--sidebar start-->
      <?php include "includes/sidebar.php"; ?>
      <!--sidebar end-->
      <!--main content start-->
      <?php include "includes/content-users.php"; ?>
      <!--main content end-->

      <!-- Right Slidebar start -->
      <?php include "includes/right-sidebar.php"; ?>
      <!-- Right Slidebar end -->

      <div class="clearfix"></div>
      <!--footer start-->
      <footer class="site-footer">
          <div class="clearfix"></div>
          <div class="text-center">
              2020 &copy; Administration Advantage By CGPC Solutions
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?php include "includes/scripts.php"; ?>

    <!--script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/count.js"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

      $(window).on("resize",function(){
          var owl = $("#owl-demo").data("owlCarousel");
          owl.reinit();
      });

  </script>

  </body>
</html>
