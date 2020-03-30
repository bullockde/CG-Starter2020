<section id="main-content">
      <section class="wrapper">
		<div class="container-fluid">

		<br>


		<div class="col-md-offset-4">
			



		</div>

		<div class="col-md-6  ">


			<div class="card">
				<div class="card-body">
				<form method="post" action="" enctype='multipart/form-data'>
					<div class="col-md-12">

						<div class="form-group">

							<label>Create a New Video Board:</label>
							<input type="text" class="form-control" name="title" placeholder="Board Title"  />

							<?php
								$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

								mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ");
							
								$query = "SELECT * FROM boards ORDER BY id DESC";

				
								$result = mysqli_query($link,$query);
								$num_rows = mysqli_num_rows($result);

								$last

								?>
							<br>

					
							<div class="row">
								
								<div class="col-md-4">
									<label>Edit an Exisiting Board:</label><br>
									<select name="id">
										<option name="id" value="0" selected="">Select a Board</option>
										<?php
											while($row=mysqli_fetch_array($result)){

												?>
												<option name="id" value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
												<?php

											}
										?>
									</select>
								</div>
								<div class="col-md-6">
									
									<label>Transition:</label><br>

									<input type="radio" value="Fade" name="theme" checked="checked"> Fade | 
									<input type="radio" value="Slide" name="theme"> Slide<br>
									
								</div>
								<div class="col-md-2">
									<input type='submit' value='Submit' name='board_upload' class='btn btn-primary pull-right' >
								</div>
							</div>
							

							

							


						</div>
				
						
					</div>

					<div class="clearfix"></div>
			      	
			    </form>
				</div>
			</div>

			


		<?php


			

			if( $_POST['id'] ){

				$id = $_POST['id'];
				$query = "SELECT * FROM boards WHERE id = '$id'";

	        }else if( $last_id != 0 ){

				$query = "SELECT * FROM boards WHERE id = '$last_id'";

			}else{
				$query = "SELECT * FROM boards ORDER BY id DESC LIMIT 1";
			}

			if ( isset($_POST['id']) ) {
				$result = mysqli_query( $link,$query);
			}


			$last_id = $link->insert_id;

	        //echo "Last ID: " . $last_id;
			

			$num_rows = mysqli_num_rows($result);

			$blog_html = "";

			$blog_row_count = 0;


			while($row=mysqli_fetch_array($result)){

				//echo "<br>THIS ID=" . $row["id"];

				//echo "<br>LAST ID=" . $last_id;

				$img_loc = null;
				$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				$result2 = mysqli_query( $link,$query2);

				while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }


						if ( $last_id > 0 ) {
							$slide_query = "SELECT * FROM videos WHERE board_id = '".$last_id."' ORDER BY priority ASC";
						}else{
							$slide_query = "SELECT * FROM videos WHERE board_id = '".$row["id"]."' ORDER BY priority ASC";
						}

						
						$slides = mysqli_query( $link,$slide_query);
						$slide_num = mysqli_num_rows($slides);
						
						$last_id = $row["id"];

					 ?> 
				    <div class='col-md-12 well slide'>
				        
				        <h3 class="text-center"><?php echo $row["title"]; ?></h3>


				        <div class="row bolder">
				        	<div class="col-md-6 text-left">
				        		<b><?php echo "<u>" . $slide_num . "</u> SLIDES"; ?></b>
				        	</div>
				        	<div class="col-md-6 text-right">
				        		<b><?php echo "(" . $row["transition"] . ")"; ?></b>
				        	</div>
				        </div>
				       
					

				       <hr>


						<?php 

							$count = 1;
							while($row3=mysqli_fetch_array($slides)){ 

								if ( $count > 1 ) {
									echo  "<br><br>";
								}

								 echo $count++ . ". " . $row3["heading"] . " - (".$row3["title"].")";

							}

						?>

						<div class="clearfix"></div><hr><br>
				        <?php echo "<div class='buttons'><ul class=\"list-inline buttons d-flex align-items-baseline\"><li><a href='" . $site_base . "admin/videos.php?board_id=" . $row["id"] . "' class=\"btn btn-default\">Edit Slides</a></li>"; ?>

				        <?php echo "<li><a href=\"" . $site_base . "admin/delete_any.php?type=boards&id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>
				       
				       
				        <li class='pull-right'><a target='_blank' href='<?php 

				        	if( $row["theme"] == "Centered" ){

				        		echo $site_base . "admin/vid/master.php?board_id=" . $row["id"];

				        		}else{

				        		echo $site_base . "admin/vid/master.php?board_id=" . $row["id"]; 

				        	}
				        	

				        ?>' class='btn btn-success '>Preview >></a></li>

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


	    </div>


	

	    <div class=" col-md-6 row1 is-table-row1 hidden1 ">

	    	<div class="col-md-12 well">

						<form method="post" enctype='multipart/form-data'>
							<div class="col-md-12">
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

										<?php if ( $last_id > 0 ){ ?>
											<input type='text' name='board_id' placeholder='Board ID' value='<?php echo $last_id; ?>' />
										<?php }else{
											?>
											<input type='text' name='board_id' placeholder='Board ID' value='<?php echo $_POST['board_id']; ?>' />
											<?php
										} ?>

										<input type='hidden' name='id' placeholder='Board ID' value='<?php echo $_POST['board_id']; ?>' />
										
									</div>
							    </div>
							    <br>

							</div>
							<div class="col-md-12 text-center hidden-xs  well ">

								<div class="col-md-4">
									<label>Video Overlay?</label><br>
									Yes <input type="radio" value="1" name="overlay" checked="checked"> 
									No <input type="radio" value="0" name="overlay"><br><br>
								</div>
								<div class="col-md-4">
									<label>Button?</label><br>
									Yes <input type="radio" onclick="javascript:yesnoCheck('ifButton');" name="ifButton" id="yesCheck"> 
									No <input type="radio" onclick="javascript:yesnoCheck('ifButton');" name="ifButton" id="noCheck"><br>
								    <div id="ifButton" style="display:none">
								        <input type='text' name='button_text' placeholder="Button Text" />
										<input type='text' name='button_link' placeholder="http://" />
								    </div><br>
								</div>
								<div class="col-md-4">
									<label>Weather Widget?</label><br>
								Yes <input type="radio" value="1" name="widget" checked="checked"> 
								No <input type="radio" value="0" name="widget"><br>
								</div>
								<div class="clearfix"></div>

								
								
							    
							    


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
								<input type='submit' value='Upload' name='but_upload' class='pull-right btn btn-primary' >


					    </form>
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

					$blog_html.= "<ul class='list-inline buttons'><li><a href=\"" . $site_base . "admin/videos.php?board_id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";

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



		<div class="clearfix"></div><br><br>







			    <div class="row is-table-row ">

		<?php


			// page check
			$pguery = "SELECT * FROM videos ORDER BY priority ASC";
			$pgr = mysqli_query($link,$pguery);
			$pgnr = mysqli_num_rows($pgr);
			$pcount = (int)ceil($pgnr/9);

			if($_GET["page"])
			{	
				if($_GET["page"] > $pcount)
				{
					$query = "SELECT * FROM videos ORDER BY priority ASC LIMIT 0 , 9";
				}else{
					$plim = (intval($_GET["page"])-1) * 9;
					$query = "SELECT * FROM videos ORDER BY priority ASC LIMIT ".$plim." , 9";
				}
			}else{
				if( isset( $_GET["board_id"] ) ){

					$query = "SELECT * FROM videos WHERE board_id = '" .$_GET['board_id']. "' ORDER BY priority ASC LIMIT 0 , 9";
				}else{
					$query = "SELECT * FROM videos WHERE board_id = $last_id ORDER BY priority ASC LIMIT 0 , 9";
				}
			}

			if ( isset($_POST['id']) ) {
				$result = mysqli_query($link,$query);
			}

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

					if ($blog_row_count % 3 === 0) { echo "</div><div class='row is-table-row'>"; }

			
			}

			

			//mysql_close();
			
		?>

		</div>





	</div>
	</section>
</section>