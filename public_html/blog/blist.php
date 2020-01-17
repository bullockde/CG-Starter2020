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
        
        <h1>Blog</h1>

        <div class="blog classic-view">


          <?php 
                    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

                    mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());


                    // page check
                    $pguery = "SELECT * FROM blogs ORDER BY created DESC";
                    $pgr = mysqli_query( $link, $pguery);
                    $pgnr = mysqli_num_rows($pgr);
                    $pcount = (int)ceil($pgnr/3);

                    //var_dump($pgr);

                    if($_GET["page"])
                    { 
                      if($_GET["page"] > $pcount)
                      {
                        $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 3";
                      }else{
                        $plim = (intval($_GET["page"])-1) * 3;
                        $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT ".$plim." , 3";
                      }
                    }else{
                      $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 3";
                    }

                    $result = mysqli_query( $link, $query);
                    $num_rows = mysqli_num_rows($result);

                    $blog_html = "";

                    $blog_row_count = 0;
                    while($row=mysqli_fetch_array($result)){


                      $img_loc = null;
                        $query2 = "SELECT * FROM blog_images WHERE blog_id='" . $row["id"] . "' LIMIT 1";
                        $result2 = mysqli_query($link,$query2);
                        while ($row2 = mysqli_fetch_array($result2))
                      {
                        $img_loc = $row2['location'];
                      }
                      ?>


                      
                       <div class=" post card text-center">

                          <?php if ( !empty( $row["youtube_url"] ) ) {
                           ?>
                              <div class="player" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo $row["youtube_url"]; ?>"></div>
                           <?php
                          } else {
                           ?>
                             <figure class="overlay overlay1 rounded"><a href="<?php echo urlencode(str_replace(' ', '-', $row[title])); ?>/<?php echo $row[id]; ?>"><img src="<?php echo $site_base . $img_loc; ?>" alt="" /></a>
                            </figure>
                           <?php
                          }
                          ?>

                          

                          


                          <div class="space40"></div>
                          <div class="row post-content text-center">
                            <div class="col-md-8 offset-md-2">
                              <h2 class="post-title text-center"><a href="<?php echo urlencode(str_replace(' ', '-', $row[title])); ?>/<?php echo $row[id]; ?>"><?php echo $row["title"]; ?></a></h2>
                              <div class="meta text-center"><span class="date"><?php echo date("F d, Y", strtotime($row["created"])); ?></span><span class="author">By <a href="#"><?php echo $row["created_by"]; ?></a></span>

                                <!--<span class="comments"><a href="#">2</a></span>-->

                                <span class="category"><a href="#">Journal</a></span></div>


                               <?php

                                  if(strlen($row["content"]) > 3750){

                                    $pos=strpos($row["content"], ' ', 375);

                                    $bcontent = substr($row["content"],0,$pos).'...'; 

                                  }else{

                                    $bcontent = $row["content"];

                                  }

                                ?>
                              <p><?php echo $bcontent; ?></p>
                              <div class="text-center"><a href="<?php echo urlencode(str_replace(' ', '-', $row[title])); ?>/<?php echo $row[id]; ?>" class="btn btn-white shadow mt-20">Read more</a></div>
                            </div>
                            <!-- /column -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.post -->
                        <div class="divider-icon w300"><i class="si-photo_aperture"></i></div>




                      <?php
                    }
                  ?>


        </div>
        <!-- /.blog -->

        
                    <!-- Pagination -->


                    <?php
                        if ($_GET["page"]) {

                            $pg = $_GET["page"];

                        } else {

                            $pg = 1;

                        }
                    ?>

                    <ul class="pagination ">
                         

                    <?php


                        if ($_GET["tag"]) {

                            $query = "SELECT * FROM blogs WHERE tags LIKE '%" . mysqli_escape_string($_GET["tag"]) . "%' ORDER BY created DESC";

                        } else {

                            $query = "SELECT * FROM blogs ORDER BY created DESC";

                        }


                        $result = mysqli_query( $link, $query);

                        $num_rows = (int)mysqli_num_rows($result);

                        $plinks = "";

                        $pcnt = (int)ceil($num_rows / 3);

                        $ndpg = 5; // pagination limit for area of pages to show inbetween dots



                        if ($pg > $pcnt) {

                          $pg = 1;

                        }


                        
                        if($pg > 1)

                        {

                          if($_GET["tag"])

                          {

                            echo '<li><a href="?page='.($pg-1).'&tag='.$_GET["tag"].'"><i class="bi bi-arrow-left-rounded" aria-hidden="true"></i></a></li>';

                          }else{

                            echo '<li><a href="?page='.($pg-1).'"><i class="bi bi-arrow-left-rounded" aria-hidden="true"></i></a></li>';

                          }

                        }
                        


                        for ($i = 1; $i <= $pcnt; $i++) {


                            if($i == 1 || $i == $pcnt || ($i >= $pg - $ndpg && $i <= $pg + $ndpg)){

                              if ($i == $pg) {

                                  if ($_GET["tag"]) {

                                      $plinks .= "<li class='active'><a href=\"?page=" . $i . "&tag=" . $_GET["tag"] . "\" class=\"page-link\">" . $i . "</a></li>";

                                  } else {

                                      $plinks .= "<li><a href=\"?page=" . $i . "\" class=\" page-link\">" . $i . "</a></li>";

                                  }



                              } else {

                                  if ($_GET["tag"]) {

                                      $plinks .= "<li><a href=\"?page=" . $i . "&tag=" . $_GET["tag"] . "\" class=\"page-link\">" . $i . "</a></li>";

                                  } else {

                                      $plinks .= "<li><a href=\"?page=" . $i . "\" class=\"page-link\">" . $i . "</a></li>";

                                  }

                              }



                            }else if($i % 4 == 0){

                              $plinks .= ".".($i == $pcnt);

                            }

                        }

                        echo $plinks;


                        
                        if(($pg+1) < $pcnt){

                          if($_GET["tag"])

                          {

                            echo '<li><a href="?page='.($pg+1).'&tag='.$_GET["tag"].'"><i class="bi bi-arrow-right-rounded" aria-hidden="true"></i></a></li>';

                          }else{

                            echo '<li><a href="?page='.($pg+1).'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';

                          }

                        }

                    ?> 

                       

                    </ul>

                    <!-- End Pagination -->
                
        
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