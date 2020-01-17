<?php
include "../src/crutchphp/config.php";

if(!isset($_COOKIE['verified'])){ header("Location: ".$site_base."admin/login.php"); }

$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

	mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());

if(isset($_GET['imid']) && isset($_GET['bid'])) 
{
	$bid = $_GET['bid'];
	$imid = $_GET['imid'];

	$query = "DELETE FROM blog_images WHERE blog_id='$bid' AND id='$imid'";
	$result = mysqli_query($link,$query);

	if(mysqli_affected_rows($link) > 0){
		header("Location: ".$site_base."admin/edit.php?id=".$bid);
	}else{
		header("Location: ".$site_base."admin/edit.php?id=".$bid);
	}
}
