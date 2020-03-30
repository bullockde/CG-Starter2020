<?php
  include "../src/crutchphp/config.php";
  
  if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }

	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

	mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());

	function cleanup($field) 
	{
		//$clean = mysql_real_escape_string($field);
		//return $clean;
		return $field;
	}

	$id = cleanup($_GET["id"]); 
	
	if(isset($_POST['Submit']) && isset($id)) 
	{
		$title = $_POST["title"];
		$bcontent = $_POST["content"];

		$date = date("Y-m-d H:i:s");
		$yturl = $_POST["yturl"];
		$tags = $_POST["tags"];

		if($_POST["featured"] == "False"){
			$featured = false;
		}else{
			$featured = true;
		}
		
		if($_POST["landing"] == "False"){
			$landing = false;
		}else{
			$landing = true;
		}

		$headline = $_POST["headline"];
		$excerpt = $_POST["excerpt"];
		$coupon_id = $_POST["coupon_id"];

		$upblog = false;
		$upblogi = false;

		if(isset($bcontent))
		{

			$title = addslashes($title);
			$bcontent = addslashes($bcontent);

			if($featured == true)
			{
				$fqu = "UPDATE blogs SET featured = 0";
				$fres = mysqli_query( $link, $fqu);
			}
			
			$query = "UPDATE blogs SET content = '".cleanup($bcontent)."', title = '".cleanup($title)."', tags = '".cleanup($tags)."', featured = '".cleanup($featured)."', landing = '".cleanup($landing)."', headline = '".cleanup($headline)."', excerpt = '".cleanup($excerpt)."', coupon_id = '".cleanup($coupon_id)."', youtube_url = '".cleanup($yturl)."' where id = '$id'";
			$result = mysqli_query( $link, $query);

			if(mysqli_affected_rows( $link ) > 0){ $upblog = True; }

			if($_FILES["bimgs"]["name"][0])
			{
				$img_amt = count($_FILES["bimgs"]["name"]);
				$imgu_done = false;
				
				for($i=0;$i<$img_amt;$i++)
				{
					$target_dir = "../uploads/";
					$target_file = $target_dir . basename($_FILES["bimgs"]["name"][$i]);
					$file_name = $_FILES["bimgs"]["name"][$i];
					$web_location = "uploads/".$file_name;
					$uploadOk = 1;
					$imageFileType = strtolower ( pathinfo($target_file,PATHINFO_EXTENSION) );

					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						$uploadOk = 0;
					}else{
						
						$check = getimagesize($_FILES["bimgs"]["tmp_name"][$i]);
						if($check !== false) 
						{
							$uploadOk = 1;
						} else {
							$uploadOk = 0;
						}
						
					}

					if($uploadOk == 1)
					{
						if (move_uploaded_file($_FILES["bimgs"]["tmp_name"][$i], $target_file)) {
							$tquery = "SELECT * FROM blog_images WHERE blog_id='$id' AND name='".cleanup($file_name)."'";
							$tres = mysqli_query( $link, $tquery);
							$tnr = mysqli_num_rows($tres);

							if($tnr == 0){
								$query = "INSERT INTO blog_images (name, location, blog_id, created) VALUES ('".cleanup($file_name)."', '$web_location', $id, '$date')";
								$result = mysqli_query( $link, $query);
							} else {
								$query = "UPDATE blog_images SET name = '".cleanup($file_name)."', location = '$web_location' WHERE blog_id = '$id'";
								$result = mysqli_query( $link, $query);
							}

							$imgu_done = true;
							$upblogi = true;
						} else {
							$imgu_done = false;
						}
					}else{
						$imgu_done = false;
					}
				}

				if($imgu_done == true)
				{
					//echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" added.');</script>";
					//echo "HERE1";
					header("Location: ".$site_base."admin/index.php");
				}else{
					//echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your images.');</script>";
					//echo "HERE2";
					header("Location: ".$site_base."admin/index.php");
				}	
			}
		}else{
			echo "<script type='text/javascript'>alert('Content not found. Please enter all fields to submit blog.');</script>";
		}

		if($upblog == True && $upblogi == True){
			//echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" and image updated.');</script>";

			header("Location: ".$site_base."admin/index.php");
		}else if($upblog == True && $upblogi == False){
			//echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" updated.');</script>";
			//echo "HERE4";
			header("Location: ".$site_base."admin/index.php");
		}
	}

	if($id)
	{
		$query = "SELECT * FROM blogs where id='$id'";
		$result = mysqli_query( $link, $query);

		while($row=mysqli_fetch_array($result)){
			$title = stripslashes($row["title"]);
		   	$bcontent = $row["content"];
		   	$tags = $row["tags"];
		   	$featured = $row["featured"];
		   	$landing = $row["landing"];
		   	$headline = $row["headline"];
		   	$excerpt = $row["excerpt"];
		   	$coupon_id = $row["coupon_id"];
		   	$yturl = $row["youtube_url"];
		}

		$tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";
		$tres = mysqli_query( $link, $tquery);
		$img_urls = array();
		$img_ids = array();

		while($row2=mysqli_fetch_array($tres)){
			$img_urls[] = $row2["location"];
			$img_ids[] = $row2["id"];
		}
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
      <?php include "includes/content-edit.php"; ?>
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
