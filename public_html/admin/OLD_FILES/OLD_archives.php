<?php
	include "../src/crutchphp/config.php";
	if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }

	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

	mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error());

	if( isset( $_POST['status'] ) ){

		$status = $_POST['status'];
		$id = $_POST['id'];
		$status_update = "UPDATE leads SET status = '$status' WHERE id = '$id'";
		$pgr = mysqli_query($link,$status_update);
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
<?php include 'head.php'; ?>
<body>
	
	<?php include 'header.php'; ?>
	
	<div class="container-fluid">

		

		
		<h1>
			Archives
			<a href="<?php echo $site_base; ?>admin/leads.php" class=" pull-right btn btn-default" ><< Go to Leads</a>
		</h1>

		<?php 
			

			// page check
			$pguery = "SELECT * FROM leads WHERE deleted = 1 ORDER BY id DESC";
			$pgr = mysqli_query($link,$pguery);
			$pgnr = mysqli_num_rows($pgr);
			$pcount = (int)ceil($pgnr/8);

			if($_GET["page"])
			{	
				if($_GET["page"] > $pcount)
				{
					$query = "SELECT * FROM leads WHERE deleted = 1 ORDER BY id DESC LIMIT 0 , 8";
				}else{
					$plim = (intval($_GET["page"])-1) * 8;
					$query = "SELECT * FROM leads WHERE deleted = 1 ORDER BY id DESC LIMIT ".$plim." , 8";
				}
			}else{
				$query = "SELECT * FROM leads WHERE deleted = 1 ORDER BY id DESC LIMIT 0 , 8";
			}

			$result = mysqli_query($link,$query);
			$num_rows = mysqli_num_rows($result);

			$blog_html = "";

			$blog_row_count = 0;
			?>
			<div class="col-lg-12 hidden-xs hidden-sm hidden-md">
				<div class="col-lg-1">
		        	<h3>Name:</h3>
		        </div>
		        <div class="col-lg-1">
		        	<h3>Phone:</h3>
		        	
		        </div>
		        <div class="col-lg-2">
		        	<h3>Email:</h3>
		        	
		        </div>
		        
		        <div class="col-lg-3">
		        	<h3>Address:</h3>
		        	
		        </div>
		        <div class="col-lg-3">
		        	<h3>Message:</h3>
		        	
		        </div>
		        <div class="col-lg-1">
		        	<h3>Status:</h3>
		        	
		        </div>
		        <div class="clearfix"></div>
	        </div>

		<?php
			while($row=mysqli_fetch_array($result)){
				$img_loc = null;
				$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				$result2 = mysqli_query($link,$query2);

				while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

				
					 ?> 
				    <div class='col-lg-12 well'>
				        <div class="col-lg-1 col-xs-6">
				        	<!-- -->
				        		<b><?php echo $row["id"]; ?></b> - <?php echo $row["name"]; ?>
				        		<br>
				        		<br class="hidden-lg">
				        </div>
				        <div class="col-lg-1 col-xs-6">
				        	<?php echo $row["phone"]; ?>
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        <div class="col-lg-2">
				        	<?php echo $row["email"]; ?>
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        
				        <div class="col-lg-3">
				        	<?php echo $row["address"]; ?>
				        	<!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        <div class="col-lg-3">
				        	<b>From:</b> <?php echo $row["form"]; ?><br>
				        	<b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?></b> - <?php echo $row["message"]; ?>
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        <div class="col-lg-2">
				        	
				        	<b>Updated: </b><?php echo date("m/d/y g:ia", strtotime($row["modified"])); ?>
				        	<form method="post">
				        		<textarea name="notes" placeholder="Enter Notes .."><?php echo $row["notes"]; ?></textarea><br>
					        	<select name="status">
					        		<option value="pending" <?php if($row['status']=="pending"){ echo ' selected'; } ?>>Pending</option>
					        		<option value="contacted" <?php if($row['status']=="contacted"){ echo ' selected'; } ?>>Contacted</option>
					        		<option value="followup" <?php if($row['status']=="followup"){ echo ' selected'; } ?>>Follow Up</option>
					        		<option value="won" <?php if($row['status']=="won"){ echo ' selected'; } ?>>Won</option>
					        		<option value="notinterested" <?php if($row['status']=="notinterested"){ echo ' selected'; } ?>>Not Interested</option>
					        		<option value="progress" <?php if($row['status']=="progress"){ echo ' selected'; } ?>>In Progess</option>
					        		<option value="complete" <?php if($row['status']=="complete"){ echo ' selected'; } ?>>Completed!</option>
					        	</select>
					        	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					        	<input type="submit" name="Update" value="Update">
				        	</form>
				        </div>

				        <div class="clearfix"></div>
				        
				        <div class="col-lg-1 hidden1">
				        	<!--
				        	<?php echo "<p>Created: <b><br>" . date("m-d-Y", strtotime($row["created"])) . "</b><br />Modified: <b><br>" . date("m-d-Y", strtotime($row["modified"])) . "</b></p><br />"; ?>
				        -->
				        	<!--<a href="<?php echo $site_base . "admin/edit.php?id=" . $row["id"]; ?>" class="btn btn-default btn-block">Edit</a>-->
				        	

				        	<a href="<?php echo $site_base . "admin/delete_any.php?type=leads&id=" . $row["id"]; ?>" class="btn btn-danger btn-block">Delete</a>

				        </div>
				        <div class="clearfix"></div>
				        
				       
				        <?php
				            if (!empty($row["youtube_url"]))
    						{
        						echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
    						}
						?>

						<div class="clearfix"></div>	    
						<!--
				        
				        <?php echo "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit.php?id=" . $row["id"] . "\" class=\"btn btn-default\">Edit</a></li>"; ?>
				        <?php echo "<li><a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>
				       
				       
				        <li class='pull-right'><a target='_blank' href='<?php echo $site_base . "blog/?id=" . $row["id"]; ?>' class='btn btn-success '>View Post >></a></li>

        				</ul>
        				-->				    
				    </div>
				    
				    <?php

					if ($blog_row_count % 10 === 0 && $blog_row_count !== 0)
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
					$blog_html.= "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";
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

					if ($blog_row_count % 10 === 0) { echo "<div class='clearfix'></div>"; }

			
			}

			

			mysqli_close($link);
		?>

		<div class="clearfix"></div>
		<div class="col-sm-12">
			<ul class="pagination">
				<?php 
					$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error());

					mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error());
					
					$query = "SELECT * FROM leads WHERE deleted = 1 ORDER BY id DESC";

					if($_GET["page"])
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
						$pcount = (int)ceil($num_rows/8);
						
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