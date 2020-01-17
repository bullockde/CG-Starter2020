<?php



	include "../src/crutchphp/config.php";

	if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }



	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

	mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());



	function cleanup($field) 

	{

		$clean = mysqli_real_escape_string($link,$field);

		return $clean;

	} 

	

	if(isset($_POST['Submit'])) 

	{

		$title = $_POST["title"];

		$content = $_POST["content"];

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
		$button = $_POST["button"];

		$headline = $_POST["headline"];

		$upblog = false;

		$upblogi = false;

		if(isset($_POST['Submit'])){
	       $maxsize = 52428800; // 50MB
	 
	       $video_title = $_FILES['file']['name'];

	       echo "<br>Name: " . $video_title;

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
	          	$duration = $_POST['duration'];
	          	$heading = $_POST['heading'];
	          	$excerpt = $_POST['excerpt'];
	          	$overlay = $_POST['overlay'];
	          	$widget = $_POST['widget'];
	          	$priority = $_POST['priority'];
	          	$board_id = $_POST['board_id'];

	            // Upload
	            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
	              // Insert record
	              //$query = "INSERT INTO videos(title,location,duration,heading,content,widget) VALUES('".$title."','".$target_file."' ,'".$duration."','".$heading."','".$content."','".$widget."')";

	              //mysql_query($query);

	              echo "Upload successfully.";
	            }
	          }

	       }else{
	          echo "Invalid file extension.";
	       }
	 
	     } 



		if(isset($content))

		{

			if($featured == true)

			{

				$fqu = "UPDATE videos SET featured = 0";

				$fres = mysqli_query($link,$fqu);

			}


			$query = "INSERT INTO videos(title,location,duration,heading,excerpt,content,overlay,button_text,button_link, widget,priority,board_id) VALUES('".$video_title."','".$target_file."' ,'".$duration."','".$heading."','".$excerpt."','".$content."','".$overlay."','".$button_text."','".$button_link."','".$widget."','".$priority."','".$board_id."')";

	              mysqli_query($link,$query) or die("Insert Error: ".mysqli_error($link));

			$id = mysqli_insert_id($link);



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

					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);



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

							$tres = mysqli_query($link,$tquery);

							$tnr = mysqli_num_rows($tres);



							if($tnr == 0){

								$query = "INSERT INTO blog_images (name, location, blog_id, created) VALUES ('".cleanup($file_name)."', '$web_location', $id, '$date')";

								$result = mysqli_query($link,$query);

							} else {

								$query = "UPDATE blog_images SET name = '".cleanup($file_name)."', location = '$web_location' WHERE blog_id = '$id'";

								$result = mysqli_query($link,$query);

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

		if(mysqli_affected_rows($link) > 0){
			header("Location: ".$site_base."admin/videos.php");
		}

	}



	mysqli_close($link);

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

<head>  

	<meta charset="UTF-8" />

	<meta name="viewport" content="width=device-width" />

	<title><?php echo $admin_name ?> v<?php echo $admin_ver; ?> - New Blog</title>

	<meta name="description" content="<?php echo $admin_name ?> v<?php echo $admin_ver; ?>" />

	<meta name="author" content="Oscuro Designs" />

	<link rel='canonical' href='<?php echo $site_base; ?>' />

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" media="screen" />

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />

	<link href="https://cdn.rawgit.com/bootstrap-wysiwyg/bootstrap3-wysiwyg/master/src/bootstrap3-wysihtml5.css" rel="stylesheet" />

	<style>

		.btn-file { position: relative; overflow: hidden; }

		.btn-file input[type=file] { position: absolute; top: 0; right: 0; min-width: 100%; min-height: 100%; font-size: 100px; text-align: right; filter: alpha(opacity=0); opacity: 0; outline: none; background: white; cursor: inherit; display: block; }

		input[readonly] { background-color: white !important; cursor: text !important; }

	</style>

</head>

<body>

	<?php include 'header.php'; ?>

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-12">



				<form method="post" role="form" enctype="multipart/form-data">

					<div class=" well">

			
				<div class="col-md-8">
					<label>Video Upload: </label> &nbsp;&nbsp;<a target="_blank" href="https://youtubemp4.to/">Convert - YouTube to MP4 >></a>
					<br>

					<input type='file' name='file' />
					<br>
					
					<div class="row">	
						<div class="col-md-6">
							<label>Heading:</label>
							<input type='text' class="form-control" name='heading' placeholder="Heading" />
						</div>
						<div class="col-md-6">
							<label>Excerpt:</label>
							<input type='text' class="form-control" name='excerpt' placeholder="Excerpt" />
						</div>
					</div>
					<br>
					<label>Content:</label>
						<div class="form-group">
							<textarea class="form-control bcontent" name="content"></textarea>
						</div>

					

					<div class="row">
						<div class="col-md-4">
							<label>Duration:</label>
							<input type='text' class="form-control" name='duration' placeholder="Duration" />
						</div>
						<div class="col-md-4">
							<label>Priority:</label>
							<input type='text' class="form-control" name='priority' placeholder="Priority" />
						</div>
						<div class="col-md-4">
							<label>Board ID:</label>
							<input type='text' class="form-control" name='board_id' placeholder="Board ID" />
						</div>

					</div>
					
					
					
				</div>
				<div class="col-md-4 text-center ">
					<h3>Theme Options</h3><br>
					<div class="well">

						
						<label>Text Overlay?</label><br>
						Yes <input type="radio" value="1" name="overlay"> 
						No <input type="radio" value="0" name="overlay"><br><br>
						<label>Button?</label><br>
						Yes <input type="radio" onclick="javascript:yesnoCheck('ifButton');" name="ifButton" id="yesCheck"> 
						No <input type="radio" onclick="javascript:yesnoCheck('ifButton');" name="ifButton" id="noCheck"><br>
					    <div id="ifButton" style="display:none">
					        <input type='text' name='button_text' placeholder="Button Text" />
							<input type='text' name='button_link' placeholder="http://" />
					    </div>
					    <br>
					    <label>Weather Widget?</label><br>
						Yes <input type="radio" value="1" name="widget"> 
						No <input type="radio" value="0" name="widget"><br><br>

						
					</div>
				</div>
				<div class="clearfix"></div><br>
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

	function yesnoCheck( id ) {
	    if (document.getElementById('yesCheck').checked) {
	        document.getElementById(id).style.display = 'block';
	    }
	    else document.getElementById(id).style.display = 'none';

	}

	</script>

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