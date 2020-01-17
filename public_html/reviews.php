<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">

<?php

    $head_title = "Daniels Plumbing Testimonials | Daniels Plumbing Contractors In Philadelphia | (267) 650-3418";
    $metadesc="Daniels Plumbing And Drain Cleaning of Philadelphia, Take A Look At All Of our Excellent Reviews";

    $page_title = "Reviews";

    include "src/crutchphp/config.php";
    include "includes/head.php";
?>
<style type="text/css">
    .page .mt_testimonial .testimonial_main {
        padding: 20px;
        border: 1px solid #f1f1f1;
        min-height: 275px;
    }
</style>
<body class="page">
    <!--PRELOADER-->
    <div class="preloader"><div class="spinner"></div></div>


    <!--*Header*-->
    <div class="worker">
        <?php
            include "includes/header.php";
        ?>
    </div>
    <!--* End Header*-->

    <!-- pagebanner 
    <section id="pagebanner">
        <div class="page-title">
            <h2 class="white text-center"></h2>
        </div>
    </section>-->
    <!-- End Pagebanner -->

    <!-- breadcrumb 
    <div class="breadcrumb-main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li class="active">Daniels Plumbing Testimonials</li>
            </ul>
        </div>
    </div>--><!-- End breadcrumb -->


    <div class="clearfix"></div>



    <!--* Testimonial*-->
    <section id="mainwrapper" class="mt_testimonial">
        <div class="container">


            <h1>
	            <?php echo $page_title; ?>
	        </h1>

            <div class="row">

   <?php 
                            $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

                            


                            // page check
                            $pguery = "SELECT * FROM reviews ORDER BY created DESC";
                            $pgr = mysqli_query( $link, $pguery);
                            $pgnr = mysqli_num_rows($pgr);
                            $pcount = (int)ceil($pgnr/3);

                            //var_dump($pgr);

                            if($_GET["page"])
                            { 
                              if($_GET["page"] > $pcount)
                              {
                                $query = "SELECT * FROM reviews ORDER BY created DESC LIMIT 0 , 9";
                              }else{
                                $plim = (intval($_GET["page"])-1) * 9;
                                $query = "SELECT * FROM reviews ORDER BY created DESC LIMIT ".$plim." , 9";
                              }
                            }else{
                              $query = "SELECT * FROM reviews ORDER BY created DESC LIMIT 0 , 9";
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

                               

                                  <!--Start Single Testimonial Item style4-->
                                    <div class="col-md-4 col-sm-6 col-xs-12 mar-bottom-30">
                                        <div class="testimonial_main">

                                            <div class="stars text-center">
                                                
                                                <span style="font-size:100%;color:#fdc14f;">&starf;</span>
                                                <span style="font-size:100%;color:#fdc14f;">&starf;</span>
                                                <span style="font-size:100%;color:#fdc14f;">&starf;</span>
                                                <span style="font-size:100%;color:#fdc14f;">&starf;</span>
                                                <span style="font-size:100%;color:#fdc14f;">&starf;</span>
                                                <br>
                                                <h3><?php echo $row["name"]; ?></h3>
                                            </div>
                                       
                                            <p class="mar-bottom-30"><?php echo $row["message"]; ?></p>
                                         
                                        </div>
                                    </div>
                                   
                                    <!--End Single Testimonial Item style4-->




                              <?php
                            }
                          ?>

            </div>

        </div>



        <!-- pagination -->
                        <div class="col-md-12">
                            <div class="pagination-div text-center">
                                <ul class="pagination">



                                  <?php


                                    if ($_GET["tag"]) {

                                        $query = "SELECT * FROM reviews WHERE tags LIKE '%" . mysqli_escape_string($_GET["tag"]) . "%' ORDER BY created DESC";

                                    } else {

                                        $query = "SELECT * FROM reviews ORDER BY created DESC";

                                    }


                                    $result = mysqli_query( $link, $query);

                                    $num_rows = (int)mysqli_num_rows($result);

                                    $plinks = "";

                                    $pcnt = (int)ceil($num_rows / 9);

                                    $ndpg = 5; // pagination limit for area of pages to show inbetween dots

                                    if( isset( $_GET["page"] ) ){ $pg = $_GET["page"]; } else { $pg = 1; }

                                    if ($pg > $pcnt) {

                                      $pg = 1;

                                    }


                                    echo '<li><a href="?page='.($pg-1).'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>';


                                    
                                    if($pg > 1)

                                    {

                                      if($_GET["tag"])

                                      {

                                        //echo '<li><a href="?page='.($pg-1).'&tag='.$_GET["tag"].'"><i class="bi bi-arrow-left-rounded" aria-hidden="true"></i></a></li>';

                                      }else{

                                        //echo '<li><a href="?page='.($pg-1).'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>';

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

                                        //echo '<li><a href="?page='.($pg+1).'&tag='.$_GET["tag"].'"><i class="bi bi-arrow-right-rounded" aria-hidden="true"></i></a></li>';

                                      }else{

                                        //echo '<li><a href="?page='.($pg+1).'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';

                                      }


                                    }

                                    echo '<li><a href="?page='.($pg+1).'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';

                                ?> 

                                <!--
                                    <li class="prev">
                                        <a href="#"><i class="fa fa-angle-double-left"></i></a>
                                    </li>
                                    <li>
                                        <a href="#">1</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">2</a>
                                    </li>
                                    <li>
                                        <a href="#">3</a>
                                    </li>
                                    <li>
                                        <a href="#">...</a>
                                    </li>
                                    <li>
                                        <a href="#">10</a>
                                    </li>
                                    <li class="next">
                                        <a href="#"><i class="fa fa-angle-double-right"></i></a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                   <!-- End pagination -->

                   <div class="clearfix"></div>

    </section>
    <!--* EndTestimonial*-->



                    <div id="bottomwrapper"></div>

               


    <!--*Footer*-->
    <?php
        include "includes/footer.php";
    ?>
    <!--* End Footer*-->


    <!-- back to top 
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="" data-placement="left">
        <span class="fa fa-arrow-up"></span>
    </a>-->

    <!--*Scripts*-->

    <?php
        include "includes/scripts.php";
    ?>

</body>

</html>