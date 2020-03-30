<?php $page_title = "Coupons"; ?>
<section id="main-content">



          <section class="wrapper">
            <div class="container-fluid">



    <h2>
      <?php echo $page_title; ?><br>
      <!--<a href="<?php echo $site_base; ?>admin/archives.php" class="pull-right btn btn-default" >Go to Archives >></a>-->
    </h2><br>

    <?php 

      if( isset($_GET['edit']) ){

        $id = $_GET['id'];
        $pguery = "SELECT * FROM coupons WHERE id = $id";

      }else{
        // page check
        $pguery = "SELECT * FROM coupons ORDER BY id DESC";
      }
      
      $pgr = mysqli_query($link,$pguery);
      $pgnr = mysqli_num_rows($pgr);
      $pcount = (int)ceil($pgnr/8);
      
      if( isset($_GET["page"]) )
      { 
        if($_GET["page"] > $pcount)
        {
          $query = "SELECT * FROM coupons ORDER BY id DESC";
        }else{
          $plim = (intval($_GET["page"])-1) * 8;
          $query = "SELECT * FROM coupons ORDER BY id DESC";
        }
      }else{
        if( isset($_GET['edit']) ){

          $id = $_GET['id'];
          $query = "SELECT * FROM coupons WHERE id = $id";

        }else{
          // page check
          $query = "SELECT * FROM coupons ORDER BY id DESC ";
        }

      }
      
      if( !$_GET['new'] ){ $result = mysqli_query($link,$query); }
      $num_rows = mysqli_num_rows($result);

      $blog_html = "";

      $blog_row_count = 0;
      ?>
      <div class="col-lg-12 hidden-xs hidden-sm hidden-md row">
        <div class="col-lg-2">
              <b>Title:</b>
            </div>
            <div class="col-lg-2">
              <b>Offer:</b>
              
            </div>
            <div class="col-lg-6">
              <b>Details:</b>
              
            </div>
            <div class="col-lg-2">
              <!--<b>Status:</b>-->
              
            </div>
            <div class="clearfix"></div>
          </div>



      <div class="clearfix"></div>

      <?php 
        if( isset($_GET['edit']) ){

          $row=mysqli_fetch_array($result);

          ?>
          <form method="post" enctype='multipart/form-data'>
             <div class='card '>
                <div class="card-body">  
                  <div class="row">
                  <div class="col-lg-2 col-xs-6">
                    <!-- -->
                    <input type="text" name="title" value="<?php echo $row['title']; ?>" style="width: 100%;" />
                      
                      <br>
                      <br class="hidden-lg">
                  </div>
               
                  <div class="col-lg-2">
                    <input type='text' name='offer' value="<?php echo $row['offer']; ?>" style="width: 100%;" />
                    
                    <!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
                    <br>
                    <br class="hidden-lg">
                  </div>
                  <div class="col-lg-6">
                    <textarea name='details' style="width: 100%;"><?php echo $row['details']; ?></textarea>

                    <input type='hidden' name='id' value="<?php echo $row['id']; ?>" />


                    <!--<b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?></b> - <?php echo $row["details"]; ?>-->
                    <br>
                    <br class="hidden-lg">
                  </div>
                  <div class="col-lg-2">

                    <input type='submit' value='Update Coupon' name='update_coupon' class='btn btn-block btn-default' >
                  
                  </div>
  
                  <div class="clearfix"></div>
                  
                  </div>

                  <?php
                      if (!empty($row["youtube_url"]))
                {
                  echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
                }
              ?>

              <div class="clearfix"></div>     

            <div id="coupon" class="single-sidebar">
                          <div class="single-pricing-box text-center">
                              <div class="inner">
                                  <h2><?php echo $row["title"]; ?></h2> 
                                  <h1><?php echo $row["offer"]; ?></h1>
                                  <p><?php echo $row["details"]; ?></p>
                                  <a href="#" id="print" class="d-print-none" onclick="printContent('coupon');">Click to Print</a>
                              </div>  
                          </div>    
                      </div>   
                
              </div>
              <div class="clearfix"></div>
              </div>
        </form>

          <?php
        }else{

          ?>
          <form method="post" enctype='multipart/form-data'>
              <div class="card">
              <div class='card-body  '>
                <div class="row">
                  <div class="col-lg-2 col-xs-6">
                    <!-- -->
                    <input type='text' name='title' placeholder="Title" style="width: 100%;" />
                      
                      <br>
                      <br class="hidden-lg">
                  </div>
               
                  <div class="col-lg-2">
                    <input type='text' name='offer' placeholder="Offer" style="width: 100%;" />
                    <br>
                    <br class="hidden-lg">
                  </div>
                  <div class="col-lg-5">
                    <textarea name='details' placeholder="Details" style="width: 100%;"></textarea>
                    <br>
                    <br class="hidden-lg">
                  </div>
                  <div class="col-lg-3">

                    <input type='submit' value='Add Coupon' name='new_coupon' class='btn btn-block btn-success' >
                  
                  </div>
                
                  <div class="clearfix"></div>
                  
                 </div>

                  <?php
                      if (!empty($row["youtube_url"]))
                {
                  echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
                }
              ?>

              <div class="clearfix"></div>      
                
              </div>
              </div>
        </form>
          <?php
        }
      ?>

    <div class="clearfix"></div>

    <?php
      while($row=mysqli_fetch_array($result)){
        $img_loc = null;
        $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
        $result2 = mysqli_query($link,$query2);

        while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

        
           ?> 
           
            <div class='card container-fluid'>
              <div class="card-body">
              <div class="row">
                <div class="col-lg-2 col-xs-6" contenteditable="true">
                  <!-- -->
                    <b><?php echo $row["id"]; ?></b> - <?php echo $row["title"]; ?>
                    <br>
                    <br class="hidden-lg">
                </div>
            
                <div class="col-lg-2">
                  <?php echo $row["offer"]; ?>
                  <!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
                  <br>
                  <br class="hidden-lg">
                </div>
                <div class="col-lg-4">
                  
                  <?php echo $row["details"]; ?>
                  <br>
                  <br class="hidden-lg">
                </div>
                <div class="col-lg-4">
                  
                  <b>Created: </b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?>
                  

                  <?php
                  echo "<a href=\"" . $site_base . "admin/delete_any.php?type=coupons&id=" . $row["id"] . "\" class=\" pull-right btn btn-danger\">Delete</a>";

                  echo "<a href=\"" . $site_base . "admin/coupons.php?edit=true&id=" . $row["id"] . "\" class=\" pull-right btn btn-default\">Edit</a>";
              
              ?>

                </div>

                <div class="clearfix row"></div>
                
                <?php
                    if (!empty($row["youtube_url"]))
                {
                    echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
                }
            ?>

            <div class="clearfix"></div>     
            </div>




            <br><br><br>
            <div id="coupon" class="single-sidebar">
                          <div class="single-pricing-box text-center">
                              <div class="inner">
                                  <h2><?php echo $row["title"]; ?></h2> 
                                  <h1><?php echo $row["offer"]; ?></h1>
                                  <p><?php echo $row["details"]; ?></p>
                                  <a href="#" id="print" class="d-print-none" onclick="printContent('coupon');">Click to Print</a>
                              </div>  
                          </div>    
                      </div> 
                  
            <br><br><br>
         
          </div>
        </div>  

          <div class="clearfix"></div><br>
            <?php


          if ($blog_row_count % 10 === 0) { echo "<div class='clearfix'></div>"; }

      
      }

      

      mysqli_close($link);
    ?>

    <div class="clearfix"></div>
    <div class="col-sm-12">
      <ul class="pagination">
        <?php 
          $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error());

          mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error());
          
          $query = "SELECT * FROM coupons ORDER BY id DESC";

          if( isset($_GET["page"]) )
          {
            $pg = $_GET["page"];
          }else{
            $pg = 1;
          }

          $result = mysqli_query($link,$query);
          $num_rows = mysqli_num_rows($result);

          $plinks = "";

          if($num_rows > 0)
          {
            $pcount = (int)ceil($num_rows/8);
            
            if($pg > $pcount){ $pg = 1; }

            for($i = 1; $i <= $pcount; $i++)
            {
              if($i == $pg){
                $plinks .= "<li class=\"active\"><a href=\"?page=".$i."\">".$i."</a></li>";
              }else{
                $plinks .= "<li><a href=\"?page=".$i."\">".$i."</a></li>";
              }
            }
          }

          echo $plinks;

        ?>
      </ul>
    </div>
  </div>

          </section>
      </section>