<!DOCTYPE html>
<html lang="en">
<?php
// This results in an error.
// The output above is before the header() call
//header('Location: /quote.php');

	include "../src/crutchphp/config.php";

 	$type = $_GET['type'];
    $id = $_GET['id'];

    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ". mysqli_error($link));

    $query = "SELECT * FROM $type WHERE id = $id";

    $result = mysqli_query($link,$query);

    $row = mysqli_fetch_array($result);
?>
  <head>
	  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-33709828-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-33709828-3');
</script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Evans Pest Control can make your pests disappear fast - contact Evans Pest Control today">
    <meta name="author" content="">

    <title>Get In Touch With Evans Pest Control | (267) 582-2687</title>

	<!-- Latest compiled and minified CSS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.offcanvas.min.css">
	<link rel="stylesheet" href="../css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../css/hover.min.css">
	<link rel="stylesheet" href="../css/core.css">
	
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="../css/style.css">
	<link type="text/css" rel="stylesheet" href="../css/responsive.css"> 
	
	<script src="../js/jquery-3.2.0.min.js"></script>
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true&key=AIzaSyCwHy4B8L9bB1JAILZW84KPGw8TPlAYGqY"></script>
		<script src="../js/jquery.gmap.js"></script>
		<script src="../js/gmap3.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<style type="text/css">

	    .accept-button {
	        max-width:450px; 
	        font-size: 1.5em;
	        padding: .5em 2em;

	    }
	    .contact-us {
		    background: #fafaf9;
		    padding: 50px 50px 100px;
		}
		.contact-inner {
			font-size: 24px;
			line-height: 48px;
		}
	    @media only screen and (max-width: 600px) {
	      .accept-button {
	             
	            font-size: 1em;
	            padding: .5em 1em;

	        }
	    }
	    


	</style>

	</head>

	<body>
		<?php include '../header.php'; ?>
		
		<div id="content" class="site-content content-wrapper page-content">
			<div class="page type-page hentry">
				<div class="page-content-body">
					
									
					<section class="contact-us">
						<div class="container">
							<div class="row">
								<div class="contact-inner">
					                <div class="row">
					                    <div class="col-md-8 col-md-offset-2">
					                        <div class="text-center">
					                            <h1 class="title">New Work Request!</h1>
					                            
					                            <h3><b><?php echo $row[title]; ?></b></h3>

					                                
					                                    <h3>Details:</h3>
					                                
					                            
					                            <div class="small row">
					                                <div class="col-xs-6 text-left">
					                                    <h5>Priority: <span style="color: red; text-decoration: underline;"><?php echo $row[priority]; ?></span></h5>
					                                </div>
					                                <div class="col-xs-6 text-right">
					                                    <h5><span style="color: red; text-decoration: underline;"><?php echo $row["hours"]; ?></span> Hr <small>(Estimated)</small></h5>
					                                </div>
					                               
					                            </div>
					                            <div class="clearfix"></div>
					                            <div class="well text-left">
					                                
					                                <?php echo $row[description]; ?>
					                            </div>
					                        </div>

					                        <div class="clearfix"></div>

					                        <center>
					                            <a  href="/admin/plans.php?id=<?php echo $row[id]; ?>&status=approved" class="btn-success btn btn-block1 btn-lg accept-button">Click to Accept &raquo;</a>
					                        </center>
					                       <!-- <div class="col-md-4">
					                            <a class="btn-warning btn btn-block btn-lg">Maybe Later</a>
					                        </div>
					                        <div class="col-md-4">
					                            <a class="btn-danger btn btn-block btn-lg">Decline</a>
					                        </div>
					                        -->
					                        <div class="clearfix"></div>

					                        <?php //include "contact_form.php"; ?>
					                        
					                    </div>
					                </div>    
					            </div>  
							</div>
						</div>
					</section>
					

					
					<!-- <section class="newsletter">
						<div class="container">
							<div class="row">
								<div class="section-header">
									<h2>Get relief from your pest problem today?</h2>
									<p>Let Evans Pest Control take control of your pest issues today!</p>
								</div>
								<div class="section-content">
									<form action="../contactproc.php" method="post">
									<center>
									<input type="email" name="themail" placeholder="Enter your e-mail here to get started" size="70">
									<input class="hvr-push" type="submit" value="Get started">
									 <div class="g-recaptcha" data-sitekey="6LdqWFkUAAAAAE5-
vpENoKIzcSqznvORkyGs7pXg"></div> 
									</center>
									</form>
								</div>
							</div>
						</div>
					</section> -->
										
				</div>
			</div>
		</div>
		
		<?php include '../footer.php'; ?>
		
		
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/bootstrap-select.min.js"></script>
		<script src="../js/bootstrap.offcanvas.min.js"></script>
		<script src="../js/main.js"></script>
		

	</body>
</html>