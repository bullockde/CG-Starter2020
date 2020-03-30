<?php
  include "../src/crutchphp/config.php";
  if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }

  $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

  mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());

  $id = $_GET["id"]; 
  
  if(isset($_POST['Delete']) && isset($id)) 
  {
    $query = "DELETE FROM blogs WHERE id='$id'";
    $result = mysqli_query( $link, $query);

    $query2 = "DELETE FROM blog_images WHERE blog_id='$id'";
    $result2 = mysqli_query( $link, $query2);

    if(mysqli_affected_rows( $link ) > 0){
      header("Location: ".$site_base."admin/");
    }else{
      header("Location: ".$site_base."admin/");
    }
  }

  if($id)
  {
    $query = "SELECT * FROM blogs where id='$id'";
    $result = mysqli_query( $link, $query);

    while($row=mysqli_fetch_array($result)){
      $title = stripslashes($row["title"]);
    }

  }

  mysqli_close( $link );
  
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
      <?php include "includes/content-delete.php"; ?>
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
