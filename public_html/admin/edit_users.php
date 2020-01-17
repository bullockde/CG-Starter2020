<?php
include "../src/crutchphp/config.php";
if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }


$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

		mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ");


		if(isset($_POST['new_user'])){

          	$name = $_POST['access_login'];
          	$pass = $_POST['access_password'];
     
             $query = "INSERT INTO users(name,pass) VALUES('".$name."',PASSWORD('".$pass."'))";
             $tres = mysqli_query( $link, $query);

	     }

	     if(isset($_POST['update_user'])){

	     	$id = $_POST['id'];
          	$name = $_POST['access_login'];
          	$pass = $_POST['access_password'];
     
             $query = "UPDATE users SET name = '$name', pass = PASSWORD('".$pass."') WHERE id = '$id'";

             $tres = mysqli_query( $link, $query);

             header("Location: ".$admin_base."users.php");

	     }



		$tquery = "SELECT * FROM blog_images WHERE  name='logo'";

		$tres = mysqli_query( $link, $tquery);

		$tnr = mysqli_num_rows($tres);

		$row  = mysqli_fetch_array($tres);

		$logo_url = $row['location'];


		$pguery = "SELECT * FROM users WHERE id = '" .$_GET['id']. "'";
			$pgr = mysqli_query($link,$pguery);

			$row2  = mysqli_fetch_array($pgr);

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
	$page_title = "Edit User";
	include "head.php"; 
?>
<body>
	
	<?php include 'header.php'; ?>
	
	<div class="container-fluid">

		<h1>Edit User:</h1>



		<div class="col-md-4 col-md-offset-4">

	    	<div class="text-center">


	    		<?php 

	    		if( isset( $logo_url ) ){
	    			?>
	    			<img src="<?php echo $site_base . $logo_url; ?>"><br><br>
	    			<?php
	    		}else{
	    			?>
	    			<img src="uploads/logo.png"><br><br>
	    			<?php
	    		}
	    		?>
	    			
	    	</div>
	      <form method="post" role="form">
	        <div class="form-group">
	        	<label>Username:</label>
	          <input type="text" class="form-control" name="access_login" placeholder="Enter a Username" value="<?php echo $row2['name']; ?>" />
	          <input type="hidden" class="form-control" name="id" value="<?php echo $row2['id']; ?>" />
	        </div>
	        <div class="form-group">
	        	<label>New Password:</label>
	          <input type="password" name="access_password" class="form-control" placeholder="Enter a Password" value=""/>
	        </div>
	        <div class="form-group">
	           <input type="submit" name="update_user" value="Update User" class="btn btn-primary form-control" />
	        </div>
	        <div class="form-group">
	        	<h3><?php echo $emsg; ?></h3>
	        </div>
	      </form>
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