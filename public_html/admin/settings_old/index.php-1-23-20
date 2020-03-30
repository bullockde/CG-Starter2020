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
	$page_title = "Admin Settings";
	include $relative . "head.php"; 
?>
<body>
	
	<?php include $relative . 'header.php'; ?>
	
	<div class="container-fluid">

		<h1><?php echo $page_title; ?></h1>


		<div class="clearfix"></div> <br>

		<div class="col-md-12">
			
			<a class="btn btn-primary btn-lg" href="<?php echo $admin_base; ?>settings/logo.php">Upload - Site Logo &raquo;</a>
			<br><br>
			<a class="btn btn-primary btn-lg" href="<?php echo $admin_base; ?>settings/users.php">Manage Users &raquo;</a>
			<br><br>
			<a class="btn btn-primary btn-lg" href="<?php echo $admin_base; ?>settings/show_table.php">Database Tools &raquo;</a>
			<br><br>
			<a class="btn btn-primary btn-lg" href="<?php echo $admin_base; ?>settings/resumes.php">Resume Submissions &raquo;</a>
			<br><br>

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