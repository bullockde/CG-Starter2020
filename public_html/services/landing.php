<!DOCTYPE html>
<html lang="en">
<?php

  include "../src/crutchphp/config.php";

  $head_title = "Website Design By Computer Guy";
  $metadesc="Website Design By Computer Guy";

  include '../includes/head.php';

?>
<body>
  <div class="content-wrapper">
    
    <?php include '../includes/header.php'; ?>

    <?php 

      $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

      mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());

      if( empty( $_GET["id"] ) ){
        $id = 274;
        }
        else{ 
            $id = mysqli_real_escape_string( $link, $_GET["id"] );
        }

      

      //echo $id;

      $query = "SELECT * FROM blogs WHERE id='$id'";

      $result = mysqli_query( $link, $query );

      $row = mysqli_fetch_array($result);

      //var_dump( $row );

      $img_locs = array();

      $query2 = "SELECT * FROM blog_images WHERE blog_id='$id'";

      $result2 = mysqli_query( $link, $query2 );

      while($row2=mysqli_fetch_array($result2)){ $img_locs[] = $row2['location']; }

  ?>
    
    <div class="wrapper light-wrapper">
      <div class="container inner pt-60">
        <div class="boxed">
          <div class="bg-white shadow rounded">
            <div class="image-block-wrapper">
              <div class="row">
                <div class=" col-lg-6">
                  <img class="" src="<?php echo $site_base; ?><?php echo $img_locs[0]; ?>">
                </div>
                <div class="col-lg-6">
                      
                    <div class="align-self-center">
                      <h3 class="mb-20"><?php echo $row["title"]; ?></h3>
                      <p class="lead"><?php echo $row["headline"]; ?></p>
                      <p><?php echo $row["content"]; ?></p>

                      <div class="text-center">
                          <a href="#" class="btn btn-blue btn-l shadow mt-20">Call Now!</a>
                      </div>

                    
                    </div>
                 
                  <!-- /.box -->
                </div>
                  <!--/column -->
              </div>
              <!--/.image-block -->
            
              <!--/.container-fluid -->
            </div>
            <!--/.image-block-wrapper -->
          </div>
          <!-- /.bg -->
        </div>
        <!-- /.boxed -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.wrapper -->
  
    
    <?php include "../includes/footer.php"; ?>

  </div>
  <!-- /.content-wrapper -->
  
  <?php include "../includes/scripts.php"; ?>

</body>
</html>