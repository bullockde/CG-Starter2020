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



    <div class="wrapper light-wrapper">
      <div class="container inner pt-60">
        <div class="blog classic-view">
     


    <?php

        $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

        mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());

        $id = mysqli_real_escape_string( $link, $_GET["id"] );

        //echo $id;

        $query = "SELECT * FROM blogs WHERE id='$id'";

        $result = mysqli_query( $link, $query );

        $row = mysqli_fetch_array($result);

        //var_dump( $row );

        $img_locs = array();

        $query2 = "SELECT * FROM blog_images WHERE blog_id='$id'";

        $result2 = mysqli_query( $link, $query2 );

        while($row2=mysqli_fetch_array($result2)){ $img_locs[] = $row2['location']; }

        //var_dump($img_locs);

    ?>

          <div class="post text-center">
            <figure class="rounded"><img src="../../<?php echo $img_locs[0]; ?>" alt="" /></figure>
            <div class="space40"></div>
            <div class="row post-content text-left">
              <div class="col-md-8 offset-md-2">
                <h1 class="post-title"><?php echo $row["title"]; ?></h1>
                <div class="meta"><span class="date"><?php echo date("F d, Y", strtotime($row["created"])); ?></span><span class="author">By <a href="#">Missio</a></span><!--<span class="comments"><a href="#">2</a></span>--><span class="category"><a href="#">Journal</a></span></div>
                <p><?php echo $row["content"]; ?></p>
                <div class="space10"></div>

              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.post -->


        </div>
        <!-- /.blog -->
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