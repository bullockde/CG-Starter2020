<?php

	include "../src/crutchphp/config.php";
	
	if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }

	$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

	mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());

	$id = $_GET["id"]; 
	
	if(isset($_POST['Delete']) && isset($id)) 
	{
		$query = "DELETE FROM blogs WHERE id='$id'";
		$result = mysqli_query( $link, $query);

		$query2 = "DELETE FROM blog_images WHERE blog_id='$id'";
		$result2 = mysqli_query( $link, $query2);

		if(mysqli_affected_rows( $link ) > 0){
			header("Location: ".$site_base."admin/");
		}else{
			header("Location: ".$site_base."admin/");
		}
	}

	if($id)
	{
		$query = "SELECT * FROM blogs where id='$id'";
		$result = mysqli_query( $link, $query);

		while($row=mysqli_fetch_array($result)){
			$title = stripslashes($row["title"]);
		}

	}

	mysqli_close( $link );
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
<head>  
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php echo $admin_name ?> v<?php echo $admin_ver; ?> - Delete Blog '<?php echo $title ?>'</title>
	<meta name="description" content="<?php echo $admin_name ?> v<?php echo $admin_ver; ?>" />
	<meta name="author" content="Oscuro Designs" />
	<link rel='canonical' href='<?php echo $site_base; ?>' />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://cdn.rawgit.com/bootstrap-wysiwyg/bootstrap3-wysiwyg/master/src/bootstrap3-wysihtml5.css" rel="stylesheet" />
	<style>
		.btn-file { position: relative; overflow: hidden; }
		.btn-file input[type=file] { position: absolute; top: 0; right: 0; min-width: 100%; min-height: 100%; font-size: 100px; text-align: right; filter: alpha(opacity=0); opacity: 0; outline: none; background: white; cursor: inherit; display: block; }
		input[readonly] { background-color: white !important; cursor: text !important; }
	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="#"><?php echo $admin_name ?></a>
		  </div>
		  <div id="navbar" class="navbar-collapse collapse">
		    <ul class="nav navbar-nav">
		      <li><a href="<?php echo $site_base; ?>admin/">Home</a></li>
		      <li class="active"><a href="<?php echo $site_base; ?>admin/edit.php?id=<?php echo $_GET['id']; ?>">Edit Post</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="?logout">Logout</a></li>
		    </ul>
		  </div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<form method="post" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<h3>Delete <?php echo $title; ?>?</h3>
					</div>
					<div class="form-group">
						<input type="submit" name="Delete" value="Delete" class="btn btn-danger form-control" />
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>