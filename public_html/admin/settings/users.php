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

		$users = "CREATE TABLE IF NOT EXISTS `users` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `name` text COLLATE utf8_unicode_ci NOT NULL,
			 `pass` text COLLATE utf8_unicode_ci NOT NULL,
			 `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			 `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			 PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

			mysqli_query($link,$users);



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
	$page_title = "User Admin";
	include $relative . "includes/head.php"; 
?>
<body>
	
	<?php include $relative . 'includes/header.php'; ?>

	<?php include $relative . 'includes/sidebar.php'; ?>

	<section id="main-content">
      <section class="wrapper">
	
			<div class="container-fluid">

				<h2>Add Users</h2><br>



				<div class="col-md-4 1offset-md-4">

			    	<div class="text-center">


			    		<?php 

			    		if( isset( $logo_url ) ){
			    			?>
			    			<img src="<?php echo $site_base . $logo_url; ?>"><br><br>
			    			<?php
			    		}elseif( file_exists("../uploads/logo.png") ){
			    			?>
			    			<img src="../uploads/logo.png"><br><br>
			    			<?php
			    		}
			    		?>
			    			
			    	</div>
			      <form method="post" role="form">
			      	<div class="card">
			      		<div class="card-body">
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

			      		</div>
			      	</div>
			        
			      </form>
			    </div>



			    <div class="clearfix"></div>

			    <div class="row ">
			   
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

					$count = 1;

					$blog_row_count = 0;
					while($row=mysqli_fetch_array($result)){
						$img_loc = null;
						$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
						$result2 = mysqli_query($link,$query2);

						while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

						
							 ?> 
							 <div class="col-md-12 card">
						    <div class=' card-body slide'>
						        
						        <?php echo $count++;
						        	echo ". ";
						        	echo $row["name"]; ?><br><br>
						        
						       
								<div class="clearfix"></div><br>	

		    

		    			        <?php echo "<p>Created: <b>" . date("m-d-Y", strtotime($row["created"])) . "</b><br />Modified: <b>" . date("m-d-Y", strtotime($row["modified"])) . "</b></p><br />"; ?>
					
						        <div class="clearfix"></div><br>
						        <?php echo "<div class='buttons'><ul class=\"list-inline buttons d-flex align-items-baseline\"><li><a href=\"" . $site_base . "admin/edit_users.php?id=" . $row["id"] . "\" class=\"btn btn-default\">Edit</a></li>"; ?>
						        <?php echo "<li><a href=\"" . $site_base . "admin/delete_any.php?type=users&id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>

						        
		        				</ul>
		        				</div>				    
						    </div>
						    
						    <?php

							$blog_row_count++;

							if ($blog_row_count % 3 === 0) { echo "</div><div class='row'>"; }

					
					}

					

					//mysql_close();
					
				?>

				</div>
				</div>

				<div class="clearfix"></div>
				<div class="col-sm-12">
					<ul class="pagination">
						<?php 

							$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

							mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error($link));

				
							
							$query = "SELECT * FROM users ORDER BY modified DESC";

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
		</section>
	</section>



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
	<?php include $relative . "includes/scripts.php"; ?>

</body>