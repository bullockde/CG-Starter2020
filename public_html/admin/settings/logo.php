<?php

	$relative = "../";
	include $relative . "../src/crutchphp/config.php";

	if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }



	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

	mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error($link));



	function cleanup($field) 

	{

		//$clean = mysqli_real_escape_string($field);

		//return $clean;
		return $field;


	}

	

	if(isset($_POST['Submit'])) 

	{
		
		
		$title = isset($_POST["title"]) ? $_POST["title"] : "";

		$bcontent = isset($_POST["content"]) ? $_POST["content"] : "";

		$date = date("Y-m-d H:i:s");

		$yturl = isset($_POST["yturl"]) ? $_POST["yturl"] : "";

		$tags = isset($_POST["tags"]) ? $_POST["tags"] : "";

		$featured = isset($_POST["featured"]) ? $_POST["featured"] : "";

		$landing = isset($_POST["landing"]) ? $_POST["landing"] : "";

		if($featured == "False"){

			$featured = 0;

		}else{

			$featured = 1;

		}

		if($landing == "False"){
			$landing = 0;
		}else{
			$landing = 1;
		}

		$headline = isset($_POST["headline"]) ? $_POST["headline"] : "";

		$upblog = false;

		$upblogi = false;



			if($_FILES["bimgs"]["name"][0])

			{

				$img_amt = count($_FILES["bimgs"]["name"]);

				$imgu_done = false;

				for($i=0;$i<$img_amt;$i++)

				{

					$target_dir = $localpath."uploads/";

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

							$tquery = "SELECT * FROM blog_images WHERE  name='logo'";

							$tres = mysqli_query( $link, $tquery);

							$tnr = mysqli_num_rows($tres);



							if($tnr == 0){

								$query = "INSERT INTO blog_images (name, location, created) VALUES ('logo', '$web_location', '$date')";

								$result = mysqli_query( $link, $query);

							} else {

								$query = "UPDATE blog_images SET name = 'logo', location = '$web_location' WHERE name = 'logo'";

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
			


		

		if($upblog == True && $upblogi == True){

			echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" and image added.');</script>";

		}else if($upblog == True && $upblogi == False){

			echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" without image added.');</script>";

		}

		//if( $link->affected_rows > 0 ) { header('Location: /admin'); }

		
		
	}

	$tquery = "SELECT * FROM blog_images WHERE name='logo'";
	$tres = mysqli_query( $link, $tquery);
	$img_urls = array();
	$img_ids = array();

	while($row2=mysqli_fetch_array($tres)){
		$img_urls[] = $row2["location"];
		$img_ids[] = $row2["id"];
	}



	mysqli_close( $link );

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
	$page_title = "Upload Logo";
	include $relative . "head.php"; 
?>

<body>

	<?php include $relative . 'header.php'; ?>

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-12">

				<form method="post" role="form" enctype="multipart/form-data">

					<div class="clearfix">
									<b>Logo Image:</b><br />
									<?php
										$icnt = count($img_urls);
										if($icnt > 1){
											for($i=0;$i<$icnt;$i++)
											{
												echo "<div class='well col-md-4 text-center'><img src=\"".$site_base.$img_urls[$i]."\" width=\"200\" />";
												echo "<br><a href=\"".$site_base."admin/rmv_image.php?bid=".$id."&imid=".$img_ids[$i]."\" class=\"btn btn-danger\">Remove</a></div>";
											}
										}else{
											for($i=0;$i<$icnt;$i++)
											{
												echo "<img src=\"".$site_base.$img_urls[$i]."\" width=\"200\" />";
											}
										}
										
									?>
								</div>
								
								<div class="clearfix"></div><br />
					

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

						<input type="submit" name="Submit" value="Save" class="btn btn-primary form-control" />

					</div>

				</form>

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