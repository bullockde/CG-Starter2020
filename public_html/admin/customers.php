<?php
  include "../src/crutchphp/config.php";
  if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }


    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

  $create_db = "CREATE TABLE IF NOT EXISTS `customers` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `name` text,
     `email` text,
     `phone` text,
     `address` text,
     `city` text,
     `state` text,
     `zip` int(11) DEFAULT NULL,
     `subject` text,
     `message` text,
     `status` varchar(50) NOT NULL DEFAULT 'pending',
     `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `modified` datetime on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `form` varchar(150) DEFAULT NULL,
     `notes` text,
     `deleted` int(11) DEFAULT '0',
     `appt_date` text,
     `appt_time` text,
     PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1";

    mysqli_query($link,$create_db);

  if( isset( $_POST['status'] ) ){

    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $id = $_POST['id'];
    $status_update = "UPDATE customers SET status = '$status', notes = '$notes' WHERE id = '$id'";
    $pgr = mysqli_query($link,$status_update);
  }

  if( isset( $_POST['new_customer'] ) ){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
        $location = isset($_POST["location"]) ? $_POST["location"] : "";
        $message = $_POST['message'];
        $notes = $_POST['notes'];

    $query = "INSERT INTO customers(name,phone,email,address,city,state,zip,message,form,notes) VALUES('".$name."','".$phone."','".$email."' ,'".$address."' ,'".$city."','".$state."','".$zip."','".$message."','Admin Dashboard','".$notes."')";

      mysqli_query($link,$query);

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
      <?php include "includes/content-customers.php"; ?>
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
