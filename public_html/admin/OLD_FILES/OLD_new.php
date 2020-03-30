<?php

	include "../src/crutchphp/config.php";

	if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }



	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

	function cleanup($field) 

	{

		//$clean = mysqli_real_escape_string($field);

		//return $clean;
		return $field;


	}

	

	if(isset($_POST['Submit'])) 

	{
		
		
		$title = $_POST["title"];

		$bcontent = $_POST["content"];

		$excerpt = $_POST["excerpt"];

		$date = date("Y-m-d H:i:s");

		$yturl = $_POST["yturl"];

		$tags = $_POST["tags"];



		if($_POST["featured"] == "False"){

			$featured = 0;

		}else{

			$featured = 1;

		}

		if($_POST["landing"] == "False"){
			$landing = 0;
		}else{
			$landing = 1;
		}

		$headline = $_POST["headline"];

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



			$query = "INSERT INTO blogs (created,content,title,tags,featured,landing, headline, excerpt, coupon_id, youtube_url) VALUES ('".cleanup($date)."','".cleanup($bcontent)."','".cleanup($title)."','".cleanup($tags)."','".cleanup($featured)."','".cleanup($landing)."','".cleanup($headline)."','".cleanup($excerpt)."','".cleanup($coupon_id)."', '".cleanup($yturl)."')";

			//echo $query;

			$result = mysqli_query ( $link , $query ) or die("Insert Error: ".mysqli_error($link));

			//var_dump( $result );
			
			//$result = mysqli_query( $link, $query) or die("Insert Error: ".mysqli_error($link));

			$id = mysqli_insert_id( $link );
			


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



				if($imgu_done == false)

				{

					echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your images.');</script>";

				}

			}
			

		}else{

			echo "<script type='text/javascript'>alert('Content not found. Please enter all fields to submit blog.');</script>";

		}

		

		if($upblog == True && $upblogi == True){

			echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" and image added.');</script>";

		}else if($upblog == True && $upblogi == False){

			echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" without image added.');</script>";

		}

		if( $link->affected_rows > 0 ) { header('Location: '.$site_base.'admin'); }

		mysqli_close( $link );
		
	}



	

?>

<!DOCTYPE html>

<!--[if IE 6]>

<html id="ie6" dir="ltr" lang="en-US">

<![endif]-->

<!--[if IE 7]>

<html id="ie7" dir="ltr" lang="en-US">

<![endif]-->

<!--[if IE 8]>

<html id="ie8" dir="ltr" lang="en-US">

<![endif]-->

<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->

<html dir="ltr" lang="en-US">

<!--<![endif]-->

<?php 
	$page_title = "Home";
	include "head.php"; 
?>


<body>

	<?php include 'header.php'; ?>

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-12">

				<form method="post" role="form" enctype="multipart/form-data">

					<div class="form-group">

						<input type="text" class="form-control" name="title" placeholder="Blog Title" required />

					</div>

					<div class="form-group">

						<div class="input-group">

							<span class="input-group-btn">

								<span class="btn btn-primary btn-file">

									Browse <input type="file" name="bimgs[]" multiple>

								</span>

							</span>

							<input type="text" class="form-control" readonly>

						</div>

					</div>

					<div class="form-group">

						<input type="text" class="form-control" name="tags" placeholder="Blog Tags (sperate with a comma)" required />

					</div>

					<div class="form-group">

						<input type="text" class="form-control" name="yturl" placeholder="Youtube Video ID" />

					</div>

					<div class="form-group">

						<textarea class="form-control bcontent" name="content"></textarea>

					</div>

					<div class="form-group">

						<label for="featured">Featured?</label>

						<select name="featured" class="form-control" required>

							<option value="False" selected>False</option>

							<option value="True">True</option>

						</select>

					</div>

					<div class="form-group">

						<label for="landing">Landing Page?</label>

						<select name="landing" class="form-control" required>

							<option value="False" selected>False</option>

							<option value="True">True</option>

						</select>

					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="headline" placeholder="Landing Page Headliine .." <?php if( isset($id) ){ ?> value="<?php echo $headline; ?>" <?php } ?>/>
					</div>

					<div class="form-group">

						<textarea class="form-control" placeholder="Landing Page Excerpt .." name="excerpt"></textarea>

					</div>

					<div class="form-group coupons">

						<label for="coupon">Attach a Coupon?</label>
						<?php 

				            $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

				            
				            $query = "SELECT * FROM coupons ORDER BY id DESC";

				            
				            $result = mysqli_query($link,$query);
				            $num_rows = mysqli_num_rows($result);

				            $blog_html = "";

				            $blog_row_count = 0;
				            ?>



				        <div class="clearfix"></div>


				        <select class="form-control" name="coupon_id">
				        	<option value="0" <?php if($row['status']=="pending"){ echo ' selected'; } ?>>Select a Coupon</option>
				        <?php
				            while($row=mysqli_fetch_array($result)){
				                $img_loc = null;
				                $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				                $result2 = mysqli_query($link,$query2);

				                while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

				                
				                     ?> 
				                     <option value="<?php echo $row["id"]; ?>" <?php if($row["coupon_id"]==$row["id"]){ echo ' selected'; } ?>>- <?php echo $row["offer"]; ?> - <?php echo $row["title"]; ?></option>
				                    
				                    <?php

				            }

				            

				            mysqli_close($link);
				        ?>
				        </select>
					</div>

					<div class="form-group">

						<input type="submit" name="Submit" value="Save" class="btn btn-primary form-control" />

					</div>

				</form>
<p>image size should be 945px by 616px 300dpi</p>
			</div>

		</div>

	</div>



	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://cdn.rawgit.com/bootstrap-wysiwyg/bootstrap3-wysiwyg/master/dist/bootstrap3-wysihtml5.all.min.js"></script>

	<script type="text/javascript">

	$(function() {

		$(".bcontent").wysihtml5({

			toolbar: {

			  "image": false

			}

		});



		$(document).on('change', '.btn-file :file', function() {

			var input = $(this);

			var numFiles = input.get(0).files ? input.get(0).files.length : 1;

			var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

			input.trigger('fileselect', [numFiles, label]);

		});



		$('.btn-file :file').on('fileselect', function(event, numFiles, label){

			var input = $(this).parents('.input-group').find(':text');

			var log = numFiles > 1 ? numFiles + ' files selected' : label;



			if( input.length ) {

		  		input.val(log);

			} else {

		  		if( log ){ alert(log); }

			}

		});

	});

	</script>

</body>