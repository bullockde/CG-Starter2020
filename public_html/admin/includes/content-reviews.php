
<section id="main-content">



          <section class="wrapper">

<div class="container-fluid">

		<h2>
			Reviews
			<!--<a href="<?php echo $site_base; ?>admin/archives.php" class="pull-right btn btn-default" >Go to Archives >></a>-->
		</h2><br>

		<?php 

			if( isset($_GET['edit']) ){

				$id = $_GET['id'];
				$pguery = "SELECT * FROM reviews WHERE id = $id";

			}else{
				// page check
				$pguery = "SELECT * FROM reviews ORDER BY id DESC";
			}
			
			$pgr = mysqli_query($link,$pguery);
			$pgnr = mysqli_num_rows($pgr);
			$pcount = (int)ceil($pgnr/10);
			
			if( isset($_GET["page"]) )
			{	
				if($_GET["page"] > $pcount)
				{
					$query = "SELECT * FROM reviews ORDER BY id DESC";
				}else{
					$plim = (intval($_GET["page"])-1) * 10;
					$query = "SELECT * FROM reviews ORDER BY id DESC";
				}
			}else{
				if( isset($_GET['edit']) ){

					$id = $_GET['id'];
					$query = "SELECT * FROM reviews WHERE id = $id";

				}else{
					// page check
					$query = "SELECT * FROM reviews ORDER BY id DESC ";
				}

			}
			
			$result = mysqli_query($link,$query);
			$num_rows = mysqli_num_rows($result);

			$blog_html = "";

			$blog_row_count = 0;
			?>
			<div class="col-lg-12 hidden-xs hidden-sm hidden-md">
				<div class="row">
					<div class="col-lg-2">
			        	<b>Name:</b>
			        </div>
			        <div class="col-lg-2">
			        	<b>Location:</b>
			        	
			        </div>
			        <div class="col-lg-6">
			        	<b>Message:</b>
			        	
			        </div>
			        <div class="col-lg-2">
			        	<!--<h3>Status:</h3>-->
			        	
			        </div>

				</div>
				
		        <div class="clearfix"></div>
	        </div>



	    <div class="clearfix"></div>

	    <?php 
	    	if( isset($_GET['edit']) ){

	    		$row=mysqli_fetch_array($result);

	    		?>
	    		<form method="post" enctype='multipart/form-data'>
					    <div class='col-lg-12 well card'>
					    	<div class="card-body row">
					        <div class="col-lg-2 col-xs-6">
					        	<!-- -->
					        	<input type="text" name="name" value="<?php echo $row['name']; ?>" style="width: 100%;" />
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					     
					        <div class="col-lg-2">
					        	<input type='text' name='location' value="<?php echo $row['location']; ?>" style="width: 100%;" />
					        	
					        	<!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-6">
					        	<textarea name='message' style="width: 100%;"><?php echo $row['message']; ?></textarea>

					        	<input type='hidden' name='id' value="<?php echo $row['id']; ?>" />


					        	<!--<b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?></b> - <?php echo $row["message"]; ?>-->
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-2">

					        	<input type='submit' value='Update Review' name='update_review' class='btn btn-block btn-default' >
					        
					        </div>

					        <div class="clearfix"></div>
					        <div class="col-lg-2 col-xs-6">
					        	<!-- -->
					        	<input type="text" name="email" value="<?php echo $row['email']; ?>" placeholder="Email" style="width: 100%;" />
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					     
					        <div class="col-lg-2">
					        	<input type='text' name='phone' value="<?php echo $row['phone']; ?>" placeholder="Phone" style="width: 100%;" />
					        	
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					       

					        <?php
					            if (!empty($row["youtube_url"]))
								{
									echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
								}
							?>

							<div class="clearfix"></div>	    
						    </div>
					    </div>
				</form>

	    		<?php
	    	}else{

	    		?>
	    		<form method="post" enctype='multipart/form-data'>
	    			<div class='col-lg-12 card'>
					    <div class='row  card-body'>
					        <div class="col-lg-2 col-xs-6">
					        	<!-- -->
					        	<input type='text' name='name' placeholder="Name" style="width: 100%;" />
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					     
					        <div class="col-lg-2">
					        	<input type='text' name='location' placeholder="Location" style="width: 100%;" />
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-5">
					        	<textarea name='message' placeholder="Message" style="width: 100%;"></textarea>
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-3">

					        	<input type='submit' value='Add Review' name='new_review' class='btn btn-block btn-success' >
					        
					        </div>

					        <div class="clearfix"></div>
					        
					       

					        <?php
					            if (!empty($row["youtube_url"]))
								{
									echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
								}
							?>

							<div class="clearfix"></div>
					        <div class="col-lg-2 col-xs-6">
					        	<!-- -->
					        	<input type="text" name="email" value="<?php echo $row['email']; ?>" placeholder="Email" style="width: 100%;" />
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					     
					        <div class="col-lg-2">
					        	<input type='text' name='phone' value="<?php echo $row['phone']; ?>" placeholder="Phone" style="width: 100%;" />
					        	
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					           
						    
					    </div>
					</div>
				</form>
	    		<?php
	    	}
	    ?>

		<div class="clearfix"></div>

		<?php
			while($row=mysqli_fetch_array($result)){
				$img_loc = null;
				$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				$result2 = mysqli_query($link,$query2);

				while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

				
					 ?> 
				    <div class='col-lg-12 well card'>
				    	<div class=' card-body row'>
				        <div class="col-lg-2 col-xs-6">
				        	<!-- -->
				        		<b><?php echo $row["id"]; ?></b> - <?php echo $row["name"]; ?>
				        		<br>
				        		<br class="hidden-lg">
				        </div>
				    
				        <div class="col-lg-2">
				        	<?php echo $row["location"]; ?>
				        	<!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        <div class="col-lg-5">
				        	
				        	<?php echo $row["message"]; ?>
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        <div class="col-lg-3">
				        	
				        	<b>Created: </b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?>
				        	
				        	<div class="clearfix"></div><br>

				        	<?php
				        	echo "<a href=\"" . $admin_base . "delete_any.php?type=reviews&id=" . $row["id"] . "\" class=\" pull-right btn btn-danger\">Delete</a>";

				        	echo "<a href=\"" . $admin_base . "reviews.php?edit=true&id=" . $row["id"] . "\" class=\" pull-right btn btn-default\">Edit</a>";
							
							?>

				        </div>

				        <div class="clearfix"></div><hr>

				        <div class="col-lg-2">
				        	<?php echo $row["email"]; ?>

				        	<br>
				        	<a href="#" class="btn hidden"> Email Review</a>
				        	
				        	<br>
				        	<br class="hidden-lg">
				        </div>

				        <div class="col-lg-2 col-xs-6">
				        	<!-- -->
				        		<?php echo $row["phone"]; ?>
				        		
				        		<br>
				        		<br class="hidden-lg">
				        </div>
				        <div class="col-lg-2 col-xs-6 d-none">
				        	
				        		<?php 
				        			if( $row["email"] != ""){
				        				?>
				        					<a href="/inc/sendmail-review.php?name=<?php echo $row['name']; ?>&email=<?php echo $row['email']; ?>" class="btn btn-default btn-block hidden"> Regular Email &raquo; </a>
				        					
				        				<?php
				        			}
				        		?>
				        		<?php 
				        			if( $row["email"] != ""){
				        				?>
				        					<a href="/inc/fancymail.php?type=regular&name=<?php echo $row['name']; ?>&email=<?php echo $row['email']; ?>" class="btn btn-default btn-block hidden"> Fancy Regular Email &raquo; </a>
				        					
				        				<?php
				        			}
				        		?>
				        		<?php 
				        			if( $row["phone"] != ""){
				        				?>
				        					<a href="/send-reviews.php?type=regular&p=<?php echo $row["phone"]; ?>" class="btn btn-default btn-block hidden"> Regular Text &raquo; </a>
				        					
				        				<?php
				        			}
				        		?>
				        
				        </div>
				        <div class="col-lg-2 col-xs-6 d-none">

				        		<?php 
				        			if( $row["email"] != ""){
				        				?>
				        					<a href="/inc/sendmail-dispatch-review.php?name=<?php echo $row['name']; ?>&email=<?php echo $row['email']; ?>" class="btn btn-primary btn-block hidden"> Dispatch Email &raquo; </a>
				        					
				        				<?php
				        			}
				        		?>
				        		<?php 
				        			if( $row["email"] != ""){
				        				?>
				        					<a href="/inc/fancymail.php?type=dispatch&name=<?php echo $row['name']; ?>&email=<?php echo $row['email']; ?>" class="btn btn-primary btn-block hidden"> Fancy Dispatch Email &raquo; </a>
				        					
				        				<?php
				        			}
				        		?>
				        	
				        		<?php 
				        			if( $row["phone"] != ""){
				        				?>
				        					<a href="/send-reviews.php?type=dispatch&p=<?php echo $row["phone"]; ?>" class="btn btn-primary btn-block hidden"> Dispatch Text &raquo; </a>
				        				<?php
				        			}
				        		?>
				        
				        </div>
				    
				        

				        
				        <?php
				            if (!empty($row["youtube_url"]))
    						{
        						echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
    						}
						?>

						<div class="clearfix"></div>	    
							    
				    </div>
				    </div>
				    
				    <?php

				
					$blog_row_count++;

					if ($blog_row_count % 10 === 0) { echo "<div class='clearfix'></div>"; }

			
			}

			

			mysqli_close($link);
		?>

		<div class="clearfix"></div>
		<div class="col-sm-12">
			<ul class="pagination hidden">
				<?php 
					$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error());

					//mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error());
					
					$query = "SELECT * FROM reviews ORDER BY id DESC";

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
						//$pcount = (int)ceil($num_rows/10);
						
						if($pg > $pcount){ $pg = 1; }
						$pg = 1; 

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
			<br><br><br>
		</div>
	</div>
</section>
</section>