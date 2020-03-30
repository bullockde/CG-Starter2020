<?php
	include "../src/crutchphp/config.php";

	include "class.database.php";


	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());


	date_default_timezone_set('America/New_York'); 

	$add_plans = "CREATE TABLE IF NOT EXISTS `plans` (
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
		 `priority` text COLLATE utf8_unicode_ci,
		 `notes` text COLLATE utf8_unicode_ci,
		 `role` text COLLATE utf8_unicode_ci,
		 `phase` text COLLATE utf8_unicode_ci,
		 PRIMARY KEY (`id`)
	) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1";

	mysqli_query($link,$add_plans);


			$page_title = "Plans";
			$page_slug = "plans";

	if( $_GET['status'] == "Approved!" ){

		$id = $_GET['id'];

		$status = $_GET['status'];
		
		header('Location:' . $site_base . 'work/approved.php?type=plans&id='.$id);

		//exit();
		//$id = $_POST['id'];

		//$status_update = "UPDATE $page_slug SET status = '$status' WHERE id = '$id'";
		//mysqli_query($link,$status_update);
	}

	function are_you_sure(){

		$action = $_POST["action"];

		echo "Are You Sure you want to $action?";
		?>
		<form method="post">

			<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">

				        	<input type="hidden" name="role" value="<?php echo $_POST['role']; ?>">


				        	<input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
				   
				  
				        	<input type="hidden" name="description" value="<?php echo $_POST['description']; ?>">
				  
				        	<input type="hidden" name="hours" value="<?php echo $_POST['hours']; ?>">
				  
							

				        	<input type="hidden" name="ticbudgetket_id" value="<?php echo $_POST['budget']; ?>">
				        	
				        	<input type="hidden" name="ticket_id" value="<?php echo $_POST['ticket_id']; ?>">
				        	
			        		<input type="hidden" name="phase" value="<?php echo $_POST['phase']; ?>">

			        		<input type="hidden" name="status" value="<?php echo $_POST['status']; ?>">

				        	<input type="hidden" name="priority" value="<?php echo $_POST['priority']; ?>">


			<input type="hidden" name="email_task" value="1">
			<input type="submit" name="sure" value="Yes">
			<input type="submit" name="sure" value="No">
		</form>

		<?php
		


	}


	if ( $_POST['send_task'] ) {

		//Are you Sure?
				are_you_sure();
	
	}
	if ( $_POST['email_task']  && ( $_POST['sure'] == "Yes" ) ) {
			$task_id = $_POST["id"];

			$from_name = "New Project Task | Definis & Sons";
	    	$from_email = "info@definisandsonswindows.com";

	      $headers = "MIME-Version: 1.0" . "\r\n";
		  $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		  $headers .= "From:  " . $from_name . " <" . $from_email .">" . " \r\n" ;


		  $body = "<h1>You have a New Task - Pending Approval!</h1>"
		  		. "<h2>".$_POST["title"]."</h2>"
		  		. "<b>Summary:</b><br>"
		  		. nl2br($_POST["description"]) . "<br><br>"
		  		. "<h3>View this task at: https://www.definisandsonswindows.com/work/?type=plans&id=$task_id</h3>";

		 //info@daniels-plumbing.com
		  		
	    mail("darius@cgpcsolutions.com,jim@definis.com,	sandi@definis.com","New Website Task!",$body, $headers);
	
	}	


	if( isset( $_POST['status'] ) ){

		$status = $_POST['status'];
		

		$id = $_POST['id'];
		$status_update = "UPDATE $page_slug SET status = '$status' WHERE id = '$id'";
		mysqli_query($link,$status_update);
	}
	if( isset( $_POST['notes'] ) ){

		
		$notes = $_POST['notes'];

		$id = $_POST['id'];
		$status_update = "UPDATE $page_slug SET notes = '$notes' WHERE id = '$id'";
		mysqli_query($link,$status_update);
	}
	if( isset( $_GET['status'] ) ){

		$status = $_GET['status'];
		

		$id = $_GET['id'];
		$status_update = "UPDATE $page_slug SET status = '$status' WHERE id = '$id'";
		mysqli_query($link,$status_update);
	}

	

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
				role,
				phase,
				status,
				ticket_id,
				priority
			) 
			VALUES(
				'".$_POST["title"]."',
				'".$_POST["hours"]."' ,
				'".$_POST["budget"]."',
				'".nl2br($_POST["description"])."',
				'".$_POST["start_date"]."',
				'".$_POST["start_time"]."',
				'".$_POST["end_time"]."',
				'".$_POST["role"]."',
				'".$_POST["phase"]."',
				'".$_POST["status"]."',
				'".$_POST["ticket_id"]."',
				'".$_POST["priority"]."'
			)";

	    //mysqli_query($link,$query);

	    if ($link->query($query) === TRUE) {
		    $last_id = $link->insert_id;
		    //echo "New record created successfully. Last inserted ID is: " . $last_id;


		    //require_once '../inc/send-email.php?id=27';

		   

		    //$phone_num = "8046177013";

		    //include "../send-tasks.php?type=task&p=8046177013";


		} else {
		    echo "Error: " . $sql . "<br>" . $link->error;
		}




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
		role = '".$_POST['role']."',
		phase = '".$_POST['phase']."',
		ticket_id = '".$_POST['ticket_id']."',
		priority = '".$_POST['priority']."'

			WHERE id = '$id'";

	    mysqli_query($link,$query);

	    header('Location:' . $site_base . 'admin/' . $page_slug . '.php');

	}


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
	
	include "includes/head.php"; 
?>

<body>
	
	<?php include 'includes/header.php'; ?>

	<?php include 'includes/sidebar.php'; ?>

	<section id="main-content">



          <section class="wrapper">

				<div class="container-fluid col-print-12">

					<h1>
						<?php echo $page_title; ?>
						<a href="<?php echo $site_base; ?>admin/project-plans.php" class="pull-right btn btn-default" >Project Plans >></a><br>
						
						<a href="<?php echo $site_base; ?>admin/plans-archives.php" class="pull-right btn btn-default" >Plan Archives >></a>
					</h2><br><br>

							<form method="GET">

								<select name="filter_status">
					        		
									<option value="0" <?php if( !isset($row['status']) ){ echo ' selected'; } ?>>Filter <?php echo $page_title; ?></option>
									<option value="0">--------------</option>

									<option value="Approved!" <?php if($row['status']=="Approved!"){ echo ' selected'; } ?>>Approved!</option>
									<option value="Pending Approval" <?php if($row['status']=="Pending Approval"){ echo ' selected'; } ?>>Pending Approval</option>
									<option value="Denied" <?php if($row['status']=="Denied"){ echo ' selected'; } ?>>Denied</option>

									<option value="0">--------------</option>

									<option value="In Progress" <?php if($row['status']=="In Progress"){ echo ' selected'; } ?>>In Progress</option>
									<option value="Completed!" <?php if($row['status']=="Completed!"){ echo ' selected'; } ?>>Completed!</option>

					        	</select>

					        	<input type="submit" name="filter" value="Filter">

					        </form>
					<?php 

						
			/*

						if( isset($_GET['edit']) ){

							$id = $_GET['id'];
							$pguery = "SELECT * FROM $page_slug WHERE id = $id";

						}else{
							// page check
							$pguery = "SELECT * FROM $page_slug ORDER BY id ASC";
						}
						




						$count_pending = 'SELECT status COUNT(*) 
						FROM plans
						GROUP BY status';

						$statuses = mysqli_query($link,$count_pending);

						$result = $link->query($count_pending);


						//$num_rows = mysqli_num_rows($statuses);

						echo $result->num_rows;

						//echo $num_rows;
						//$database = new DB();

						//$database->print_debug($statuses);
			*/

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
								$filter_status = $_GET['filter_status'];

								$query = "SELECT * FROM $page_slug WHERE status = '$filter_status' ORDER BY id ASC ";

							}else{
								// page check
								$query = "SELECT * FROM $page_slug ORDER BY id DESC ";
							}

						}
						
						$result = mysqli_query($link,$query);
						$num_rows = mysqli_num_rows($result);

						$blog_html = "";

						$blog_row_count = 0;
						?>

						<div class="clearfix"></div><br>
						<div class="col-lg-12 hidden-xs hidden-sm hidden-md row">
							<div class="col-lg-1">
					        	<b>Role:</b>
					        </div>
					        <div class="col-lg-4">
					        	<b>Title:</b>
					        	
					        </div>
					        <div class="col-lg-4">
					        	<b>Description:</b>
					        	
					        </div>
							<div class="col-lg-2">
					        	<b>Time:</b>
					        </div>
					        
					        
					        <div class="col-lg-1">
					        	<b>Details:</b>
					        	
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
								    	<b>Role: </b>

							        	<select name="role">
								        		
												<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>Select</option>
												<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>--------------</option>
												<option value="dev1" <?php if($row['role']=="dev1"){ echo ' selected'; } ?>>Dev 1</option>


								        		<option value="dev2" <?php if($row['role']=="dev2"){ echo ' selected'; } ?>>Dev 2</option>

								        		<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>--------------</option>

								        		<option value="design1" <?php if($row['role']=="design1"){ echo ' selected'; } ?>>Design 1</option>

								        		<option value="design2" <?php if($row['role']=="design2"){ echo ' selected'; } ?>>Design 2</option>

								        		<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>--------------</option>

								        		<option value="intern" <?php if($row['role']=="intern"){ echo ' selected'; } ?>>Intern</option>

								        		
								        		
								        	</select>
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
								        		<br><br>

								        	<select name="phase" style="width: 100%;">
								        		
												<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>Select Phase</option>
												<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>
												<option value="planning" <?php if($row['phase']=="planning"){ echo ' selected'; } ?>>Planning Phase</option>


								        		<option value="initial-setup" <?php if($row['phase']=="initial-setup"){ echo ' selected'; } ?>>Initial Setup</option>

								        		<option value="server-config" <?php if($row['phase']=="server-config"){ echo ' selected'; } ?>>Server Config / SSL</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>

								        		<option value="theme-setup" <?php if($row['phase']=="theme-setup"){ echo ' selected'; } ?>>Theme Setup</option>

								        		<option value="finalizing-theme" <?php if($row['phase']=="finalizing-theme"){ echo ' selected'; } ?>>Finalizing Theme</option>

								        		<option value="mobile-styling" <?php if($row['phase']=="mobile-styling"){ echo ' selected'; } ?>>Mobile Styling</option>

								        		<option value="responsiveness" <?php if($row['phase']=="responsiveness"){ echo ' selected'; } ?>>Responsiveness</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>


								        		<option value="content" <?php if($row['phase']=="content"){ echo ' selected'; } ?>>Content Phase</option>

								        		<option value="revisions" <?php if($row['phase']=="revisions"){ echo ' selected'; } ?>>Revisions</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>


								        		<option value="forms-setup" <?php if($row['phase']=="forms-setup"){ echo ' selected'; } ?>>Forms Setup</option>

								        		<option value="google-setup" <?php if($row['phase']=="google-setup"){ echo ' selected'; } ?>>Google Setup</option>

								        		<option value="leads-setup" <?php if($row['phase']=="leads-setup"){ echo ' selected'; } ?>>Lead Generation</option>
								        		
								        	</select>

								        	<br><br>

								        	<select name="status">
								        		
												<option value="none" <?php if( !isset($row['status']) ){ echo ' selected'; } ?>>Select a Status</option>
												<option value="none">--------------</option>

												<option value="Approved!" <?php if($row['status']=="Approved!"){ echo ' selected'; } ?>>Approved!</option>
												<option value="Pending Approval" <?php if($row['status']=="Pending Approval"){ echo ' selected'; } ?>>Pending Approval</option>
												<option value="Denied" <?php if($row['status']=="Denied"){ echo ' selected'; } ?>>Denied</option>

												<option value="none">--------------</option>

												<option value="In Progress" <?php if($row['status']=="In Progress"){ echo ' selected'; } ?>>In Progress</option>
												<option value="Completed!" <?php if($row['status']=="Completed!"){ echo ' selected'; } ?>>Completed!</option>


								        		
								        		
								        	</select>

								        	<br><br>
							        		

							        		<select name="priority">
								        		
												<option value="none" <?php if($row['priority']=="none"){ echo ' selected'; } ?>>Select a Priority</option>
												<option value="none">--------------</option>

												<option value="Emergency!" <?php if($row['priority']=="Emergency!"){ echo ' selected'; } ?>>Emergency!</option>
												<option value="Urgent!" <?php if($row['priority']=="Urgent!"){ echo ' selected'; } ?>>Urgent!</option>
												<option value="Required" <?php if($row['priority']=="Required"){ echo ' selected'; } ?>>Required</option>

												<option value="none">--------------</option>

												<option value="Medium" <?php if($row['priority']=="Medium"){ echo ' selected'; } ?>>Medium</option>
												<option value="Low" <?php if($row['priority']=="Low"){ echo ' selected'; } ?>>Low</option>


								        		
								        		
								        	</select>


								        	
								        	
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
								        	Ticket: <input type='text' name='ticket_id' value="<?php echo $row['ticket_id']; ?>" style="width: 100%;" />
								        	Hrs: <input type='text' name='hours' value="<?php echo $row['hours']; ?>" style="width: 100%;" />
								        	Budget<input type='text' name='budget' value="<?php echo $row['budget']; ?>" style="width: 100%;" />
								        	<br>
								        	<br class="hidden-lg">
								        </div>
								        <div class="col-lg-2">

								        	<input type='submit' value='Update Task' name='update_task' class='btn btn-block btn-success' >
								        
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
									<div class='card'>
								    <div class='col-lg-12 card-body row'>


								    	<div class="col-lg-1 col-xs-6">


								    		<select name="role">
								        		
												<option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>Select</option>
												<option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>------</option>
												<option value="dev1" <?php if($row['status']=="dev1"){ echo ' selected'; } ?>>Dev 1</option>


								        		<option value="dev2" <?php if($row['status']=="dev2"){ echo ' selected'; } ?>>Dev 2</option>

								        		<option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>------</option>

								        		<option value="design1" <?php if($row['status']=="design1"){ echo ' selected'; } ?>>Design 1</option>

								        		<option value="design2" <?php if($row['status']=="design2"){ echo ' selected'; } ?>>Design 2</option>

								        		<option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>------</option>

								        		<option value="intern" <?php if($row['status']=="intern"){ echo ' selected'; } ?>>Intern</option>

								        		
								        		
								        	</select>
								        	<!-- -->
								        	
								        		
								        		<br>
								        		<br class="hidden-lg">
								        </div>
								    	<div class="col-lg-4">
								       
								        	<input type='text' name='title' placeholder="New Task .. " style="width: 100%;" />
								        	<br>
								        	<br class="hidden-lg">
								        </div>

								        <div class="col-lg-4">
								        	<textarea name='description' class="bcontent" placeholder="Task Description .." style="width: 100%;"></textarea>

								        	<br>
								        	<br class="hidden-lg">
								        </div>

								        <div class="col-lg-1">
								        	<!--<input type='text' name='ticket_id' placeholder="Ticket #" style="width: 100%;" />-->
								        	<center><small>Estimate</small></center>
								        	<input type='text' name='hours' placeholder="Hours" style="width: 100%;" />
								        	
								        	<!--
								        	<input type='text' name='budget' placeholder="Budget" style="width: 100%;" />-->
								        	<br>
								        	<br class="hidden-lg">
								        </div>
								        <div class="col-lg-2">

								        	<div class="row hidden">
									        	<div class="col-md-6">
									        		<input type='text' name='budget' placeholder="Budget" style="width: 100%;" />
									        	</div>
									        	<div class="col-md-6">
									        		<input type='text' name='ticket_id' placeholder="Ticket #" style="width: 100%;" />
									        	</div>
								        	</div>
								        	
								        	<select name="phase" style="width: 100%;">
								        		
												<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>Select Phase</option>
												<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>
												<option value="planning" <?php if($row['phase']=="planning"){ echo ' selected'; } ?>>Planning Phase</option>


								        		<option value="initial-setup" <?php if($row['phase']=="initial-setup"){ echo ' selected'; } ?>>Initial Setup</option>

								        		<option value="server-config" <?php if($row['phase']=="server-config"){ echo ' selected'; } ?>>Server Config / SSL</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>

								        		<option value="theme-setup" <?php if($row['phase']=="theme-setup"){ echo ' selected'; } ?>>Theme Setup</option>

								        		<option value="finalizing-theme" <?php if($row['phase']=="finalizing-theme"){ echo ' selected'; } ?>>Finalizing Theme</option>

								        		<option value="mobile-styling" <?php if($row['phase']=="mobile-styling"){ echo ' selected'; } ?>>Mobile Styling</option>

								        		<option value="responsiveness" <?php if($row['phase']=="responsiveness"){ echo ' selected'; } ?>>Responsiveness</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>


								        		<option value="content" <?php if($row['phase']=="content"){ echo ' selected'; } ?>>Content Phase</option>

								        		<option value="revisions" <?php if($row['phase']=="revisions"){ echo ' selected'; } ?>>Revisions</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>


								        		<option value="forms-setup" <?php if($row['phase']=="forms-setup"){ echo ' selected'; } ?>>Forms Setup</option>

								        		<option value="google-setup" <?php if($row['phase']=="google-setup"){ echo ' selected'; } ?>>Google Setup</option>

								        		<option value="leads-setup" <?php if($row['phase']=="leads-setup"){ echo ' selected'; } ?>>Lead Generation</option>
								        		
								        	</select>
								        	
								        	<br>

								        	<br>

								        	<select name="status">
								        		
												<option value="none" <?php if( !isset($row['status']) ){ echo ' selected'; } ?>>Select a Status</option>
												<option value="none">--------------</option>

												<option value="Approved!" <?php if($row['status']=="Approved!"){ echo ' selected'; } ?>>Approved!</option>
												<option value="Pending Approval" <?php if($row['status']=="Pending Approval"){ echo ' selected'; } ?>>Pending Approval</option>
												<option value="Denied" <?php if($row['status']=="Denied"){ echo ' selected'; } ?>>Denied</option>

												<option value="none">--------------</option>

												<option value="In Progress" <?php if($row['status']=="In Progress"){ echo ' selected'; } ?>>In Progress</option>
												<option value="Completed!" <?php if($row['status']=="Completed!"){ echo ' selected'; } ?>>Completed!</option>


								        		
								        		
								        	</select>

								        	<br><br>
							        		

							        		<select name="priority">
								        		
												<option value="none" <?php if($row['priority']=="none"){ echo ' selected'; } ?>>Select a Priority</option>
												<option value="none">--------------</option>

												<option value="Emergency!" <?php if($row['priority']=="Emergency!"){ echo ' selected'; } ?>>Emergency!</option>
												<option value="Urgent!" <?php if($row['priority']=="Urgent!"){ echo ' selected'; } ?>>Urgent!</option>
												<option value="Required" <?php if($row['priority']=="Required"){ echo ' selected'; } ?>>Required</option>

												<option value="none">--------------</option>

												<option value="Medium" <?php if($row['priority']=="Medium"){ echo ' selected'; } ?>>Medium</option>
												<option value="Low" <?php if($row['priority']=="Low"){ echo ' selected'; } ?>>Low</option>


								        		
								        		
								        	</select>
								        	<br><br>

								        	<input type='submit' value='Add Task' name='new_task' class='btn btn-block btn-success' >

								        	
								        
								        </div>






								    

										<div class="clearfix"></div>	    
									    
								    </div></div>
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

							$color = "";


							if ( $row["status"] == "in-scope" ) {
									$color = "green";
								}
								if ( $row["status"] == "out-of-scope" ) {
									$color = "red";
								}
								if ( $row["status"] == "fix" ) {
									$color = "red";
								}
								if ( $row["status"] == "value-added" ) {
									$color = "yellow";
								}

								if ( $row["status"] == "completed" ) {
									//echo "HERE!";
									continue;
								}
								

							$img_loc = null;
							$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
							$result2 = mysqli_query($link,$query2);

							while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }
										$total_hours += $row['hours'];
							
								 ?> 
							    <div class='col-lg-12 well <?php echo $color;?>'>
							    	<div class="col-lg-5 col-xs-6" contenteditable="false">
							        	<!-- -->
							        		<b><?php echo $row["id"]; ?></b> - <input type="checkbox" name="check<?php echo $row["id"]; ?>" value="Completed"> &nbsp;&nbsp; <b class="title"><a target="_blank" href="/work/?type=<?php echo $page_slug; ?>&id=<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></a></b>

							        		<br><br>
							        		

							        		<select name="priority">
								        		
												<option value="none" <?php if($row['priority']=="none"){ echo ' selected'; } ?>>Select a Priority</option>
												<option value="none">--------------</option>

												<option value="Emergency!" <?php if($row['priority']=="Emergency!"){ echo ' selected'; } ?>>Emergency!</option>
												<option value="Urgent!" <?php if($row['priority']=="Urgent!"){ echo ' selected'; } ?>>Urgent!</option>
												<option value="Required" <?php if($row['priority']=="Required"){ echo ' selected'; } ?>>Required</option>

												<option value="none">--------------</option>

												<option value="Medium" <?php if($row['priority']=="Medium"){ echo ' selected'; } ?>>Medium</option>
												<option value="Low" <?php if($row['priority']=="Low"){ echo ' selected'; } ?>>Low</option>


								        		
								        		
								        	</select>


							        		<!--
							        		<?php echo date('m/d/y', strtotime($row['start_date'])); ?></b>-->
							        		<br>
							        		<br class="hidden-lg">
							        </div>


							         <div class="col-lg-5 hidden">
							        	<!--<b>Ticket #:</b> <?php echo $row["ticket_id"]; ?><br>-->
							        	<b class="title"><?php echo $row["title"]; ?></b>
							        	<?php //echo $row["hours"]; ?>
							        	<!--, <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>-->
							        	<br>
							        	<br class="hidden-lg">
							        </div>
							        
							    
							       
							        <div class="col-lg-4">
							        	<b>Description:</b><br>
							        	
							        	<?php echo $row["description"]; ?>
							        	<br>
							        	<br class="hidden-lg">
							        </div>
							        <div class="col-lg-1 hidden">
							        	<p>Ticket #: <?php echo $row["ticket_id"]; ?></p>
							        	<p>Hours: <?php echo $row["hours"]; ?></p>
							        	<p>Budget: <?php echo $row["budget"]; ?></p>
							        </div>
							        <div class="col-lg-2 col-xs-6 hidden" contenteditable="false">
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

							        	
							        	
							        	
							        	<b>Role: </b>

							        	<select name="role">
								        		
												<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>Select</option>
												<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>------</option>
												<option value="dev1" <?php if($row['role']=="dev1"){ echo ' selected'; } ?>>Dev 1</option>


								        		<option value="dev2" <?php if($row['role']=="dev2"){ echo ' selected'; } ?>>Dev 2</option>

								        		<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>------</option>

								        		<option value="design1" <?php if($row['role']=="design1"){ echo ' selected'; } ?>>Design 1</option>

								        		<option value="design2" <?php if($row['role']=="design2"){ echo ' selected'; } ?>>Design 2</option>

								        		<option value="none" <?php if($row['role']=="none"){ echo ' selected'; } ?>>------</option>

								        		<option value="intern" <?php if($row['role']=="intern"){ echo ' selected'; } ?>>Intern</option>

								        		
								        		
								        	</select>



								        	<br><br>



								        	<select name="phase" style="width: 100%;">
								        		
												<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>Select Phase</option>
												<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>
												<option value="planning" <?php if($row['phase']=="planning"){ echo ' selected'; } ?>>Planning Phase</option>


								        		<option value="initial-setup" <?php if($row['phase']=="initial-setup"){ echo ' selected'; } ?>>Initial Setup</option>

								        		<option value="server-config" <?php if($row['phase']=="server-config"){ echo ' selected'; } ?>>Server Config / SSL</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>

								        		<option value="theme-setup" <?php if($row['phase']=="theme-setup"){ echo ' selected'; } ?>>Theme Setup</option>

								        		<option value="finalizing-theme" <?php if($row['phase']=="finalizing-theme"){ echo ' selected'; } ?>>Finalizing Theme</option>

								        		<option value="mobile-styling" <?php if($row['phase']=="mobile-styling"){ echo ' selected'; } ?>>Mobile Styling</option>

								        		<option value="responsiveness" <?php if($row['phase']=="responsiveness"){ echo ' selected'; } ?>>Responsiveness</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>


								        		<option value="content" <?php if($row['phase']=="content"){ echo ' selected'; } ?>>Content Phase</option>

								        		<option value="revisions" <?php if($row['phase']=="revisions"){ echo ' selected'; } ?>>Revisions</option>

								        		<option value="none" <?php if($row['phase']=="none"){ echo ' selected'; } ?>>--------------</option>


								        		<option value="forms-setup" <?php if($row['phase']=="forms-setup"){ echo ' selected'; } ?>>Forms Setup</option>

								        		<option value="google-setup" <?php if($row['phase']=="google-setup"){ echo ' selected'; } ?>>Google Setup</option>

								        		<option value="leads-setup" <?php if($row['phase']=="leads-setup"){ echo ' selected'; } ?>>Lead Generation</option>
								        		
								        	</select>


								        	<br><br>

								        	<select name="status">
								        		
												<option value="none" <?php if( !isset($row['status']) ){ echo ' selected'; } ?>>Select a Status</option>
												<option value="none">--------------</option>

												<option value="Approved!" <?php if($row['status']=="Approved!"){ echo ' selected'; } ?>>Approved!</option>
												<option value="Pending Approval" <?php if($row['status']=="Pending Approval"){ echo ' selected'; } ?>>Pending Approval</option>
												<option value="Denied" <?php if($row['status']=="Denied"){ echo ' selected'; } ?>>Denied</option>

												<option value="none">--------------</option>

												<option value="In Progress" <?php if($row['status']=="In Progress"){ echo ' selected'; } ?>>In Progress</option>
												<option value="Completed!" <?php if($row['status']=="Completed!"){ echo ' selected'; } ?>>Completed!</option>


								        		
								        		
								        	</select>


								        	
								        <!--	<br>
							        	<b>Updated: </b><?php echo date("m/d/y g:ia", strtotime($row["modified"])); ?>
							        	<form method="post">
							        		<textarea name="notes" placeholder="Enter Notes .."><?php echo $row["notes"]; ?></textarea><br>
								        	<select name="status">
								        	
												<option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>Task Type</option>
												<option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>--------------</option>
												<option value="in-scope" <?php if($row['status']=="in-scope"){ echo ' selected'; } ?>>In Scope</option>
								        		<option value="out-of-scope" <?php if($row['status']=="out-of-scope"){ echo ' selected'; } ?>>Out of Scope</option>
								        		<option value="improvement" <?php if($row['status']=="improvement"){ echo ' selected'; } ?>>Improvement</option>
								        		<option value="fix" <?php if($row['status']=="fix"){ echo ' selected'; } ?>>Bug Fix</option>
								        		<option value="update" <?php if($row['status']=="update"){ echo ' selected'; } ?>>System Update</option>

												<option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>--------------</option>
								        		<option value="value-added" <?php if($row['status']=="value-added"){ echo ' selected'; } ?>>Value-Added</option>
								        		<option value="enabler" <?php if($row['status']=="enabler"){ echo ' selected'; } ?>>Enabler</option>
								        		<option value="waste" <?php if($row['status']=="waste"){ echo ' selected'; } ?>>Waste</option>
								        		
								        		
								        	</select>
								        	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								        	<input type="submit" name="Update" value="Update">
							        	</form>

							        	<br>
							        -->
							        	
							        

							        </div>
							        <div class="col-lg-1">

							        	<p>Hours: <?php echo $row["hours"]; ?></p>
							        	
							        	<?php 
							        			echo "<a href=\"" . $site_base . "admin/".$page_slug.".php?edit=true&id=" . $row["id"] . "\" class=\" pull-right1 btn1 btn-default1\">Edit</a>";

							        			echo " | <a href=\"" . $site_base . "admin/delete_any.php?type=".$page_slug."&id=" . $row["id"] . "\" class=\" pull-right1 btn1 btn-danger1\">Delete</a>";
							        		?>
							        </div>

							        <div class="clearfix"></div>
							        
							        <?php
							            if (!empty($row["youtube_url"]))
			    						{
			        						echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
			    						}
									?>






							<form method="post" enctype='multipart/form-data'>
							    <div class='col-lg-2 well1'>

							    		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

							        	<input type="hidden" name="role" value="<?php echo $row['role']; ?>">


							        	<input type="hidden" name="title" value="<?php echo $row['title']; ?>">
							   
							  
							        	<input type="hidden" name="description" value="<?php echo $row['description']; ?>">
							  
							        	<input type="hidden" name="hours" value="<?php echo $row['hours']; ?>">
							  
										

							        	<input type="hidden" name="ticbudgetket_id" value="<?php echo $row['budget']; ?>">
							        	
							        	<input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id']; ?>">
							        	
						        		<input type="hidden" name="phase" value="<?php echo $row['phase']; ?>">

						        		<input type="hidden" name="status" value="<?php echo $row['status']; ?>">

							        	<input type="hidden" name="priority" value="<?php echo $row['priority']; ?>">

							        	<input type="hidden" name="action" value="Email">

							        	<input type='submit' value='Email Task' name='send_task' class='btn btn-block btn-success' >


									<div class="clearfix"></div>	    
								    
							    </div>
							</form>










								


								<?php 
									if ( $row['status'] == "Approved!" ) {
										?>
										 <div class="clearfix"></div><hr>
			                                <div class="small row">
			                                    <div class="col-6 text-left">
			                                        <u><?php echo $row[approved_name]; ?></u> Approved <u><?php echo $row[approved_method]; ?></u>: <span style="color: red; "><?php echo date( "m/d/Y g:i A", strtotime($row[approved_date])); ?></span>
			                                    </div>
			                                    <div class="col-6 text-sm-right">
			                                        Updated By: <u><?php echo $row[approved_user]; ?></u> <span style="color: red;">(<?php echo $row[approved_ip]; ?>)</span> | <span style="color: red; "><?php echo date( "m/d/Y g:i A", strtotime($row[modified])); ?></span>
			                                    </div>
			                                   
			                                </div>

										<?php
									}else{
										?>
										<div class="clearfix"></div><hr>
										<form class="small row" method="GET" action="/work/approved.php">
					                        <div class="col-12 text-left">
					                            <b>Approved:</b> 

					                            <select name="approved_method">
								        		
													<option value="none" <?php if( !isset($row['status']) ){ echo ' selected'; } ?>>Select a Status</option>
													<option value="none">--------------</option>

													<option value="Verbally" <?php if($row['status']=="Verbally"){ echo ' selected'; } ?>>Verbally</option>
													<option value="By Signature" <?php if($row['status']=="By Signature"){ echo ' selected'; } ?>>By Signature</option>
													<option value="Online" <?php if($row['status']=="Online"){ echo ' selected'; } ?>>Online</option>
									        		
									        		
									        	</select>


									        	BY: 
									        	<input type="text" name="approved_name" value="Jim">

									        	on

									        	<input type="date" name="approved_date" value="<?php echo date('Y-m-d'); ?>">

									        	at 

									        	<input type="time" name="approved_time" value="<?php echo date('H:i'); ?>"> 

									        	on Location at 

									        	<input type="text" name="approved_location" value="Definis & Sons">

									        	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									        	<input type="hidden" name="type" value="<?php echo $page_slug; ?>">

									        	<input type='submit' value='Approved!' name='add_approval' class='btn btn-success pull-right1' >

					                        </div>
					                     
					                       
					                    </form>

										<?php

									}

								 ?>
								




						

										    
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
						<!--<br> Total Time: <?php echo $total_time; ?>

						<br>Total: <?php echo ($total_hours + ($total_mins/60)); ?>-->

						<br><?php echo ($total_hours + (floor($total_mins/60))); ?> Hours

						<!--<br>Total Mins: <?php echo floor($total_mins/60); ?>

						 <?php echo ($total_mins % 60); ?> Mins-->

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
			
			</section>
		</section>

	<?php include "includes/scripts.php"; ?>
</body>