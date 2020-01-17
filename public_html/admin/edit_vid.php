<?php

	include "../src/crutchphp/config.php";
	
	if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }

	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

	//var_dump($link);

	mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error($link));

	function cleanup($field) 
	{
		$clean = mysqli_real_escape_string($link,$field);
		return $clean;
	}

	$id = $_GET["id"]; 
	//echo "<br>ID=" . $id;
	
	if(isset($_POST['Submit']) && isset($id)) 
	{
		$title = $_POST["title"];
		$bcontent = $_POST["content"];
		$date = date("Y-m-d H:i:s");
		$yturl = $_POST["yturl"];
		$tags = $_POST["tags"];

		$duration = $_POST['duration'];
      	$heading = $_POST['heading'];
      	$excerpt = $_POST['excerpt'];
      	$overlay = $_POST['overlay'];
      	$widget = $_POST['widget'];
      	$button_text = $_POST['button_text'];
      	$button_link = $_POST['button_link'];
      	$priority = $_POST['priority'];
      	$board_id = $_POST['board_id'];

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

		$button = $_POST["button"];

		$headline = $_POST["headline"];

		$upblog = false;
		$upblogi = false;


		if(isset($bcontent))
		{

			if($featured == true)
			{
				$fqu = "UPDATE videos SET featured = 0";
				$fres = mysqli_query($link,$fqu);
			}
			
			$query = "UPDATE videos SET 
			content = '".$bcontent."', 
			title = '".$title."', 
			duration = '".$duration."',
			heading = '".$heading."',
			excerpt = '".$excerpt."',
			overlay = '".$overlay."',
			widget = '".$widget."',
			button_text = '".$button_text."',
			button_link = '".$button_link."',
			priority = '".$priority."',
			board_id = '".$board_id."'

			where id = '$id'";
			$result = mysqli_query($link,$query) or die(mysqli_error($link));

			if(mysqli_affected_rows($link) > 0){ $upblog = True; }


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
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "mp4" ) {
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

				if($imgu_done == true)
				{
					echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" added.');</script>";
				}else{
					echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your images.');</script>";
				}	
			}
		}else{
			echo "<script type='text/javascript'>alert('Content not found. Please enter all fields to submit blog.');</script>";
		}

		if($upblog == True && $upblogi == True){
			echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" and image updated.');</script>";
		}else if($upblog == True && $upblogi == False){
			echo "<script type='text/javascript'>alert('Blog entry \"".$title."\" updated.');</script>";
		}

		if(mysqli_affected_rows($link) > 0){
			header("Location: ".$site_base."admin/videos.php");
		}
	}

	if( $id )
	{
		
		$query = "SELECT * FROM videos where id='$id'";
		$result = mysqli_query($link,$query);

		while($row=mysqli_fetch_array($result)){
			$title = stripslashes($row["title"]);
		   	$bcontent = $row["content"];
		   	
		   	$tags = isset($row["tags"]) ? $row["tags"] : "";
		   	$featured = isset($row["featured"]) ? $row["featured"] : "";
		   	$landing = isset($row["landing"]) ? $row["landing"] : "";
		   	$headline = isset($row["headline"]) ? $row["headline"] : "";
		   	$yturl = isset($row["youtube_url"]) ? $row["youtube_url"] : "";
		   	$video_title = isset($row["video_title"]) ? $row["video_title"] : "";
		   	
		   	$location = $row['location'];
		   	$duration = $row['duration'];
          	$heading = $row['heading'];
          	$excerpt = $row['excerpt'];
          	$overlay = $row['overlay'];
          	$button_text = $row['button_text'];
          	$button_link = $row['button_link'];
          	$widget = $row['widget'];
          	$priority = $row['priority'];
          	$board_id = $row['board_id'];
		}

		$tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";
		$tres = mysqli_query($link,$tquery);
		$img_urls = array();
		$img_ids = array();

		while($row2=mysqli_fetch_array($tres)){
			$img_urls[] = $row2["location"];
			$img_ids[] = $row2["id"];
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
	<title><?php echo $admin_name ?> v<?php echo $admin_ver; ?> - Editing Blog '<?php echo $title ?>'</title>
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
        iframe{
            height: 500px !important;
        }
	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="#"><?php echo $admin_name ?></a>
		  </div>
		  <div id="navbar" class="navbar-collapse collapse">
		    <ul class="nav navbar-nav">
		      <li><a href="<?php echo $site_base; ?>admin/videos.php">Home</a></li>
		      <li class="active"><a href="<?php echo $site_base; ?>admin/edit.php?id=<?php echo $_GET['id']; ?>">Edit Post</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="?logout">Logout</a></li>
		    </ul>
		  </div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<form method="post" role="form" enctype="multipart/form-data">
				
						<div class="form-group video">
						<input type="text" class="form-control" name="title" placeholder="Blog Title" <?php if($id){ ?> value="<?php echo $title; ?>" <?php } ?>/>
						<?php 
							if (!empty($location)){

    							?>
    								<video width="320" height="240" controls>
									  <source src="<?php echo $location; ?>" type="video/mp4">
										Your browser does not support the video tag.
									</video>
									Path: <?php echo $location; ?>
    							<?php
    						}
						?>
						<br>
						
				      	<!--Upload Video: <input type='file' class="form-control" name='file' />-->

				      	<label>Heading:</label>
						<input type='text' class="form-control" name='heading' placeholder="Heading" value="<?php echo $heading; ?>" />
						<label>Excerpt:</label>
						<input type='text' class="form-control" name='excerpt' placeholder="Excerpt" value="<?php echo $excerpt; ?>" />
						
						<label>Content:</label>
						<div class="form-group">
							<textarea class="form-control bcontent" name="content"><?php if($id){ echo $bcontent; } ?></textarea>
						</div>
						<label>Video Overlay:</label>
						<input type='text' class="form-control" name='overlay' placeholder="Video Overlay" value="<?php echo $overlay; ?>" />
						<label>Widget Code:</label>
						<input type='text' class="form-control" name='widget' placeholder="Widget Code" value="<?php echo $widget; ?>" />
						<label>Button Text:</label>
						<input type='text' class="form-control" name='button_text' placeholder="Button Text" value="<?php echo $button_text; ?>" />
						<label>Button Link:</label>
						<input type='text' class="form-control" name='button_link' placeholder="Button Link" value="<?php echo $button_link; ?>" />
						<label>Duration:</label>
						<input type='text' class="form-control" name='duration' placeholder="Duration" value="<?php echo $duration; ?>" />
						<label>Priority:</label>
						<input type='text' class="form-control" name='priority' placeholder="Priority" value="<?php echo $priority; ?>" />
						<label>Board ID:</label>
						<input type='text' class="form-control" name='board_id' placeholder="Board ID" value="<?php echo $board_id; ?>" />





					</div>
			<!--		
					<div class="form-group">
						<div class="clearfix">
							<b>Currently Used Image</b><br />
							<?php
								$icnt = count($img_urls);
								if($icnt > 1){
									for($i=0;$i<$icnt;$i++)
									{
										echo "<div class='well col-md-4 text-center'><img src=\"".$site_base.$img_urls[$i]."\" width=\"200\" height=\"200\" />";
										echo "<br><a href=\"".$site_base."admin/rmv_image.php?bid=".$id."&imid=".$img_ids[$i]."\" class=\"btn btn-danger\">Remove</a></div>";
									}
								}else{
									for($i=0;$i<$icnt;$i++)
									{
										echo "<img src=\"".$site_base.$img_urls[$i]."\" width=\"200\" height=\"200\" />";
									}
								}
								
							?>
						</div><br />
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
						<input type="text" class="form-control" name="tags" placeholder="Blog Tags (sperate with a comma)" <?php if($id){ ?> value="<?php echo $tags; ?>" <?php } ?>/>
					</div>
-->
<!--					<div class="form-group">
						<input type="text" class="form-control" name="yturl" placeholder="Youtube Video ID" <?php if($id){ ?> value="<?php echo $yturl; ?>" <?php } ?>/>
					</div>
					
					

					<div class="form-group">
						<label for="featured">Featured?</label>
						<select name="featured" class="form-control">
							<?php if($id && $featured == false){ ?>
							<option value="False">False</option>
							<option value="True">True</option>
							<?php }else if($id && $featured == true){ ?>
							<option value="True">True</option>
							<option value="False">False</option>
							<?php }else{ ?>
							<option value="False">False</option>
							<option value="True">True</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="featured">Landing Page?</label>
						<select name="landing" class="form-control">
							<?php if($id && $landing == false){ ?>
							<option value="False">False</option>
							<option value="True">True</option>
							<?php }else if($id && $landing == true){ ?>
							<option value="True">True</option>
							<option value="False">False</option>
							<?php }else{ ?>
							<option value="False">False</option>
							<option value="True">True</option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="headline" placeholder="Landing Page Headliine .." <?php if($id){ ?> value="<?php echo $headline; ?>" <?php } ?>/>
					</div>

					<div class="form-group">
						<label for="featured">Call Button?</label>
						<select name="button" class="form-control">
							<?php if($id && $button == true){ ?>
							<option value="1">Button</option>
							<option value="0">Text</option>
							<?php }else if($id && $button == false){ ?>
							<option value="0">Text</option>
							<option value="1">Button</option>
							<?php }else{ ?>
							<option value="0">Text</option>
							<option value="1">Button</option>
							<?php } ?>
						</select>
					</div>
-->
				

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