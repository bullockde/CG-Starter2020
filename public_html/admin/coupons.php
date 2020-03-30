<?php
  include "../src/crutchphp/config.php";
  if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }


    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());


  $create_db = "CREATE TABLE IF NOT EXISTS `coupons` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
   `offer` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
   `details` text COLLATE utf8_unicode_ci NOT NULL,
   `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

  mysqli_query($link,$create_db);


  if( isset( $_POST['status'] ) ){

    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $id = $_POST['id'];
    $status_update = "UPDATE leads SET status = '$status', notes = '$notes' WHERE id = '$id'";
    $pgr = mysqli_query($link,$status_update);
  }

  if( isset( $_POST['new_coupon'] ) ){

    $title = $_POST['title'];
        $offer = $_POST['offer'];
        $details = $_POST['details'];


    $query = "INSERT INTO coupons(title,offer,details) VALUES('".$title."','".$offer."' ,'".$details."')";

      mysqli_query($link,$query);

  }

  if( isset( $_POST['update_coupon'] ) ){

    $id = $_POST['id'];
    $title = $_POST['title'];
        $offer = $_POST['offer'];
        $details = $_POST['details'];


    //$query = "INSERT INTO coupons(name,location,message) VALUES('".$name."','".$location."' ,'".$message."')";
    $query = "UPDATE coupons SET title = '$title', offer = '$offer', details = '$details' WHERE id = '$id'";

      mysqli_query($link,$query);

      header('Location:' . $site_base . 'admin/coupons.php');

  }
  
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
      <?php include "includes/content-coupons.php"; ?>
      <!--main content end-->

      <!-- Right Slidebar start -->
      <?php include "includes/right-sidebar.php"; ?>
      <!-- Right Slidebar end -->

      <!--footer start-->
      <footer class="site-footer">
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
