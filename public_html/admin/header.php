<nav class="navbar navbar-default">
		<div class="container-fluid">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="<?php echo $site_base; ?>"><?php echo $admin_name ?></a>
		  </div>
		  <div id="navbar" class="navbar-collapse collapse">
		    <ul class="nav navbar-nav">
		      <li class="active1"><a href="<?php echo $site_base; ?>admin/">Home</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/new.php">New Post</a></li>
          <li><a href="<?php echo $site_base; ?>admin/coupons.php">Coupons</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/leads.php">Leads</a></li>
		      
		      <li><a href="<?php echo $site_base; ?>admin/customers.php">Customers</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/reviews.php">Reviews</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/boards.php" class="hidden">Video Boards</a></li>
      
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo $site_base; ?>admin/emailer">Emails</a></li>
		    	<li><a href="<?php echo $site_base; ?>admin/plans.php">Planner</a></li>
		    	<li><a href="<?php echo $site_base; ?>admin/tasks.php">Tracker</a></li>
		    
		    	<li><a href="<?php echo $site_base; ?>admin/settings/">Admin Settings</a></li>
		      <li><a href="<?php echo $site_base; ?>admin/login.php?logout">Logout</a></li>
		    </ul>
		  </div>
		</div>
	</nav>



