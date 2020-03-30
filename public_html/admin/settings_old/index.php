<?php
$relative = "../";

include $relative . "../src/crutchphp/config.php";

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

	<?php 

//echo "<br>Start Page!";



		$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

		
       


	if( isset( $_POST['update_settings'] ) ){

		//echo "UPDATED SETTINGS!";
		?>
			<div class="alert alert-success text-center"> UPDATED SETTINGS! </div>
		<?php

		foreach( $_POST as $key => $value ){

			echo $key . ' = ' . $value;

			echo "<br><br>";
			//"UPDATE `settings` SET $key = $value";*/

			$update_row = mysqli_query( $link, "SELECT `ID` FROM `settings` WHERE settings_key = '$key'" )or die(  mysqli_error($link) );


			$updateID =mysqli_fetch_array($update_row);
			if( $key == "color_text" ){
				$key = $_POST["color_text"];
			}else{
				$key = $value;
			}

			mysqli_query( $link, "UPDATE `settings` SET `settings_value` = '$value' WHERE `settings_key` = '$key'" )or die(  mysqli_error($link) );

			//print_r( $updateID['ID'] );

			//mysqli_query( $link, "SELECT `settings.settings_key` FROM `settings` SET settings_value = $value WHERE settings_key = $key" )or die(  mysqli_error($link) );
			//mysqli_query( $link, "UPDATE `settings`  WHERE `$key` LIKE `settings`.`settings_key`" )or die(  mysqli_error($link) );

		}

	}
		
/*
		$settings_key   = ;	
		$admin_base		=;
		$admin_version	=;
		$font_color		=	;
		$image_folder	=;
		$local_path		=;
		$primary_color	=;
		$secondary_color=	;
		$site_base		=;
		$site_name		=;
		$site_root		=	;
*/

		if(isset($_POST['new_user'])){

          	$name = $_POST['access_login'];
          	$pass = $_POST['access_password'];
     
             $query = "INSERT INTO users(name,pass) VALUES('".$name."',PASSWORD('".$pass."'))";
             $tres = mysqli_query( $link, $query);

	     }






		$tquery = "SELECT * FROM blog_images WHERE  name='logo'";

		$tres = mysqli_query( $link, $tquery);

		$tnr = mysqli_num_rows($tres);

		$row  = mysqli_fetch_array($tres);

		$logo_url = $row['location'];

	?>

<?php 
	$page_title = "Admin Settings";
	include $relative . "head.php"; 
?>
<style type="text/css">
	.well p {
	    font-weight: bold;
	}
	.alert {
	    padding: 15px;
	    margin-bottom: 0;
	    border: 1px solid transparent;
	    border-radius: 4px;
	}
</style>
<body>
	
	<?php include $relative . 'header.php'; ?>
	
	<div class="container-fluid">

		


		<div class="clearfix"></div> <br>

		<div class="col-md-12">


			<h1 class="text-center"><?php echo $page_title; ?></h1><br>

			<div class="well">
				<form method="POST">
					


					<div class="col-md-6 text-center pull-left well ">
						<b>Logo:</b><br /><br />
						<a href="<?php echo $admin_base; ?>settings/logo.php">
						<?php
							$tquery = "SELECT * FROM blog_images WHERE name='logo'";
							$tres = mysqli_query( $link, $tquery);
							$img_urls = array();
							$img_ids = array();

							while($row2=mysqli_fetch_array($tres)){
								$img_urls[] = $row2["location"];
								$img_ids[] = $row2["id"];
							}

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
						<br>edit

						</a>
					</div>
					
					
					
			<!--
					<p>Site Name:</p>
	                <input type="text" name="admin_name" class="form-control" value="<?php echo $admin_name; ?>">
	                <br>
					<p>Site Base:</p>
	                <input type="text" name="site_base" class="form-control" value="<?php echo $site_base; ?>">
	                <br>
	                <p>Admin Base:</p>
	                <input type="text" name="admin_base" class="form-control" value="<?php echo $admin_base; ?>">
	                <br>
	                <p>Site Root:</p>
	                <input type="text" name="root" class="form-control" value="<?php echo $root; ?>">
	                <br>
	                <p>Local Path:</p>
	                <input type="text" name="localpath" class="form-control" value="<?php echo $localpath; ?>">
	                <br>
	                <p>Image Folder Path:</p>
	                <input type="text" name="images" class="form-control" value="<?php echo $images; ?>">
	                <br>
	                <p>Admin Version:</p>
	                <input type="text" name="admin_ver" class="form-control" value="<?php echo $admin_ver; ?>">
	                <br>

	            -->


	                <?php  

		                $settings_query = "SELECT * FROM settings";

						$settings = mysqli_query($link,$settings_query);


						while($settings_row=mysqli_fetch_array($settings)){

							?>
							
							<?php
							if( strpos( $settings_row['settings_key'] , 'color' )  ){

								?>
									<p style="margin-left: 1em;" class="pull-left"><?php echo $settings_row['settings_key']; ?>:  &nbsp;<input type="text" class="pull-right" name="color_text" value="<?php echo $settings_row['settings_value']; ?>"> </p>
									<input style="height:50px;width:45%;margin-bottom: 30px; margin-left: 1em;" type="color" name="<?php echo $settings_row['settings_key']; ?>" value="<?php echo $settings_row['settings_value']; ?>">
									
								<?php
							}else{
								?>
								<p><?php echo $settings_row['settings_key']; ?>: </p>
				                <input type="text" name="<?php echo $settings_row['settings_key']; ?>" class="form-control" value="<?php echo $settings_row['settings_value']; ?>">
				                <br>
								<?php
							}
						

							//echo $settings_row['settings_key'] . " = " . $settings_row['settings_value'];
							//echo "<br>";
						}

					?>

					<input type="submit" name="update_settings" value="Update Settings" class="btn btn-primary form-control" />

				</form>



			</div>

				<br><br>
				<h3 class="text-center"><u>Manage Users</u></h3><br>

				<form method="post" role="form" class="well col-md-4 col-md-offset-4">
						<h4 class="text-center"><u>New User</u></h4><br>

				        <div class="form-group">
				        	<label>Username:</label>
				          <input type="text" class="form-control" name="access_login" placeholder="Enter a Username"/>
				        </div>
				        <div class="form-group">
				        	<label>Password:</label>
				          <input type="password" name="access_password" class="form-control" placeholder="Enter a Password"/>
				        </div>
				        <div class="form-group">
				           <input type="submit" name="new_user" value="Add User" class="btn btn-primary form-control" />
				        </div>
				        <div class="form-group">
				        	<h3><?php echo $emsg; ?></h3>
				        </div>
				    </form>

				    <div class="clearfix"></div>
					<br>

				    <h4 class="text-center">CURRENT USERS</h4>
				    <hr>
				 <div class="clearfix ">
	   
					<?php

						// page check
						$pguery = "SELECT * FROM users ORDER BY modified ASC";
						$pgr = mysqli_query($link,$pguery);
						$pgnr = mysqli_num_rows($pgr);
						$pcount = (int)ceil($pgnr/9);

						if($_GET["page"])
						{	
							if($_GET["page"] > $pcount)
							{
								$query = "SELECT * FROM users ORDER BY modified ASC LIMIT 0 , 9";
							}else{
								$plim = (intval($_GET["page"])-1) * 9;
								$query = "SELECT * FROM users ORDER BY modified ASC LIMIT ".$plim." , 9";
							}
						}else{
							if( isset( $_GET["board_id"] ) ){

								$query = "SELECT * FROM users WHERE board_id = '" .$_GET['board_id']. "' ORDER BY modified ASC LIMIT 0 , 9";
							}else{
								$query = "SELECT * FROM users ORDER BY modified ASC LIMIT 0 , 9";
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
							    <div class='col-md-3 well slide'>
							        

							        <?php echo ++$count . ". "; echo $row["name"]; ?><br><br>
							        
							       
									<div class="clearfix"></div><br>	

			    

			    			        <?php echo "<p>Created: <b>" . date("m-d-Y", strtotime($row["created"])) . "</b><br />Modified: <b>" . date("m-d-Y", strtotime($row["modified"])) . "</b></p><br />"; ?>
						
							        <div class="clearfix"></div><br>
							        <?php echo "<div class='buttons'><ul class=\"list-inline buttons d-flex align-items-baseline\"><li><a href=\"" . $site_base . "admin/edit_users.php?id=" . $row["id"] . "\" class=\"btn btn-default\">Edit</a></li>"; ?>
							        <?php echo "<li><a href=\"" . $site_base . "admin/delete_any.php?type=users&id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>

							        
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
			                    
								$blog_html.= "<h1>" . $row["title"] . "</h1><p>Created: <b>" . $row["created"] . "</b><br />Modified: <b>" . $row["modified"] . "</b></p><br />";
								$blog_html.= "<ul class=\"list-inline buttons\"><li><a href=\"" . $site_base . "admin/edit_vid.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";
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

								if ($blog_row_count % 3 === 0) { echo "</div><div class='row'>"; }

						
						}

						

						
					?>

					</div>


					

					




			

			<br>
			<a class="btn btn-primary btn-lg hidden" href="<?php echo $admin_base; ?>settings/users.php">Manage Users &raquo;</a>
			<br><br>
			<a class="btn btn-primary btn-lg hidden" href="<?php echo $admin_base; ?>settings/show_table.php">Database Tools &raquo;</a>
			<br><br>
			<a class="btn btn-primary btn-lg hidden" href="<?php echo $admin_base; ?>settings/resumes.php">Resume Submissions &raquo;</a>


	


		</div>






	    <div class="clearfix"></div>


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