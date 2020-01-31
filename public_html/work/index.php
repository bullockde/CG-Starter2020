<!DOCTYPE html>
<html lang="en">
<?php

    include "../src/crutchphp/config.php";
    include '../includes/head.php';


?>
<style type="text/css">

    .accept-button {
        max-width:450px; 
        font-size: 1.5em;
        padding: .5em 2em;

    }

    @media only screen and (max-width: 600px) {
      .accept-button {
             
            font-size: 1em;
            padding: .5em 1em;

        }
    }
    


</style>

	<body>
		<?php include '../includes/header.php'; ?>
		
		<div id="content" class="site-content content-wrapper page-content">
			<div class="page type-page hentry">
				<div class="page-content-body">
					
									
					<section id="mt_contact" class="">

				        <div class="container">

				        	<?php 	

				        		$type = $_GET['type'];

							    $id = $_GET['id'];

							    //echo "HERE1";

							    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ". mysqli_error($link));

							    $query = "SELECT * FROM $type WHERE id = $id";

							    $result = mysqli_query($link,$query) or die( mysqli_error($link) );

							    $row = mysqli_fetch_array($result);

							    //print_r( $row );

							    //echo "Hello";
							   // echo "HERE2";


				        	?>
				           
				            

				            <div class="contact-inner">
				                <div class="row">
				                    <div class="col-md-8 offset-md-2">
				                        <div class="text-center">

				                            <div class="sec-title-style1 text-center">
				                                 <h1 class="title">New Work Request!</h1>
				                            </div>

				                            	
				                                    <b><u> Task	</u></b>
				                               
				                            	<br>	
				                           
				                            <h2><small> <?php echo $row[title]; ?>	</small></h2>

				                            	<br><br>

				                                <br>
				                                    <b>Details:</b>
				                                <br>
				                            
				                            <div class="small row">
				                                <div class="col-6 text-left">
				                                    <b>Priority: <span style="color: red; text-decoration: underline;"><?php echo $row[priority]; ?></span></b>
				                                </div>
				                                <div class="col-6 text-sm-right">
				                                    <b><span style="color: red; text-decoration: underline;"><?php echo $row["hours"]; ?></span> Hr <small>(Estimated)</small></b>
				                                </div>
				                               
				                            </div>
				                            <div class="clearfix"></div>
				                            <div class="card card-body text-left">
				                                
				                                <?php echo $row[description]; ?>
				                            </div>
				                        </div>

				                        <div class="clearfix"></div><br
				>
				                        <center>
				                            <a  href="/admin/plans.php?id=<?php echo $row[id]; ?>&status=Approved!" class="btn-success btn btn-block1 btn-lg accept-button">Click to Accept &raquo;</a>
				                        </center>
				                       <!-- <div class="col-md-4">
				                            <a class="btn-warning btn btn-block btn-lg">Maybe Later</a>
				                        </div>
				                        <div class="col-md-4">
				                            <a class="btn-danger btn btn-block btn-lg">Decline</a>
				                        </div>
				                        -->
				                        <div class="clearfix"></div><br><br>

				                        <?php //include "contact_form.php"; ?>
				                        
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
		
		<?php include '../includes/footer.php'; ?>
		
		
		<?php include '../includes/scripts.php'; ?>
		

	</body>
</html>