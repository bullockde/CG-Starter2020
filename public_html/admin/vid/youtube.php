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
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      color: #f1f1f1;
      width: 100%;
      padding: 20px;
    }
    .card{
      background-color: rgba(255, 255, 255, 0.3);
    }

    .carousel-inner .carousel-item {
      transition: -webkit-transform 6s ease;
      transition: transform 6s ease;
      transition: transform 6s ease, -webkit-transform 6s ease;
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
    .videoWrapper {
		position: relative;
		padding-bottom: 56.25%; /* 16:9 */
		padding-top: 25px;
		height: 0;
	}
	.videoWrapper iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	
	.videoWrapper {
	    position: absolute;
	    padding-bottom: 0;
	    padding-top: 0;
	    top: 0;
	    height: 100%;
	    bottom: 0;
	    left: 0;
	    right: 0;
	}

	* { box-sizing: border-box; }
		.video-background {
		  background: #000;
		  position: fixed;
		  top: 0; right: 0; bottom: 0; left: 0;
		  z-index: -99;
		}
		.video-foreground,
		.video-background iframe {
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  pointer-events: none;
		}

		@media (min-aspect-ratio: 16/9) {
		  .video-foreground { height: 300%; top: -100%; }
		}
		@media (max-aspect-ratio: 16/9) {
		  .video-foreground { width: 300%; left: -100%; }
		}
		@media all and (max-width: 600px) {
		.vid-info { width: 50%; padding: .5rem; }
		.vid-info h1 { margin-bottom: .2rem; }
		}
		@media all and (max-width: 500px) {
		.vid-info .acronym { display: none; }
		}




	.video-container {
		position: relative;
		padding-bottom: 56.25%;
		padding-top: 30px; height: 0; overflow: hidden;
		}

		.video-container iframe,
		.video-container object,
		.video-container embed {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		}



    .view img, .view iframe {
        position: relative;
        display: block;
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



  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade " data-ride="carousel">

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

      $pcount = (int)ceil($pgnr/9);

      if($_GET["id"])
      {
      	$id = $_GET["id"];

        $query = "SELECT * FROM videos WHERE id = $id";

      }else if($_GET["page"]) { 

        if($_GET["page"] > $pcount)
        {
          $query = "SELECT * FROM videos ORDER BY priority ASC LIMIT 0 , 9";
        }else{
          $plim = (intval($_GET["page"])-1) * 9;
          $query = "SELECT * FROM videos ORDER BY priority ASC LIMIT ".$plim." , 9";
        }
      }else{
        $query = "SELECT * FROM videos ORDER BY priority ASC LIMIT 0 , 9";
      }

      $result = mysqli_query($link,$query);
      $num_rows = mysqli_num_rows($result);

      $blog_html = "";

      $count = 0;

      $blog_row_count = 0;
      while($row=mysqli_fetch_array($result)){
        $img_loc = null;
        $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
        $result2 = mysqli_query($link,$query2);

        while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

            ?>
             <!--Dynamic slide-->
              <div id="vb-slide-<?php echo $count; ?>" class="carousel-item <?php if( $count == 0 ){ echo 'active'; } ?>" data-interval="<?php echo $row['duration']; ?>">
                <div class="view">
                 
                  <!--Video source-->
                  <video id="vb-<?php echo $count++; ?>" class="video-intro d-none" autoplay loop muted>
                    <source src="../<?php echo $row['location']; ?>" type="video/mp4">
                  </video>
             <!--     <div class="videoWrapper">	

                  		<iframe src="https://www.youtube.com/embed/ls5mqfwjNRs?controls=0&autoplay=1&mute=1" class="video-intro" width="560" height="349" frameborder="0" allowfullscreen></iframe>

                  </div>

                  	<div class="video-container"><iframe width="853" height="480" src="https://www.youtube.com/embed/z9Ul9ccDOqE" frameborder="0" allowfullscreen></iframe></div>

                  	-->

                  	<div class="video-background">
					    <div class="video-foreground">
					      <iframe src="https://www.youtube.com/embed/flexhqu1zhg?rel=1&controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1" class="video-intro" frameborder="0" allowfullscreen></iframe>
					    </div>
					  </div>

                  <!-- Mask & flexbox options-->
                  <div class="mask rgba-black-light d-flex justify-content-center align-items-center">


                    <?php if( !empty($row['heading']) ){ ?>
                    <!-- Content -->
                    <div class=" white-text mx-5 wow fadeIn">
                     
                    
                    </div>
                    <!-- Content -->

                    <div class="content">
                      <div class="row">
                        <div class="col-md-8">
                            <h1 class="">
                              <strong><?php echo $row['heading']; ?></strong>
                            </h1>
                            <p>
                              <strong><?php echo $row['excerpt']; ?></strong>
                            </p>
                            <p><?php echo $row['content']; ?></p>

                             <a target="_blank" href="<?php echo $row['button_link']; ?>" class="btn btn-outline-white btn-lg"><?php echo $row['button_text']; ?>
                              <i class="fas fa-graduation-cap ml-2"></i>
                            </a>
                            <!--
                            <button id="myBtn" onclick="myFunction()">Pause</button>
                            <button id="myBtn" onclick="openFullscreen();">Fullscreen</button>
                          -->
                        </div>
                        <div class="col-md-4">
                          <div class="card">
                            <script type='text/javascript' src='https://darksky.net/widget/default/39.9527,-75.1635/us12/en.js?width=100%&height=250&title=Philadelphia&textColor=ffffff&bgColor=FFFFFF&transparency=true&skyColor=undefined&fontFamily=Default&customFont=&units=us&htColor=ffffff&ltColor=ffffff&displaySum=yes&displayHeader=yes'></script>
                          </div>
                        </div>
                       </div>
                    </div>



                  <?php } else { ?>
                     <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn d-none">
                      <h1 class="mb-4">
                        <strong>Learn Bootstrap 4 with MDB</strong>
                      </h1>

                      <p>
                        <strong>Best & free guide of responsive web design</strong>
                      </p>

                      <p class="mb-4 d-none d-md-block">
                        <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
                          written versions
                          available. Create your own, stunning website.</strong>
                      </p>

                      <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
                        free tutorial
                        <i class="fas fa-graduation-cap ml-2"></i>
                      </a>
                    </div>
                    <!-- Content -->

                

                    <div class="content">
                      <div class="row">
                        <div class="col-md-8">
                            <h1 class="">
                              <strong>Heading</strong>
                            </h1>
                            <p>
                              <strong>Lorem ipsum dolor sit amet, an his etiam torquatos.</strong>
                            </p>
                            <p>Tollit soleat phaedrum te duo, eum cu recteque expetendis neglegentur. Cu mentitum maiestatis persequeris pro, pri ponderum tractatos ei. Id qui nemore latine molestiae, ad mutat oblique delicatissimi pro.</p>

                             <a target="_blank" href="#" class="btn btn-outline-white btn-lg">Register Now
                              <i class="fas fa-graduation-cap ml-2"></i>
                            </a>
                            <!--
                            <button id="myBtn" onclick="myFunction()">Pause</button>
                            <button id="myBtn" onclick="openFullscreen();">Fullscreen</button>
                          -->
                        </div>
                        <div class="col-md-4">
                          <div class="card">
                            <script type='text/javascript' src='https://darksky.net/widget/default/39.9527,-75.1635/us12/en.js?width=100%&height=250&title=Philadelphia&textColor=ffffff&bgColor=FFFFFF&transparency=true&skyColor=undefined&fontFamily=Default&customFont=&units=us&htColor=ffffff&ltColor=ffffff&displaySum=yes&displayHeader=yes'></script>
                          </div>
                        </div>
                       </div>
                    </div>

                    <?php } ?>
                    

                  </div>
                  <!-- Mask & flexbox options-->
<!--
                  <div class="clearfix"></div>

                    <div class="row">
                      <div class="col-md-6">
                        Something Here
                      </div>
                      <div class="col-md-6">
                        Widget Code
                      </div>
                      
                    </div>

                                    -->
                </div>
              </div>
              <!--/Dynamic slide-->


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
    <!--/.Copyright-->

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



 
    
      
      
/*
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
  */
    });


      


  </script>


</body>

</html>
