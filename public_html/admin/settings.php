<?php
  include "../src/crutchphp/config.php";
  if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }

$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

  
  $create_db = "CREATE TABLE IF NOT EXISTS `leads` (
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
     `customer` INT NOT NULL DEFAULT '0',
     `customer_id` INT DEFAULT NULL,
     PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1";

  mysqli_query($link,$create_db);


  if( isset( $_POST['status'] ) ){

    $status = $_POST['status'];
    $notes = $_POST['notes'];
    $customer_id = $_POST['customer_id'];

    $old_notes = $_POST['old_notes'];

    $the_update = $old_notes . "\n" .date('m/d/y g:ia'). " - ";

    if ($_POST['status']) {
      $the_update .= $_POST['status'];
    }else { $the_update .= "Lead Updated"; }
     

    if ( $notes !== "" ) {
      $the_update .= "\n -  " . $notes;
    }
    

    if ( $_POST['status'] == "Clear Notes" ) {
      $the_update = "";
    }

    $notes = $the_update;

    $id = $_POST['id'];
    $status_update = "UPDATE leads SET status = '$status', notes = '$notes', customer_id = '$customer_id' WHERE id = '$id'";

    mysqli_query($link,$status_update);


    if ( $_POST['status'] == "Scheduled" && ($_POST['customer_id'] == 0)  ) {

      $id = $_POST['id'];

      $query = "SELECT * FROM leads WHERE id = $id";

      $result = mysqli_query($link,$query);

      $row=mysqli_fetch_array($result);


      $name = $row['name'];
      $phone = $row['phone'];
      $email = $row['email'];
      $address = $row['address'];
      $city = $row['city'];
      $state = $row['state'];
      $zip = $row['zip'];
          $location = isset($row["location"]) ? $row["location"] : "";
          $message = $row['message'];
          $notes = $row['notes'];
          $customer = 1;

      $query = "INSERT INTO customers(name,phone,email,address,city,state,zip,message,form,notes) VALUES('".$name."','".$phone."','".$email."' ,'".$address."' ,'".$city."','".$state."','".$zip."','".$message."','Admin Dashboard','".$notes."')";

        
        if ($link->query($query) === TRUE) {
          $last_id = $link->insert_id;
          echo "New record created successfully. Last inserted ID is: " . $last_id;
      } else {
          echo "Error: " . $sql . "<br>" . $link->error;
      }

        $status_update = "UPDATE leads SET customer = '$customer', customer_id = '$last_id' WHERE id = '$id'";
        mysqli_query($link,$status_update);

    }

    
  }

  if( isset( $_POST['new_lead'] ) ){

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

    $query = "INSERT INTO leads(name,phone,email,address,city,state,zip,message,form,notes) VALUES('".$name."','".$phone."','".$email."' ,'".$address."' ,'".$city."','".$state."','".$zip."','".$message."','Admin Dashboard','".$notes."')";

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
      <?php include "includes/content-settings.php"; ?>
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
