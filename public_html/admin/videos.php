<?php
include "../src/crutchphp/config.php";
if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }

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
	<title><?php echo $admin_name ?> v<?php echo $admin_ver; ?> - Home</title>
	<meta name="description" content="<?php echo $admin_name ?> v<?php echo $admin_ver; ?>" />
	<meta name="author" content="Oscuro Designs" />
	<link rel='canonical' href='<?php echo $site_base; ?>' />
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://cdn.rawgit.com/bootstrap-wysiwyg/bootstrap3-wysiwyg/master/src/bootstrap3-wysihtml5.css" rel="stylesheet" />
	<style>
		.event { position: relative; width: 100%; height: 100%; padding-bottom: 20px; display: inline-block; }
		.event-info, .event-image { position: relative; display: block; }
		.event-info { height: 100%; float: left; width: 44%; }
		.event-image { float: right; width: 56%; }
		.event-image > img { height: 30%; width: 30%;}
		div.buttons {
		    position: absolute;
		    bottom: 0;
		    left: 0;
		    right: 0;
		    padding: 0 5px 0 8px;
		}
		input[type="text"] {
		    width: 100%;
		}

		@media only screen and (min-width : 768px) {
		    .is-table-row {
		        display: table-row;

		    }
		    .is-table-row [class*="col-"] {
		        float: none;
		        display: table-cell;
		        vertical-align: top;
		        height:;
		    }
		}
	</style>

	<?php 

//echo "<br>Start Page!";



		$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

		$videos	= "CREATE TABLE IF NOT EXISTS `videos` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `title` varchar(255) DEFAULT NULL,
			 `location` varchar(255) DEFAULT NULL,
			 `duration` varchar(255) DEFAULT NULL,
			 `created` datetime NOT NULL,
			 `heading` varchar(200) DEFAULT NULL,
			 `excerpt` varchar(250) DEFAULT NULL,
			 `content` varchar(800) DEFAULT NULL,
			 `overlay` int(11) DEFAULT '1',
			 `button_text` varchar(200) DEFAULT NULL,
			 `button_link` varchar(200) DEFAULT NULL,
			 `widget` varchar(500) DEFAULT NULL,
			 `priority` int(11) DEFAULT '0',
			 `board_id` int(11) DEFAULT '0',
			 PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";

			 mysqli_query($link,$videos);

			$video_images = "CREATE TABLE IF NOT EXISTS `video_images` (
			 `id` int(11) NOT NULL,
			 `name` text COLLATE utf8_unicode_ci NOT NULL,
			 `location` text COLLATE utf8_unicode_ci NOT NULL,
			 `video_id` int(11) NOT NULL,
			 `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			 `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

			 mysqli_query($link,$video_images);


		if(isset($_POST['but_upload'])){

			//echo "Starting Upload .. ";
	       $maxsize = 52428800; // 50MB

	       
	 
	       $title = $_FILES['file']['name'];

	       //echo "<br>Name: " . $title;

	       $target_dir = "videos/";
	       $target_file = $target_dir . $_FILES["file"]["name"];

	       //echo "<br>Target File: " . $target_file;

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

	          	//echo "Uploading ...";
	          	$duration = $_POST['duration'];
	          	$heading = $_POST['heading'];
	          	$excerpt = $_POST['excerpt'];
	          	$content = $_POST['content'];
	          	$button_text = $_POST['button_text'];
	          	$button_link = $_POST['button_link'];
	          	$overlay = $_POST['overlay'];
	          	$widget = $_POST['widget'];
	          	$priority = $_POST['priority'];
	          	$board_id = $_POST['board_id'];

	          	$theme = $_POST['theme'];

	            // Upload
	            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
	              // Insert record
	              $query = "INSERT INTO videos(title,location,duration,heading,excerpt,content,theme,overlay,button_text,button_link, widget,board_id) VALUES('".$title."','".$target_file."' ,'".$duration."','".$heading."','".$excerpt."','".$content."','".$theme."','".$overlay."','".$button_text."','".$button_link."','".$widget."','".$board_id."')";

	              mysqli_query($link,$query);

	              //echo "Upload successfully.";
	            }
	          }

	       }else{
	          echo "Invalid file extension.";
	       }
	 
	     } 


		

	?>
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
		      <li class="active"><a href="<?php echo $site_base; ?>admin/">Home</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/new_vid.php">New Video</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/boards.php">Video Boards</a></li>
		      <!--<li><a href="<?php echo $site_base; ?>admin/videos.php">Videos</a></li>
		      <li><a target="_blank" href="<?php echo $site_base; ?>admin/vid/">Video Board -></a></li>-->
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="<?php echo $site_base; ?>admin/login.php?logout">Logout</a></li>
		    </ul>
		  </div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
	<div class="container-fluid">

		<div class="col-md-8 col-md-offset-2 well">

			<form method="post" enctype='multipart/form-data'>
				<div class="col-md-8">
					<label>Video Upload: </label> &nbsp;&nbsp;<a target="_blank" href="https://youtubemp4.to/">Convert - YouTube to MP4 >></a>
					<br>

					<input type='file' name='file' />
					<br>
					<label>Details:  <small>(optional)</small></label>
					<br>
					<div class="row">	
						<div class="col-md-6">
							<input type='text' name='heading' placeholder="Heading" style="width: 100%;" />
						</div>
						<div class="col-md-6">
							<input type='text' name='excerpt' placeholder="Excerpt" style="width: 100%;" />
						</div>
					</div>
					<br>
					<textarea name='content' placeholder="Content" style="width: 100%;"></textarea>

					<div id="" class="row">
						<div class="col-md-4">
							<input type='text' name='duration' placeholder="Duration" />
						</div>
						<div class="col-md-4">
							<input type='text' name='priority' placeholder="Priority" />
						</div>
						<div class="col-md-4">
							<input type='text' name='board_id' placeholder='Board ID' value='<?php echo $_GET['board_id']; ?>' />
						</div>
				    </div>


					<br>
					<input type='submit' value='Upload' name='but_upload' class='btn btn-primary' >
				</div>
				<div class="col-md-4 text-center hidden-xs  well ">

					<label>Video Overlay?</label><br>
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
					No <input type="radio" value="0" name="widget"><br>


					<div class="clearfix"></div>
					<br>
				    <label>Video Layout:</label><br>


					<select name="theme">
						<option value="#">Select a Theme / Layout</option>
						<option value="logo">1 col - Logo </option>
						<option value="featured-middle">1 col - Featured </option>
						<option value="left">2 col - Video Left </option>
						<option value="right">2 col - Video Right </option>
						<option value="featured-right">2 col - Video Right (Featured) </option>
						<option value="featured-logo">2 col - Video Right (Featured/LOGO)</option>
						<option value="middle">3 col - Video Middle </option>
						<option value="three-left">3 col - Video Left </option>
						<option value="three-right">3 col - Video Right </option>
						<option value="third-left">1/3 col - Video Left </option>
					</select>
		      	<div class="clearfix"></div>


				</div>
					<div class="clearfix"></div>
		    </form>
	    </div>


	    <div class="clearfix"></div>

	    <div class="row is-table-row ">
	   
		<?php

			// page check
			$pguery = "SELECT * FROM videos ORDER BY priority ASC";
			$pgr = mysqli_query($link,$pguery);
			$pgnr = mysqli_num_rows($pgr);
			$pcount = (int)ceil($pgnr/9);

			if( isset($_GET["page"]) )
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

			$blog_html = "";

			$blog_row_count = 0;
			while($row=mysqli_fetch_array($result)){
				$img_loc = null;
				$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				$result2 = mysqli_query($link,$query2);

				while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

				
					 ?> 
				    <div class='col-md-4 well slide'>
				        
				        <!--<?php echo $row["title"]; ?><br><br>-->
				        <div class='col-sm-6 text-center hidden'>
				        <?php 
				            
				            echo "<center><img src=\"" . $site_base . $img_loc . "\" class='img-responsive'  \></center>"; ?>
				                    <?php
						
						            $id = $row["id"];
						        	//$tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";

						        	$tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";
									$tres = mysqli_query($link,$tquery) or die("blog_images error: ".mysqli_error($link));
									$tnr = mysqli_num_rows($tres);

                            		//$tres = mysqli_query($conn, $tquery);
                            
                            		$img_urls = array();
                            
                            		$img_ids = array();
                            
                            
                            
                            		while($row2=mysqli_fetch_array($tres)){
                            
                            			$img_urls[] = $row2["location"];
                            
                            			$img_ids[] = $row2["id"];
                            
                            		}
                            		
								        $icnt = count($img_urls);

        								if($icnt > 1){
        								    
        
        									for($i=1;$i<$icnt;$i++)
        
        									{
                                                ?>
                                                <div class='pull-left '>
                                                    
        												<img src='<?php echo $site_base.$img_urls[$i]; ?>' width='50' height='50' style='margin: 4px;' />
        											
                                                    
                                                    
                                                </div>
        									
                                                <?php
        									}
        
        								}else{
        								    ?>
        								    <br>
        								    <a href='<?php echo $site_base . "admin/edit_vid.php?id=" . $row["id"]; ?>' class='btn btn-default'>Add Images</a>
        								    <br><br class='visible-xs'>
        								   <?php
        								}
								    ?>
				       
				        </div>
				        <?php
				            if (!empty($row["youtube_url"]))
    						{
        						echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
    						}else{

    							?>
    								<video id="video-<?php echo $row["id"]; ?>" width="100%" controls>
									  <source src="<?php echo $row["location"]; ?>" type="video/mp4">
										Your browser does not support the video tag.
									</video>

									<br><br>

									<button class="duration" type="button">Get video length</button><br>


    							<?php
    						}
						?>
						<div class="clearfix"></div><br>	
						<label>Board ID:</label> <?php echo $row["board_id"]; ?>
						<br>
						<label>Priority:</label> <?php echo $row["priority"]; ?>
						<br>
						<label>Heading:</label> <?php echo $row["heading"]; ?>
						<br>
						<label>Excerpt:</label> <?php echo $row["excerpt"]; ?>
						<br>
						<label>Content:</label> <?php echo $row["content"]; ?>
						<br>
					<!--	<label>Widget Code:</label> <?php echo $row["widget"]; ?>
						<br>

						<label>Duration:</label> <?php echo $row["duration"]; ?>
						<br>
						-->
						
						


						<div class="clearfix"></div><br>		    
			<!--	         <?php 
				            if ($row["featured"] == true)
    						{
    						    echo "<b>Featured</b>  >> ";
    						}
    					
    						if ($row["landing"] == true)
    						{
    						    echo "<b>Landing Page</b> ";
    						}
				        ?> >> <?php echo $row["tags"]; ?><br><br>
				        <?php echo "<p>Created: <b>" . date("m-d-Y", strtotime($row["created"])) . "</b><br />Modified: <b>" . date("m-d-Y", strtotime($row["modified"])) . "</b></p><br />"; ?>
			-->
				        <div class="clearfix"></div><br>
				        <?php echo "<div class='buttons'><ul class=\"list-inline buttons d-flex align-items-baseline\"><li><a href=\"" . $site_base . "admin/edit_vid.php?id=" . $row["id"] . "\" class=\"btn btn-default\">Edit</a></li>"; ?>
				        <?php echo "<li><a href=\"" . $site_base . "admin/delete_vid.php?id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>
				       
				       
				        <li class='pull-right'><a target='_blank' href='<?php echo $site_base . "admin/vid/preview.php?id=" . $row["id"]; ?>' class='btn btn-success '>Preview >></a></li>

				        <?php

				        $landing = isset($row["landing"]) ? $row["landing"] : "";


				       	if ($landing == true)
    						{

    							if ($row["landing"] == true) {
    							?>

    						   <li class='pull-right'><a target='_blank' href='/services/<?php echo urlencode(str_replace(' ', '-', $row[title])); ?>/<?php echo $row[id]; ?>' class='btn btn-default '>Landing Page</a></li>

    						    <?php
    						    }
    						}
				       ?>
        				</ul>
        				</div>				    
				    </div>
				    
				    <?php

					if ($blog_row_count % 3 === 0 && $blog_row_count !== 0)
						{
						$blog_html.= "</div><div class=\"row\">";
						}
					  else
					if ($blog_row_count == 0)
						{
						$blog_html.= "<div class=\"row\">";
						}

					$blog_html.= "<div class=\"col-md-4\"><div class=\"row\">";
					if (!empty($row["youtube_url"]) || isset($img_loc))
						{
						$blog_html.= "<div class=\"col-md-6\">";
						}
					  else
						{
						$blog_html.= "<div class=\"col-md-12\">";
						}

					$modified = isset($row["modified"]) ? $row["modified"] : "";
                    
					$blog_html.= "<h1>" . $row["title"] . "</h1><p>Created: <b>" . $row["created"] . "</b><br />Modified: <b>" . $modified . "</b></p><br />";
					$blog_html.= "<ul class=\"list-inline buttons\"><li><a href=\"" . $site_base . "admin/edit_vid.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";
					$blog_html.= "<li><a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Delete</a></li>";
					
					$featured = isset($row["featured"]) ? $row["featured"] : "";

					if ($featured == true)
						{
						$blog_html.= "<li><b>Featured</b></li></ul></div>";
						}
					  else
						{
						$blog_html.= "</ul></div>";
						}

					if (!empty($row["youtube_url"]))
						{
						$blog_html.= '<div class="col-md-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
						}
					  else
					if (isset($img_loc))
						{
						$blog_html.= "<div class=\"col-md-6\"><img src=\"" . $site_base . $img_loc . "\" style=\"width: 100%; height: 100%;\" \></div>";
						}

					$blog_html.= "</div></div>";
					$blog_row_count++;

					if ($blog_row_count % 3 === 0) { echo "</div><div class='row is-table-row'>"; }

			
			}

			

			//mysql_close();
			
		?>

		</div>

		<div class="clearfix"></div>
		<div class="col-sm-12">
			<ul class="pagination">
				<?php 

					$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

					mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error($link));

		
					
					$query = "SELECT * FROM videos";

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
						$pcount = (int)ceil($num_rows/12);
						
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

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	<script type="text/javascript">

	function yesnoCheck( id ) {
	    if (document.getElementById('yesCheck').checked) {
	        document.getElementById(id).style.display = 'block';
	    }
	    else document.getElementById(id).style.display = 'none';

	}

	</script>

	<script type="text/javascript">
		
		$.fn.carousel.Constructor.prototype.cycle = function (event) {
    
	    if (!event) {
	        this._isPaused = false;
	      }

	      if (this._interval) {
	        clearInterval(this._interval)
	        this._interval = null;
	      }

	      if (this._config.interval && !this._isPaused) {
	          
	        var $ele = $('.carousel-item-next');
	        var newInterval = $ele.data('interval') || this._config.interval;
	        this._interval = setInterval(
	          (document.visibilityState ? this.nextWhenVisible : this.next).bind(this),
	          newInterval
	        );
	      }
	};


	</script>

	<script>
	//var vid = document.getElementById("myVideo");


	 $(document).ready(function(){
         $("button.duration").on("click", function () {
            var v = $(this).siblings("video").attr("id");
            var vid = document.getElementById(v);
            alert("Duration: " + (vid.duration * 1000));
         });
     });
	</script> 

</body>