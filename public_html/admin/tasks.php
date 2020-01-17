<?php
	include "../src/crutchphp/config.php";
	if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }

	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());



		$tasks = "CREATE TABLE IF NOT EXISTS `tasks` (
		 `id` int(11) NOT NULL AUTO_INCREMENT,
		 `title` text COLLATE utf8_unicode_ci,
		 `description` text COLLATE utf8_unicode_ci,
		 `hours` text COLLATE utf8_unicode_ci,
		 `budget` text COLLATE utf8_unicode_ci,
		 `ticket_id` int(11) DEFAULT NULL,
		 `start_time` text COLLATE utf8_unicode_ci,
		 `end_time` text COLLATE utf8_unicode_ci,
		 `start_date` text COLLATE utf8_unicode_ci,
		 `target_date` text COLLATE utf8_unicode_ci,
		 `due_date` text COLLATE utf8_unicode_ci,
		 `end_date` text COLLATE utf8_unicode_ci,
		 `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		 `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		 `status` text COLLATE utf8_unicode_ci,
		 `notes` text COLLATE utf8_unicode_ci,
		 PRIMARY KEY (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

 		mysqli_query($link,$tasks);

	$page_title = "Tasks";
	$page_slug = "tasks";


	if( isset( $_POST['new_task'] ) ){
/*
		$title = $_POST['title'];
      	$hours = $_POST['hours'];
      	$budget = $_POST['budget'];
      	$description = $_POST['description'];
*/

		$query = "
			INSERT INTO $page_slug(
				title,
				hours,
				budget,
				description,
				start_date,
				start_time,
				end_time,
				ticket_id
			) 
			VALUES(
				'".$_POST["title"]."',
				'".$_POST["hours"]."' ,
				'".$_POST["budget"]."',
				'".nl2br($_POST["description"])."',
				'".$_POST["start_date"]."',
				'".$_POST["start_time"]."',
				'".$_POST["end_time"]."',
				'".$_POST["ticket_id"]."'
			)";

	    mysqli_query($link,$query);

	}

	if( isset( $_POST['update_task'] ) ){

		$id = $_POST['id'];
		/*
		$title = $_POST['title'];
      	$hours = $_POST['hours'];
      	$budget = $_POST['budget'];
      	$description = $_POST['description'];
		*/

		//$query = "INSERT INTO coupons(name,location,message) VALUES('".$name."','".$location."' ,'".$message."')";
		$query = "UPDATE $page_slug SET 

		title = '".$_POST['title']."', 
		hours = '".$_POST['hours']."',
		budget = '".$_POST['budget']."',
		description = '".$_POST["description"]."',
		start_date = '".$_POST['start_date']."',
		start_time = '".$_POST['start_time']."',
		end_time = '".$_POST['end_time']."',
		ticket_id = '".$_POST['ticket_id']."'

			WHERE id = '$id'";

	    mysqli_query($link,$query);

	    header('Location:' . $site_base . 'admin/' . $page_slug . '.php');

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
	
	include "head.php"; 
?>

<body>
	
	<?php include 'header.php'; ?>

	<div class="container-fluid">

		<h1>
			<?php echo $page_title; ?>

			<a href="<?php echo $site_base; ?>admin/project.php" class="pull-right btn btn-default" >Project Log >></a><br>

			<a href="<?php echo $site_base; ?>admin/plans.php" class="pull-right btn btn-default" >Project Planner >></a>
		</h1>

		<?php 

			


			if( isset($_GET['edit']) ){

				$id = $_GET['id'];
				$pguery = "SELECT * FROM $page_slug WHERE id = $id";

			}else{
				// page check



				$pguery = "SELECT * FROM $page_slug ORDER BY id DESC";
			}
			
			$pgr = mysqli_query($link,$pguery);
			$pgnr = mysqli_num_rows($pgr);
			$pcount = (int)ceil($pgnr/8);
			
			if( isset($_GET["page"]) )
			{	
				if($_GET["page"] > $pcount)
				{
					$query = "SELECT * FROM $page_slug ORDER BY id ASC";
				}else{
					$plim = (intval($_GET["page"])-1) * 8;
					$query = "SELECT * FROM $page_slug ORDER BY id ASC";
				}
			}else{
				if( isset($_GET['edit']) ){

					$id = $_GET['id'];
					$query = "SELECT * FROM $page_slug WHERE id = $id";

				}else if( isset($_GET['filter']) ){

					$query = "SELECT * from $page_slug WHERE create_date between '2019-09-16' and '2019-09-20'";

             

					}else{
					// page check
					$query = "SELECT * FROM $page_slug ORDER BY id ASC ";
				}

			}
			
			$result = mysqli_query($link,$query);
			$num_rows = mysqli_num_rows($result);

			$blog_html = "";

			$blog_row_count = 0;
			?>
			<div class="col-lg-12 hidden-xs hidden-sm hidden-md">
				<div class="col-lg-1">
		        	<h3>Date:</h3>
		        </div>
				<div class="col-lg-2">
		        	<h3>Time:</h3>
		        </div>
		        <div class="col-lg-2">
		        	<h3>Title:</h3>
		        	
		        </div>
		        <div class="col-lg-4">
		        	<h3>Description:</h3>
		        	
		        </div>
		        <div class="col-lg-1">
		        	<h3>Details:</h3>
		        	
		        </div>
		        <div class="clearfix"></div>
	        </div>



	    <div class="clearfix"></div>

	    <?php 
	    	if( isset($_GET['edit']) ){

	    		$row=mysqli_fetch_array($result);

	    		?>
	    		<form method="post" enctype='multipart/form-data'>
					    <div class='col-lg-12 well'>
					    	<div class="col-lg-2 col-xs-6">
					        	<!-- -->
					        	<input type="text" name="start_date" value="<?php echo $row['start_date']; ?>" style="width: 100%;" />
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					        <div class="col-lg-2 col-xs-6">

					        	<div class="col-xs-5">
					        		<input type="text" name="start_time" value="<?php echo $row['start_time']; ?>" style="width: 100%;" />
					        	</div>
					        	<div class="col-xs-2">
					        		-
					        	</div>
					        	<div class="col-xs-5">
					        		<input type="text" name="end_time" value="<?php echo $row['end_time']; ?>" style="width: 100%;" />
					        	</div>

					        	

					        	

					        	<!-- -->
					        	
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					     
					        <div class="col-lg-2">
					        	<input type="text" name="title" value="<?php echo $row['title']; ?>" style="width: 100%;" />

					        	
					        	
					        	<!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-4">
					        	<textarea name='description' class="bcontent" style="width: 100%;"><?php echo $row['description']; ?></textarea>

					        	<input type='hidden' name='id' value="<?php echo $row['id']; ?>" />


					        	<!--<b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?></b> - <?php echo $row["details"]; ?>-->
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-1">
					        	<input type='text' name='ticket_id' value="<?php echo $row['ticket_id']; ?>" style="width: 100%;" />
					        	<input type='text' name='hours' value="<?php echo $row['hours']; ?>" style="width: 100%;" />
					        	<input type='text' name='budget' value="<?php echo $row['budget']; ?>" style="width: 100%;" />
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-2">

					        	<input type='submit' value='Update Task' name='update_task' class='btn btn-block btn-default' >
					        
					        </div>

					        <div class="clearfix"></div>
					        
					       

					        <?php
					            if (!empty($row["youtube_url"]))
								{
									echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
								}
							?>

							<div class="clearfix"></div>	

					    </div>
				</form>

	    		<?php
	    	}else{

	    		?>
	    		<form method="post" enctype='multipart/form-data'>
					    <div class='col-lg-12 well'>
					    	<div class="col-lg-1 col-xs-6">
					        	<!-- -->
					        	<input type="text" name="start_date" value="<?php echo date("m/d/y"); ?>" style="width: 100%;" />
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					        <div class="col-lg-2 col-xs-6">

					        	<div class="col-xs-5">
					        		<input type="text" name="start_time" value="<?php echo date("g:ia"); ?>" style="width: 100%;" />
					        	</div>
					        	<div class="col-xs-1">
					        		-
					        	</div>
					        	<div class="col-xs-5">
					        		<input type="text" name="end_time" value="<?php echo date("g:ia"); ?>" style="width: 100%;" />
					        	</div>


					        	

					        	
					        	<!-- -->
					        	
					        		
					        		<br>
					        		<br class="hidden-lg">
					        </div>
					     
					        <div class="col-lg-2">
					       
					        	<input type='text' name='title' placeholder="Daniels Plumbing" value="Daniels Plumbing" style="width: 100%;" />
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-4">
					        	<textarea name='description' class="form-control bcontent" placeholder="Description" style="width: 100%;"></textarea>
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-1">
					        	<input type='text' name='ticket_id' placeholder="Ticket #" style="width: 100%;" />
					        	<input type='text' name='hours' placeholder="Hours" style="width: 100%;" />
					        	<input type='text' name='budget' placeholder="Budget" style="width: 100%;" />
					        	<br>
					        	<br class="hidden-lg">
					        </div>
					        <div class="col-lg-2">

					        	<input type='submit' value='Add Task' name='new_task' class='btn btn-block btn-success' >
					        
					        </div>

					        <div class="clearfix"></div>
					        
					       

					        <?php
					            if (!empty($row["youtube_url"]))
								{
									echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
								}
							?>

							<div class="clearfix"></div>	    
						    
					    </div>
				</form>
	    		<?php
	    	}
	    ?>

		<div class="clearfix"></div>

		<?php

			$total_time = "00:00:00";

			$total_hours = 0;

			$total_mins = 0;

			while($row=mysqli_fetch_array($result)){
				$img_loc = null;
				$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				$result2 = mysqli_query($link,$query2);

				while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

				
					 ?> 
				    <div class='col-lg-12 well'>
				    	<div class="col-lg-1 col-xs-6" contenteditable="true">
				        	<!-- -->
				        		<b><?php echo $row["id"]; ?></b> - <?php echo date('m/d/y', strtotime($row['start_date'])); ?></b>
				        		<br>
				        		<br class="hidden-lg">
				        </div>
				        <div class="col-lg-2 col-xs-6" contenteditable="true">
				        	<!-- -->
				        		<p><?php echo $row["start_time"]; ?> - <?php echo $row["end_time"]; ?></p>

				        		-- 
				        		<?php

					        		$start = $row["start_date"] . " " . $row["start_time"];
					        		$end = $row["start_date"] . " " . $row["end_time"];
					        		//echo "<br>Started: " . $start;
					        		//echo "<br>End: " . $end;

					        		//echo "<hr>";

						        	// Declare and define two dates 
									$date1 = strtotime( $start );  
									$date2 = strtotime( $end );  
									  
									// Formulate the Difference between two dates 
									$diff = abs($date2 - $date1);  
									  
									  
									// To get the year divide the resultant date into 
									// total seconds in a year (365*60*60*24) 
									$years = floor($diff / (365*60*60*24));  
									  
									  
									// To get the month, subtract it with years and 
									// divide the resultant date into 
									// total seconds in a month (30*60*60*24) 
									$months = floor(($diff - $years * 365*60*60*24) 
									                               / (30*60*60*24));  
									  
									  
									// To get the day, subtract it with years and  
									// months and divide the resultant date into 
									// total seconds in a days (60*60*24) 
									$days = floor(($diff - $years * 365*60*60*24 -  
									             $months*30*60*60*24)/ (60*60*24)); 
									  
									  
									// To get the hour, subtract it with years,  
									// months & seconds and divide the resultant 
									// date into total seconds in a hours (60*60) 
									$hours = floor(($diff - $years * 365*60*60*24  
									       - $months*30*60*60*24 - $days*60*60*24) 
									                                   / (60*60));  
									  
									  
									// To get the minutes, subtract it with years, 
									// months, seconds and hours and divide the  
									// resultant date into total seconds i.e. 60 
									$minutes = floor(($diff - $years * 365*60*60*24  
									         - $months*30*60*60*24 - $days*60*60*24  
									                          - $hours*60*60)/ 60);  
									  
									  
									// To get the minutes, subtract it with years, 
									// months, seconds, hours and minutes  
									$seconds = floor(($diff - $years * 365*60*60*24  
									         - $months*30*60*60*24 - $days*60*60*24 
									                - $hours*60*60 - $minutes*60));  
									  
									// Print the result 
									/*printf("%d years, %d months, %d days, %d hours, "
									     . "%d minutes, %d seconds", $years, $months, 
									             $days, $hours, $minutes, $seconds); 
									*/
									 if( $years > 0 ) echo $years . " years<br>";
									 if( $months > 0 ) echo $months . " months<br>";
									 if( $days > 0 ) echo $days . " days<br>";
									 if( $hours > 0 ) echo $hours . " hours<br>";
									 if( $minutes > 0 ) echo $minutes . " minutes<br>";
									 //if( $seconds > 0 ) echo "<br>" . $seconds . " seconds";

									 $the_time = "" . sprintf("%02d", $hours) . ":" . sprintf("%02d", $minutes) . ":" . sprintf("%02d", $seconds) . "";



									// echo "<br>The Time: " . $the_time ;


									 $total_hours += $hours;

									 $total_mins += $minutes;

									 //echo "<br>Hours->" .$total_hours;
									 //echo "<br>Mins->" .$total_mins;
									
									 $time1 = $total_time;
										$time2 = $the_time;

										$secs = strtotime($time2)-strtotime("00:00:00");
										$total_time = date("H:i:s",strtotime($time1)+$secs);

									 //echo "<br>RESULT: " . $total_time;

									/*$time_total += strtotime($time_total) + strtotime($the_time);

									echo "<br>Total: " . date('H:i:s', $time_total);*/

									echo "<br><b>Total:</b><br>" . ($total_hours + floor($total_mins/60)) . " Hrs " . ($total_mins % 60) . " mins";


								?>

				        		
				        		<br>
				        		<br class="hidden-lg">
				        </div>
				    
				        <div class="col-lg-2">
				        	
				        	<b><?php echo $row["title"]; ?></b>
				        	<?php //echo $row["hours"]; ?>
				        	<!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        <div class="col-lg-4">
				        	
				        	<?php echo $row["description"]; ?>
				        	<br>
				        	<br class="hidden-lg">
				        </div>
				        <div class="col-lg-1">
				        	<p>Ticket #: <?php echo $row["ticket_id"]; ?></p>
				        	<p>Hours: <?php echo $row["hours"]; ?></p>
				        	<p>Budget: <?php echo $row["budget"]; ?></p>
				        </div>
				        <div class="col-lg-2">
				        	
				        	<!--<b>Created: </b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?><br>-->
				        	

				        	
				        	<?php
				        	echo "<a href=\"" . $site_base . "admin/delete_any.php?type=".$page_slug."&id=" . $row["id"] . "\" class=\" pull-right btn btn-danger\">Delete</a>";

				        	echo "<a href=\"" . $site_base . "admin/".$page_slug.".php?edit=true&id=" . $row["id"] . "\" class=\" pull-right btn btn-default\">Edit</a>";
							
							?>

				        </div>

				        <div class="clearfix"></div>
				        
				        <?php
				            if (!empty($row["youtube_url"]))
    						{
        						echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
    						}
						?>

						<div class="clearfix"></div>
			

							    
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

					$title = isset($row["title"]) ? $row["title"] : "";

					$modified = isset($row["modified"]) ? $row["modified"] : "";
                    
					$blog_html.= "<h1>" . $title . "</h1><p>Created: <b>" . $row["created"] . "</b><br />Modified: <b>" . $modified . "</b></p><br />";
					$blog_html.= "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";
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

					if ($blog_row_count % 10 === 0) { echo "<div class='clearfix'></div>"; }

			
			}

			

			mysqli_close($link);
		?>

		<div class="clearfix"></div>

		<div class="well clearfix">

			<h3>Summary</h3>
			<!--<br> Total Time: <?php echo $total_time; ?>-->

			<br>Total: <?php echo ($total_hours + ($total_mins/60)); ?>

			<br><?php echo ($total_hours + (floor($total_mins/60))); ?> Hours

			<!--<br>Total Mins: <?php echo floor($total_mins/60); ?>-->

			<br><?php echo ($total_mins % 60); ?> Mins

		</div>
<!--
		 $total_hours += $hours;

		$total_mins += $minutes;

		Total Time: 
		<?php echo date('H:i:s', $time_total); 
			$time_total= 0;
		?>
-->


		<div class="col-sm-12">
			<ul class="pagination hidden">
				<?php 
					$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error());

					mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error());
					
					$query = "SELECT * FROM $page_slug ORDER BY id DESC";

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