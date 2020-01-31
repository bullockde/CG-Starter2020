<footer class="footer-distributed">
 
	<div class="col-md-4 footer-left footer-left1">
  		<!--<img src="uploads/logo.png" height="75px">
		<h3>Fairmount<span>Design</span></h3>-->

		<?php 

		 $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

	    mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error($link));

	    $tquery = "SELECT * FROM blog_images WHERE  name='logo'";

	    $tres = mysqli_query( $link, $tquery);

	    $tnr = mysqli_num_rows($tres);

	    $row  = mysqli_fetch_array($tres);

	    $logo_url = $row['location'];

    

        if( isset( $logo_url ) ){
          ?>
          <img src="<?php echo $site_base . $logo_url; ?>" height="75px"><br><br>
          <?php
        }else{
          ?>
          <img src="<?php echo $site_base; ?>images/logo.png" height="75px">
          <?php
        }
        ?>




		<p class="footer-links">
			<a href="#">Home</a>
			|
			<a href="#">Blog</a>
			|
			<a href="#">About</a>
			|
			<a href="#">Contact</a>
		</p>

		<p class="footer-company-name">©2020 Fairmount Design - A GeekGroup Company</p>
	</div>

	<div class="col-md-4 footer-center footer-center1">
		<div>
			<i class="fa fa-map-marker"></i>
			  <p><span>430 Fairmount Ave - Suite C1,</span>
				Philadelphia, PA 19123</p>
		</div>

		<div>
			<i class="fa fa-phone"></i>
			<p>+1 (215) 338 - 7500</p>
		</div>
		<div>
			<i class="fa fa-envelope"></i>
			<p><a href="mailto:info@fairmountdesign.com">info@fairmount-design.com</a></p>
		</div>
	</div>
	<div class="col-md-4 footer-right footer-right1">
		<p class="footer-company-about">
			<span>About the company</span>
			Based in Philadelphia, we combine original website authoring, social media management, and search engine optimization with continued development and management of digital and on-line presence for small and mid-size companies.</p>
		<div class="footer-icons">
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-instagram"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-youtube"></i></a>
		</div>
	</div>
	<div class="clearfix"></div>
</footer>