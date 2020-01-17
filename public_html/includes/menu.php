<?php 

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$root = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/'; 

$root = "http://198.57.235.122/~bencardino/";
//if (false !== strpos($url,'home')) {

?>
<div class="container">

	<ul class="main-menu hidden1">
		<li><a href="<? echo $root; ?>" <?php if(preg_match('/http\:\/\/www\.bencardino\.com\/$/', $url) || preg_match('/http\:\/\/bencardino\.com\/$/', $url)){echo 'id="current"';} ?>>HOME</a></li>
	<!--	<li><a href="<? echo $root; ?>louis-a-bencardino-excavating/about-us" <?php if (false !== strpos($url,'about-us')) {echo 'id="current"';} ?>>About Us</a></li>-->
		
	    	<li><a href="<? echo $root; ?>louis-a-bencardino-excavating/about-us" <?php if (false !== strpos($url,'about-us') || false !== strpos($url,'louis-a-bencardino-excavating/about-us')) {echo 'id="current"';} ?>>ABOUT</a>
	        
	        
	        		<ul>
	                
	                <li>
					<a href="<? echo $root; ?>louis-a-bencardino-excavating/about-us">About Bencardino</a>
				</li>
				<li>
					<a href="<? echo $root; ?>careers/">Careers At Bencardino</a>
				</li>

			</ul>
	        
	            
	          </li>
		<li><a href="<? echo $root; ?>capabilities" <?php if (false !== strpos($url,'capa') || false !== strpos($url,'site-work') || false !== strpos($url,'water-storm-sanitary') || false !== strpos($url,'demolition-land-clearing') || false !== strpos($url,'on-site-crushing') || false !== strpos($url,'concrete-paving-curbing') || false !== strpos($url,'mechanical-electrical') || false !== strpos($url,'rentals-emergency')) {echo 'id="current"';} ?>>CAPABILITIES</a>
			<ul>
				<li>
					<a href="<? echo $root; ?>site-work/">Sitework Excavation</a>
				</li>
				<li>
					<a href="<? echo $root; ?>water-storm-sanitary/">Storm And Sanitary Excavation</a>
				</li>
				<li>
					<a href="<? echo $root; ?>demolition-land-clearing/">Demolition And Land Clearing</a>
				</li>
				<li>
					<a href="<? echo $root; ?>on-site-crushing/">On Site Crushing</a>
				</li>
				<li>
					<a href="<? echo $root; ?>concrete-paving-curbing/">Concrete And Paving</a>
				</li>
				<li>
					<a href="<? echo $root; ?>mechanical-electrical/">Mechanical And Electrical Excavation</a>
				</li>
				<li>
					<a href="<? echo $root; ?>rentals-emergency/">Emergency Services</a>
				</li>
			</ul>
		</li>
		<li><a href="<? echo $root; ?>louis-a-bencardino-excavating-projects/" <?php if (false !== strpos($url,'louis-a-bencardino-excavating-projects') || false !== strpos($url, 'louis-a-bencardino-excavating-completed-projects')) {echo 'id="current"';} ?>>PROJECTS</a>
			<ul>
				<li>
					<a href="<? echo $root; ?>louis-a-bencardino-excavating-projects/">Recent</a>
				</li>
				<li>
					<a href="<? echo $root; ?>louis-a-bencardino-excavating-completed-projects/">Completed</a>
				</li>
			</ul>
		</li>
	<li><a href="<? echo $root; ?>latest-dirt" <?php if (false !== strpos($url,'newsletter') || false !== strpos($url,'latest-dirt')) {echo 'id="current"';} ?>>LATEST DIRT</a>
		<ul>
	    <li><a href="<? echo $root; ?>latest-dirt">Latest Dirt Online</a></li>
		<li><a href="<? echo $root; ?>newsletter">Newsletter In PDF Format</a></li>

	</ul>
	</li>
	<li><a href="<? echo $root; ?>careers/" <?php if (false !== strpos($url,'careers/')) {echo 'id="current"';} ?>>CAREERS</a></li>
    <li><a href="<? echo $root; ?>louis-a-bencardino-excavating/contact-us/" <?php if (false !== strpos($url,'louis-a-bencardino-excavating/contact-us/')) {echo 'id="current"';} ?>>CONTACT</a></li>
     <li><a href="<? echo $root; ?>admin" <?php if (false !== strpos($url,'admin')) {echo 'id="current"';} ?>>LOGIN</a></li>
</ul>


</div>
<!-- main navigation ends-->
<nav class="top-search hidden">
	<!-- search starts-->
<!--	<form action="<? echo $root; ?>search" method="get">
		<button class="search-btn"></button>
		<input class="search-field" type="text" onBlur="if(this.value=='')this.value='Search';" onFocus="if(this.value=='Search')this.value='';" value="Search" name="q"/>
	</form>-->
</nav>

<div class="menu pull-right"><span class="menu" onclick="openNav()">&#9776; </span></div>

<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    
  </div>
</div>


<script>
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
</script>
