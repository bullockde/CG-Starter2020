<?php
	include "../src/crutchphp/config.php";

	$LOGOUT_URL = $site_base;
	$LOGDIN_URL = $site_base."admin-panel/";
	$TIMEOUT_COOKIE = time() + 360 * 60;


	function login_form($emsg){

		include "../src/crutchphp/config.php";
		$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

		$tquery = "SELECT * FROM blog_images WHERE  name='logo'";

		$tres = mysqli_query( $link, $tquery);

		$tnr = mysqli_num_rows($tres);

		$row  = mysqli_fetch_array($tres);

		$logo_url = $row['location'];

		//echo $logo_url;

	?>
		<!--
		#######################################
		    - THE LOGIN FORM -
		######################################
		-->

		<!DOCTYPE html>
		<html>
		  <head>
		    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" media="screen">
		    <meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width" />
			<title><?php echo $admin_name; ?></title>
			<meta name="description" content="<?php echo $admin_name; ?>" />
			<meta name="author" content="Oscuro Designs" />
		  </head>
		  <body>
		    <div class="container">
		      <div class="row">
		        <div class="col-md-4 col-md-offset-4" style="padding-top: 100px;">

		        	<div class="text-center">


		        		<?php 

		        		if( isset( $logo_url ) ){
		        			?>
		        			<img src="<?php echo $site_base . $logo_url; ?>"><br><br>
		        			<?php
		        		}else{
		        			?>
		        			<img src="../uploads/logo.png"><br><br>
		        			<?php
		        		}
		        		?>
		        			
		        	</div>
		          <form method="post" role="form">
		            <div class="form-group">
		              <input type="text" class="form-control" name="access_login" placeholder="username"/>
		            </div>
		            <div class="form-group">
		              <input type="password" name="access_password" class="form-control" placeholder="password"/>
		            </div>
		            <div class="form-group">
		               <input type="submit" name="Submit" value="Log In" class="btn btn-primary form-control" />
		            </div>
		            <div class="form-group">
		            	<h3><?php echo $emsg; ?></h3>
		            </div>
		          </form>
		        </div>
		      </div>
		    </div>
		  </body>
		  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		</html>

	<?php
	}

	function clean_data($field)
	{
		$cdata = mysqli_real_escape_string( $link, $field );
		return $cdata;
	}


	if(isset($_POST['access_password']))
	{

		$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

		mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());


		$login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
		$pass = $_POST['access_password'];


		$query = "SELECT * FROM users WHERE name = '".$login."' AND `pass` = PASSWORD('".$pass."')";

		$resp = mysqli_query ( $link , $query );


		$qnrs = mysqli_num_rows($resp);
		

		if($qnrs > 0)
		{
			setcookie("verified", md5($login.'%'.$pass), $TIMEOUT_COOKIE, '/');
			setcookie("access_login", $_POST['access_login'], $TIMEOUT_COOKIE, '/');
			
			unset($_POST['access_login']);
    		unset($_POST['access_password']);
    		unset($_POST['Submit']);

    		header("Location: ".$LOGDIN_URL);

		}else{
			login_form("Login Information Not Found!");
		}
		
	}else{
		
		if(isset($_GET['logout']))
		{
			unset($_COOKIE['verified']);
			//setcookie("verified", "", $ctimeout, "/");
			header("Location: ".$LOGOUT_URL);
		}else{
			if(!isset($_COOKIE['verified']))
			{
				login_form("");
			}else{
				header("Location: ".$LOGDIN_URL);
			}
		}
	
	}
?>