<?php
	include "/home2/evanspe1/public_html/src/crutchphp/config.php";
	if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }


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
	          	$duration = $_POST['duration'];
	          	$heading = $_POST['heading'];
	          	$content = $_POST['content'];
	          	$widget = $_POST['widget'];

	            // Upload
	            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
	              // Insert record
	              $query = "INSERT INTO slides(title,location,duration,heading,content,widget) VALUES('".$title."','".$target_file."' ,'".$duration."','".$heading."','".$content."','".$widget."')";

	              mysql_query($query);

	              echo "Upload successfully.";
	            }
	          }

	       }else{
	          echo "Invalid file extension.";
	       }
	 
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
<head>  
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php echo $admin_name ?> v<?php echo $admin_ver; ?> - Home</title>
	<meta name="description" content="<?php echo $admin_name ?> v<?php echo $admin_ver; ?>" />
	<meta name="author" content="Oscuro Designs" />
	<link rel='canonical' href='<?php echo $site_base; ?>' />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://cdn.rawgit.com/bootstrap-wysiwyg/bootstrap3-wysiwyg/master/src/bootstrap3-wysihtml5.css" rel="stylesheet" />
	<style>
		.event { position: relative; width: 100%; height: 100%; padding-bottom: 20px; display: inline-block; }
		.event-info, .event-image { position: relative; display: block; }
		.event-info { height: 100%; float: left; width: 44%; }
		.event-image { float: right; width: 56%; }
		.event-image > img { height: 30%; width: 30%;}
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
		      <li class="active"><a href="<?php echo $site_base; ?>admin/">Home</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/new-slide.php">New Post</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="<?php echo $site_base; ?>admin/login.php?logout">Logout</a></li>
		    </ul>
		  </div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
	<div class="container-fluid">

		<?php 
			$link = mysql_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"]) or die("Database Error: Invalid Username or Password ".mysql_error());

			mysql_select_db($DB_MYSQL["database"]) or die("Database Error: Database not found ".mysql_error());



		$sql = "CREATE TABLE IF NOT EXISTS `slides` (
		  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		  `title` text NOT NULL,
		  `youtube_url` text DEFAULT NULL,
		  `content` text NOT NULL,
		  `tags` text NOT NULL,
		  `featured` tinyint(1) DEFAULT 0,
		  `landing` int(11) DEFAULT 0,
		  `button` int(11) DEFAULT 0,
		  `headline` varchar(200) DEFAULT NULL,
		  `created` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
		  `modified` timestamp on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		  `video_title` varchar(255) NOT NULL,
		  `location` varchar(255) NOT NULL,
		  `duration` varchar(255) NOT NULL,
		  `heading` varchar(200) DEFAULT NULL,
		  `excerpt` mediumtext DEFAULT NULL,
		  `widget` varchar(500) DEFAULT NULL,
		  `priority` int(11) NOT NULL DEFAULT '0'
		) ENGINE=MyISAM DEFAULT CHARSET=utf8";
		$video_table = mysql_query($sql)or die(mysql_error());



			// page check
			$pguery = "SELECT * FROM slides ORDER BY created DESC";
			$pgr = mysql_query($pguery);
			$pgnr = mysql_num_rows($pgr);
			$pcount = (int)ceil($pgnr/9);

			if($_GET["page"])
			{	
				if($_GET["page"] > $pcount)
				{
					$query = "SELECT * FROM slides ORDER BY created DESC LIMIT 0 , 9";
				}else{
					$plim = (intval($_GET["page"])-1) * 9;
					$query = "SELECT * FROM slides ORDER BY created DESC LIMIT ".$plim." , 9";
				}
			}else{
				$query = "SELECT * FROM slides ORDER BY created DESC LIMIT 0 , 9";
			}

			$result = mysql_query($query);
			$num_rows = mysql_num_rows($result);

			$blog_html = "";

			$blog_row_count = 0;
			while($row=mysql_fetch_array($result)){
				$img_loc = null;
				$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				$result2 = mysql_query($query2);

				while($row2=mysql_fetch_array($result2)){ $img_loc = $row2['location']; }

				
					 ?> 
				    <div class='col-lg-4 well'>
				        
				        <?php echo $row["title"]; ?><br><br>
				        <div class='col-sm-6 text-center'>
				        <?php 
				            
				            echo "<center><img src=\"" . $site_base . $img_loc . "\" class='img-responsive'  \></center>"; ?>
				                    <?php
						
						            $id = $row["id"];
						        	//$tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";

						        	$tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";
									$tres = mysql_query($tquery) or die("blog_images error: ".mysql_error());
									$tnr = mysql_num_rows($tres);

                            		//$tres = mysqli_query($conn, $tquery);
                            
                            		$img_urls = array();
                            
                            		$img_ids = array();
                            
                            
                            
                            		while($row2=mysql_fetch_array($tres)){
                            
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
        								    <a href='<?php echo $site_base . "admin/edit_slide.php?id=" . $row["id"]; ?>' class='btn btn-default'>Add Images</a>
        								    <br><br class='visible-xs'>
        								   <?php
        								}
								    ?>
				       
				        </div>
				        <?php
				            if (!empty($row["youtube_url"]))
    						{
        						echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
    						}

    						if (!empty($row["location"])){

    							?>
    								<video width="320" height="240" controls>
									  <source src="<?php echo $row["location"]; ?>" type="video/mp4">
										Your browser does not support the video tag.
									</video>
    							<?php
    						}
						?>

						<div class="clearfix"></div><br>		    
				         <?php 
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
				        <?php echo "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit_slide.php?id=" . $row["id"] . "\" class=\"btn btn-default\">Edit</a></li>"; ?>
				        <?php echo "<li><a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>
				       
				       
				        <li class='pull-right'><a target='_blank' href='<?php echo $site_base . "blog/?id=" . $row["id"]; ?>' class='btn btn-success '>View Post >></a></li>

				        <?php
				       	if ($row["landing"] == true)
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
                    
					$blog_html.= "<h1>" . $row["title"] . "</h1><p>Created: <b>" . $row["created"] . "</b><br />Modified: <b>" . $row["modified"] . "</b></p><br />";
					$blog_html.= "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit_slide.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";
					$blog_html.= "<li><a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Delete</a></li>";
					if ($row["featured"] == true)
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

					if ($blog_row_count % 3 === 0) { echo "<div class='clearfix'></div>"; }

			
			}

			

			mysql_close();
		?>

		<div class="clearfix"></div>
		<div class="col-sm-12">
			<ul class="pagination">
				<?php 
					$link = mysql_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"]) or die("Database Error: Invalid Username or Password ".mysql_error());
					mysql_select_db($DB_MYSQL["database"]) or die("Database Error: Database not found ".mysql_error());
					
					$query = "SELECT * FROM slides ORDER BY modified DESC";

					if($_GET["page"])
					{
						$pg = $_GET["page"];
					}else{
						$pg = 1;
					}

					$result = mysql_query($query);
					$num_rows = mysql_num_rows($result);

					$plinks = "";

					if($num_rows > 0)
					{
						$pcount = (int)ceil($num_rows/9);
						
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
</body>