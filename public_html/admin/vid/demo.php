<?php
include "../../src/crutchphp/config.php";
//if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 100%;
    }
    .content {
      position: fixed;
      top: 0;
      bottom: 0;
      right: 0;
      /*background: rgba(0, 0, 0, 0.5);*/
      color: #f1f1f1;
      width: 100%;
      padding: 20px;
    }
    .card{
      background-color: rgba(255, 255, 255, 0.3);
    }

    .view iframe.video-intro {
        z-index: -100;
        top: 50%;
        left: 50%;
        -webkit-transform: translateX(-50%) translateY(-50%);
        -ms-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        -webkit-transition: 1s opacity;
        -o-transition: 1s opacity;
        transition: 1s opacity;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
    }

    .view img, .view iframe {
        position: relative;
        display: block;
    }
    .menu{
      color: #000;
      font-size: 24px;
      padding: 0 2em;
    }

    .h1, h1 {
        font-size: 5rem;
        font-weight: 700;
    }

    .h2, h2 {
        font-size: 6rem;
        color: red;
        text-transform: uppercase;
        font-weight: 700;
    }
    h1 span.side {
        writing-mode: vertical-rl;
        text-orientation: mixed;
        font-size: 1.4rem;
        font-weight: 700;
        color: red;
    }
    .h3, h3 {
        font-size: 10rem;
        font-weight: 700;
    }

    sub, sup {
        position: relative;
        font-size: 60%;
        line-height: 0;
        vertical-align: baseline;
    }
    .featured {
        transform: translate(0%, 45%);
    }

    .carousel-inner .carousel-item {
      transition: -webkit-transform 0s ease;
      transition: transform 0s ease;
      transition: transform 0s ease, -webkit-transform 0s ease;
    }

    .logo-theme .video-intro {
        
        display: none;
    }
    .logo-theme .logo img {
        max-height: 500px;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, 50%);
    }
    .logo-theme .menu {
        /*background: rgba(156, 39, 176, .1);*/
        text-shadow: -2px -2px #000;
    }

    .featured-logo-theme .featured {
        transform: translate(0%, 0%);
    }
    .featured-logo-theme .logo {
        padding: 1em 0 2em;
    }

    .third-left-theme .h1, .third-left-theme h1 {
        font-size: 2rem;
    }
    .third-left-theme .menu{
      color: #000;
      font-size: 16px;
    }


    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #1C2331 !important;
      }
    }

  </style>

  <?php 

    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

    mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error($link));


    if(isset($_POST['but_upload'])){
         $maxsize = 52428800; // 50MB
   
         $title = $_FILES['file']['name'];

         echo "<br>Name: " . $title;

         $target_dir = "videos/";
         $target_file = $target_dir . $_FILES["file"]["name"];

         echo "<br>Target File: " . $target_file;

         // Select file type
         $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

         // Check extension
         if( in_array($videoFileType,$extensions_arr) ){
   
            // Check file size
            if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
              echo "File too large. File must be less than 50MB.";
            }else{

              echo "Uploading ...";

              // Upload
              if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
                // Insert record
                $query = "INSERT INTO videos(title,location) VALUES('".$title."','".$target_file."')";

                mysqli_query($link,$query);

                echo "Upload successfully.";
              }
            }

         }else{
            echo "Invalid file extension.";
         }
   
       } 

  ?>


</head>

<body>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar d-none d-md-block1">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
        <strong>MDB</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://mdbootstrap.com/docs/jquery/" target="_blank">About MDB</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://mdbootstrap.com/docs/jquery/getting-started/download/" target="_blank">Free
              download</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://mdbootstrap.com/education/bootstrap/" target="_blank">Free tutorials</a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a href="#" class="nav-link" target="_blank">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" target="_blank">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link border border-light rounded"
              target="_blank">
              <i class="fab fa-github mr-2"></i> Call Now
            </a>
          </li>
        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->

  <?php 

     if( isset( $_GET["board_id"] ) ){

          $transition_query = "SELECT * FROM boards WHERE id = '" .$_GET['board_id']. "' LIMIT 1";
        }

      $transition_result = mysqli_query($link,$transition_query);
      $num_rows = mysqli_num_rows($transition_result);

      $transition_row=mysqli_fetch_array($transition_result);
      $transition = $transition_row["transition"];

      
  ?>



  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-slide " data-ride="carousel">

    <ol class="carousel-indicators d-none">
    <?php 
       // page check
      $pguery = "SELECT * FROM videos ORDER BY priority ASC";
      $pgr = mysqli_query($link,$pguery);
      $pgnr = mysqli_num_rows($pgr);

      $counter = 0;

      while( $pgnr-- ){
        ?>
        <li data-target="#carousel-example-1z" data-slide-to="<?php echo $counter++; ?>" <?php if( $counter == 0 ){ echo 'class="active"'; } ?>></li>
        <?php
      }
    ?>
    </ol>
    <!--Indicators-->
   <!-- <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
      <li data-target="#carousel-example-1z" data-slide-to="3"></li>
    </ol>-->
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">


          

      <?php 
        // page check
      $pguery = "SELECT * FROM videos ORDER BY priority ASC";
      $pgr = mysqli_query($link,$pguery);
      $pgnr = mysqli_num_rows($pgr);



      $pcount = (int)ceil($pgnr/12);

      if($_GET["page"])
      { 
        if($_GET["page"] > $pcount)
        {
          $query = "SELECT * FROM videos ORDER BY priority ASC LIMIT 0 , 12";
        }else{
          $plim = (intval($_GET["page"])-1) * 12;
          $query = "SELECT * FROM videos ORDER BY priority ASC LIMIT ".$plim." , 12";
        }
      }else{
        if( isset( $_GET["board_id"] ) ){

          $query = "SELECT * FROM videos WHERE board_id = '" .$_GET['board_id']. "' ORDER BY priority ASC LIMIT 0 , 12";
        }else{
          $query = "SELECT * FROM videos ORDER BY priority ASC LIMIT 0 , 12";
        }
      }

      $result = mysqli_query($link,$query);
      $num_rows = mysqli_num_rows($result);

      //echo $num_rows;

      $blog_html = "";

      $count = 0;

      $blog_row_count = 0;
      while($row=mysqli_fetch_array($result)){

        

        $img_loc = null;
        $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
        $result2 = mysqli_query($link,$query2);

        while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }
            //echo "<br>" . $count . " - " . $row['heading'];
            ?>

            <?php

              if ( $row['theme'] == "featured-right" ) {
                  ?>
                    <!--Dynamic slide -- featured-right -->
                <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                  <div class="view col-md-6 offset-6">
                   
                    <!--Video source-->
                    <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                      <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                        
                    </video>

                    <!-- Mask & flexbox options-->
                    <div class="mask rgba-black-light1 d-flex justify-content-center align-items-center">


                      <?php if( $row['overlay'] ){ ?>

                      <!-- Content -->
                    
                      <div class="content">
                        <div class="row vertical-align">

                          <div class="col-md-6  text-center menu ">

                            <div class="featured ">
                            
                              <h1>CREATE <span class="side">YOUR</span> OWN</h1>
                              <div style="width: 55%; height: 20px; border-bottom: 1px solid black; text-align: center; margin: 0 auto;">
                                <span style="font-size: 22px; background-color: #FFF; padding: 0 10px;">
                                  WITH <!--Padding is optional-->
                                </span>
                              </div>
                              <h2>Unlimited Toppings</h2>
                              <h3><sup>$</sup>7<sup>.99</sup></h3>
                            </div>
                            
                          </div>

                         </div>
                      </div>

                      <!-- Content -->

                    <?php } ?>

                    </div>
                    <!-- Mask & flexbox options-->

                  </div>
                </div>
                <!--/Dynamic slide -- featured-right -->
                <?php
              } else if ( $row['theme'] == "right" ) {
                ?>

                  <!--Dynamic slide -- right -->
                  <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                    <div class="view col-md-6 offset-6">
                     
                      <!--Video source-->
                      <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                        <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                          
                      </video>

                      <!-- Mask & flexbox options-->
                      <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                        <?php if( $row['overlay'] ){ ?>

                        <!-- Content -->
                      
                        <div class="content">
                          <div class="row">

                            <div class="col-md-6 menu">

                               <h1 class="text-center">
                                  <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                                </h1>

                                <?php echo $row['content']; ?>
                    
                            </div>

                           </div>
                        </div>

                        <!-- Content -->

                      <?php } ?>

                      </div>
                      <!-- Mask & flexbox options-->

                    </div>
                  </div>
                  <!--/Dynamic slide  - right - -->

                <?php
              } else if ( $row['theme'] == "left" ) {
                ?>

                  <!--Dynamic slide -- left -->
              <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                <div class="view col-md-6">
                 
                  <!--Video source-->
                  <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                    <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                      
                  </video>

                  <!-- Mask & flexbox options-->
                  <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                    <?php if( $row['overlay'] ){ ?>

                    <!-- Content -->
                  
                    <div class="content">
                      <div class="row">
                        
                        <div class="col-md-6 offset-6 menu">

                           <h1 class="text-center">
                              <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                            </h1>

                            <?php echo $row['content']; ?>
                            
                        </div>
                       </div>
                    </div>

                    <!-- Content -->

                  <?php } ?>

                  </div>
                  <!-- Mask & flexbox options-->

                </div>
              </div>
              <!--/Dynamic slide  -- left -->

                <?php
              } else if ( $row['theme'] == "logo" ) {
                ?>

                  <!--Dynamic slide -- logo -- -->
              <div id="vb-slide-<?php echo $count; ?>" class="carousel-item logo-theme <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                <div class="view">
                 
                  <!--Video source-->
                  <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                    <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                      
                  </video>

                  <!-- Mask & flexbox options-->
                  <div class="mask rgba-black-light d-flex justify-content-center align-items-center">


                    <?php if( $row['overlay'] ){ ?>

                      <!-- Content -->
                  
                      <div class="content">
                        <div class="row">
                          <div class="col-12">
                            <div class="text-center logo">
                              <img src="/images/little-mans-logo.png"  class="img-fluid mx-auto">
                            </div>
                          </div>
                         </div>
                      </div>

                      <!-- Content -->

                    <?php } ?>
                  
                  </div>
                  <!-- Mask & flexbox options-->

                </div>
              </div>
              <!--/Dynamic slide -- logo -- -->

                <?php
              } else if ( $row['theme'] == "featured-middle" ) {
                ?>

                  <!--Dynamic slide  -- featured-middle -->
                  <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                    <div class="view">
                     
                      <!--Video source-->
                      <video id="vb-<?php echo $count++; ?>" class="video-intro d-none" autoplay loop muted>
                        <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                          
                      </video>

                      <!-- Mask & flexbox options-->
                      <div class="mask rgba-black-light1 d-flex justify-content-center align-items-center">


                        <?php if( $row['overlay'] ){ ?>

                        <!-- Content -->
                      
                        <div class="content">
                          <div class="row vertical-align">

                            <div class="col-md-6 offset-3  text-center menu ">


                              <div class="featured ">
                                
                                <h1>CREATE <span>YOUR</span> OWN</h1>
                                <div style="width: 55%; height: 20px; border-bottom: 1px solid black; text-align: center; margin: 0 auto;">
                                  <span style="font-size: 22px; background-color: #FFF; padding: 0 10px;">
                                    WITH <!--Padding is optional-->
                                  </span>
                                </div>
                                <h2>Unlimited Toppings</h2>
                                <h3><sup>$</sup>7<sup>.99</sup></h3>
                              </div>
                 
                            </div>
                            
                           </div>
                        </div>

                        <!-- Content -->

                      <?php } ?>

                      </div>
                      <!-- Mask & flexbox options-->

                    </div>
                  </div>
                  <!--/Dynamic slide -- featured-middle -->

                <?php
              } else if ( $row['theme'] == "three-left" ) {
                ?>

                  <!--Dynamic slide  -- three-left-->
              <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                <div class="view col-md-4 ">
                 
                  <!--Video source-->
                  <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                    <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                      
                  </video>


                  <!-- Mask & flexbox options-->
                  <div class="mask rgba-black-light d-flex justify-content-center align-items-center">


                    <?php if( $row['overlay'] ){ ?>

                    <!-- Content -->
                  
                    <div class="content">
                      <div class="row">

                        <div class="col-md-4 offset-4 menu">

                            <h1 class="text-center">
                              <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                            </h1>

                            <?php echo $row['content']; ?>

                        </div>
                        
                        <div class="col-md-4 menu">

                           <h1 class="text-center">
                              <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                            </h1>

                            <?php echo $row['content']; ?>

                        </div>
                       </div>
                    </div>

                    <!-- Content -->

                  <?php } ?>
                  
                  </div>
                  <!-- Mask & flexbox options-->

                </div>
              </div>
              <!--/Dynamic slide - three-left -->

                <?php
              } else if ( $row['theme'] == "three-right" ) {
                ?>

                  <!--Dynamic slide -- three-right -->
              <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                <div class="view col-md-4 offset-8">
                 
                  <!--Video source-->
                  <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                    <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                      
                  </video>

                  <!-- Mask & flexbox options-->
                  <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                    <?php if( $row['overlay'] ){ ?>

                    <!-- Content -->
                  
                    <div class="content">
                      <div class="row">
        
                        <div class="col-md-4 menu">

                            <h1 class="text-center">
                              <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                            </h1>

                            <?php echo $row['content']; ?>

                        </div>
                        
                        <div class="col-md-4 menu">

                           <h1 class="text-center">
                              <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                            </h1>

                            <?php echo $row['content']; ?>

                        </div>

                       </div>
                    </div>

                    <!-- Content -->

                  <?php } ?>

                  </div>
                  <!-- Mask & flexbox options-->

                </div>
              </div>
              <!--/Dynamic slide -- three-right -->

                <?php
              } else if ( $row['theme'] == "featured-logo" ) {
                ?>

                 <!--Dynamic slide -- featured-logo -->
                  <div id="vb-slide-<?php echo $count; ?>" class="carousel-item featured-logo-theme <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                    <div class="view col-md-6 offset-6">
                     
                      <!--Video source-->
                      <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                        <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                          
                      </video>

                      <!-- Mask & flexbox options-->
                      <div class="mask rgba-black-light d-flex justify-content-center align-items-center">


                        <?php if( $row['overlay'] ){ ?>

                        <!-- Content -->
                      
                        <div class="content">
                          <div class="row vertical-align">

                            <div class="col-md-6  text-center menu ">


                              <div class="featured ">

                                <div class="text-center logo">
                                  <img src="/images/little-mans-logo.png" width="350" class="mx-auto">
                                </div>
                                
                                
                                <h1>CREATE <span>YOUR</span> OWN</h1>
                                <div style="width: 55%; height: 20px; border-bottom: 1px solid black; text-align: center; margin: 0 auto;">
                                  <span style="font-size: 22px; background-color: #FFF; padding: 0 10px;">
                                    WITH <!--Padding is optional-->
                                  </span>
                                </div>
                                <h2>Unlimited Toppings</h2>
                                <h3><sup>$</sup>7<sup>.99</sup></h3>
                              </div>

                            </div>
     
                           </div>
                        </div>

                        <!-- Content -->

                      <?php } ?>

                      </div>
                      <!-- Mask & flexbox options-->

                    </div>
                  </div>
                  <!--/Dynamic slide -- featured-logo -->

                <?php
              } else if ( $row['theme'] == "middle" ) {
                ?>

                 <!--Dynamic slide -- middle -->
                  <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                    <div class="view col-md-4 offset-4">
                     
                      <!--Video source-->
                      <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                        <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                          
                      </video>

                      <!-- Mask & flexbox options-->
                      <div class="mask rgba-black-light d-flex justify-content-center align-items-center">


                        <?php if( $row['overlay'] ){ ?>

                        <!-- Content -->
                      
                        <div class="content">
                          <div class="row">
                            <div class="col-md-4 menu">

                                <h1 class="text-center">
                                  <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                                </h1>

                                <?php echo $row['content']; ?>


                            </div>
                       
                            <div class="col-md-4 offset-4 menu">

                               <h1 class="text-center">
                                  <strong><?php echo $row['heading']; ?></strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                                </h1>

                                <?php echo $row['content']; ?>

                            </div>
                           </div>
                        </div>

                        <!-- Content -->

                      <?php } ?>

                      </div>
                      <!-- Mask & flexbox options-->

                    </div>
                  </div>
                  <!--/Dynamic slide -- middle -->

                <?php
              } else if ( $row['theme'] == "third-left" ) {
                ?>

                 <!--Dynamic slide-->
              <div id="vb-slide-<?php echo $count; ?>" class="carousel-item third-left-theme <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                <div class="view col-md-4 ">
                 
                  <!--Video source-->
                  <video id="vb-<?php echo $count++; ?>" class="video-intro" autoplay loop muted>
                    <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                      
                  </video>

                  <!-- Mask & flexbox options-->
                  <div class="mask rgba-black-light d-flex justify-content-center align-items-center">


                    <?php if( $row['overlay'] ){ ?>

                    <!-- Content -->
                  
                    <div class="content">
                      <div class="row">
                 
                        <div class="col-md-8 offset-4 menu">



                          <div class="full">
                              <div class="row">
                                <div class="col-md-4 menu">
                                    <h1 class="d-none">First Column</h1>
                                    

                                    <h1 class="d-none">
                                      <strong><?php echo $row['heading']; ?></strong>
                                    </h1>
                                    <h1 class="text-center">
                                      <strong>Juices</strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                                    </h1>


                                    <br><b>ABC</b> Apple, Beet, Carrot 
                                    <br><b>ABCG</b> Apple, Beet, Cerrot, Ginger 
                                    <br><b>ABCO</b> Apple, Beet, Carrot, Orange 
                                    <br><b>BEET BERRY BLAST</b> Beet, Strawberry, Blueberry, Apple 
                                    <br><b>HIGH BLOOS PRESSURE</b> Apple, Carrot, Spinach 
                                    <br><b>WEIGHT LOSS</b> Celery, Cucumber, Lemon, Ginger 
                                    <br><b>BEAUTY GLOWS</b> Apple, Cucumber, Pineapple 
                                    <br><b>EYESIGHT</b> Carrot, Cantalpoupe, Orange 
                                    <br><b>MENOPAUSE</b> Apple, Strawberry, Cantaloupe.
                                    <br><b>ANEMIA</b> Apple, Carrot, Celery, Kale 
                                    <br><b>DIABETES</b> Apple, Strawberry 
                                    <br><b>ALLERGIES</b> Carrot, Celery, Lemon 
                                    <br><b>SWEET GREEN</b> Apple, Cucumber, Spinach 
                                    <br><b>GREEN DAY</b> Cucumber, Celery, Kale, Spinach 
                                    <br><b>GREEN LEMONADE</b> Apple, Cucumber, Lemon, Kale, Spinach 
                                    <br><b>RED LEMONADE</b> Apple, Strawberry, Orange, Lemon 
                                    <br><b>CALM DOWN</b> Orange, Pineapple, Lemon, Ginger 
                                    <br><b>FIRST LOVE</b> Strawberry, Orange, Pineapple 
                                    <br><b>FIGHT A COLD</b> Orange, Carrot, Lemon, Ginger 


                                    <br><br>

                                    <h1 class="text-center">
                                      <strong>Smoothies</strong><br><span style="font-size: 0.4em; font-weight: 500; position: relative; top: -10px;">(S) $5.50 (L) $7.45</span>
                                    </h1>



                                    <br><b>BEGINNER'S GREEN</b> Banana, Pineapple, Kale, Spinach 
                                    <br><b>AVOCADO GREEN</b> Avocado, Appie, Kate, Spinach 
                                    <br><b>STRAWBERRY BANANA </b>
                                    <br><b>STRAWBERRY BLUEBERRY BANANA</b>
                                    <br><b>STRAWBERRY KIWI</b> 
                                    <br><b>MANGO PINEAPPLE BANANA</b> 
                                    <br><b>MANGO PINEAPPLE STRAWBERRY</b> 

                           
                                </div>
                                <div class="col-md-4 menu">
                                  <h1 class="d-none">Second Column</h1>
                                  
                                  <div class="text-center logo">
                                    <img src="/images/little-mans-logo.png" width="200" class="mx-auto">
                                  </div>

                                  <br><br>


                                  <h1 class="text-center">
                                    <strong>Shots</strong>
                                  </h1>

                                  <br><b>GINGER WITH LEMON</b>  $2.00 
                                  <br><b>WELLNESS SHOT</b> $2.25 
                                  <br> -- Ginger, Orange. Honey, Cayenne pepper 
                                  <br><b>FLU SHOT</b> $2.50 
                                  <br> -- Ginger, Turmeric. Orange. Honey, Cayenne pepper 
                                  <br><b>WEATGRASS SHOT</b> $3.00 

                                  <br><br>

                                  <h1 class="text-center">
                                    <strong>Protein Shake</strong>
                                  </h1>

                                  <div class="text-center">
                                    (Whey or Vegan)<br>
                                    VANILLA OR CHOCOLATE<br>
                                    Banana, Peanut butter, Almond milk. Protein powder 
                                  </div>

                                  <br><br>

                                  <h1 class="text-center">
                                    <strong>Vegan Milkshake</strong>
                                  </h1>

                                  <div class="row">
                                    
                                    <div class="col-md-4">
                                      <br>STRAWBERRY
                                      <br>BLUEBERRY
                                      <br>MANGO
                                      <br>OREO

                                    </div>
                                    <div class="col-md-8">

                                      <br>BANANA PUDDING
                                      <br>Banana, Graham cracker 
                                      SOURSOP +$1.00
                                      <br>Coconut milk, Nutmeg 
                                      
                                    </div>
                                  </div>

                          
                                </div>
                                <div class="col-md-4 menu">
                                   <h1 class="d-none">Third Column</h1>
                                   

                                   <h1 class="text-center">
                                      <strong>Smoothie Bowl</strong>
                                    </h1>

                                    <br><b>ACAI SMOOTHIE BOWL</b> $10.50 
                                    <br>BASE: ACV puree. Banana. Blueberry, Almond milk 
                                    <br>TOPPING: Coconut flake. Honey. Granola, TWO fruits
                                    <br>
                                    <br><b>AVOCADO SMOOTHIE BOWL</b> $9.95
                                    <br>BASE: Avocado, Banana. Smash, Almond milk 
                                    <br>TOPPING: Coconut flake. Honey.. Granola. TWO fruits


                                    <br><br>

                                   <h1 class="text-center">
                                      <strong>Chia Seed Pudding</strong>
                                    </h1>

                                    <div class="text-center">
                                      with Strawberry and dairy-free wipped cream 
                                    </div>
                                    <br><br>


                                    <h1 class="text-center">
                                      <strong>Parfait</strong>
                                    </h1>

                                    <div class="text-center">
                                      Two Fruits, Greek yogurt„ Granola, Honey 
                                    </div>

                                    <br><br>

                                    <h1 class="text-center">
                                      <strong>Fruits Bowl w/ Nutella</strong>
                                    </h1>

                                    Two fruits ( Pick 2: Apple, Banana, Stwarberry) $5.75 
                                    <br>Granola, Nutella 


                                    <h1 class="text-center">
                                      <strong>Cheesecake</strong>
                                    </h1>

                                    <br>Vegan creamcheese 1 PIECE / S3.50 
                                    <br>STRAWBERRY
                                    <br>BLUEBERRY
                                    <br>BANANA
                                    <br>BANANA NUTELLA (Not vegan)
                                    <br>OREO 


                                </div>
                               </div>
                            </div>
                
                        </div>
                        
                       </div>
                    </div>

                    <!-- Content -->

                  <?php } ?>
                  
                  </div>
                  <!-- Mask & flexbox options-->

                </div>
              </div>
              <!--/Dynamic slide-->
                <?php
              }

            ?>
             


            <?php
    
      }
      ?> 



    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

  </div>
  <!--/.Carousel Wrapper-->






 

    <!--Copyright->
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
    </div>
    <!-/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
<!--
<script>
var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function myFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "Pause";
  } else {
    video.pause();
    btn.innerHTML = "Play";
  }
}
</script>
-->

 <script type="text/javascript">

    $(document).ready(function() {
      //jQuery.fn.carousel.Constructor.TRANSITION_DURATION = 6000  // 6 seconds


      $("video.video-intro").on("loadedmetadata", function() {
         // code here
         $('#vb-slide-0').addClass("active");


        $( "video.video-intro" ).each(function() {
          
          var vid = this;


          var dur = this.duration;

          var secs = dur * 1000;

          

          var slide = this.closest( ".carousel-item" );

           slide.setAttribute('data-interval', secs);

        });

      });

    });
  </script>

<!--
      var vid = document.getElementById("vb-0");
      var secs = vid.duration * 1000;
      
      var slide = document.querySelector('#vb-slide-0');
      slide.setAttribute('data-interval', secs);
      alert(secs);

      var vid = document.getElementById("vb-1");
      var secs = vid.duration * 1000;
      
      var slide = document.querySelector('#vb-slide-1');
      slide.setAttribute('data-interval', secs);
      alert(secs);

      var vid = document.getElementById("vb-2");
      var secs = vid.duration * 1000;
      
      var slide = document.querySelector('#vb-slide-2');
      slide.setAttribute('data-interval', secs);
      alert(secs);

      var vid = document.getElementById("vb-3");
      var secs = vid.duration * 1000;
      
      var slide = document.querySelector('#vb-slide-3');
      slide.setAttribute('data-interval', secs);
      alert(secs);




      


  

 -->
</body>

</html>
