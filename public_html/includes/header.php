<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        Menu
      </button>
      <a class="navbar-brand" href="<?php echo $admin_base; ?>"><?php echo $site_name ?></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active1"><a href="<?php echo $site_base; ?>">Home</a></li>
        <li><a href="<?php echo $site_base; ?>blog">Blog</a></li>
        <li><a href="<?php echo $site_base; ?>services">Landing Pages</a></li>
        <li><a href="<?php echo $site_base; ?>coupons.php">Coupons</a></li>
        <li><a href="<?php echo $site_base; ?>reviews.php">Reviews</a></li>
        <li><a href="<?php echo $site_base; ?>contact.php">Contact</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <!--<li><a href="<?php echo $site_base; ?>admin/plans.php">Planner</a></li>
        <li><a href="<?php echo $site_base; ?>admin/tasks.php">Tracker</a></li>-->
      
        <li><a href="<?php echo $site_base; ?>admin/settings/">Admin Login</a></li>
        <!--<li><a href="<?php echo $site_base; ?>admin/login.php?logout">Logout</a></li>-->
      </ul>
    </div>
  </div>
</nav>