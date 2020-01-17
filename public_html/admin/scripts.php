<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>        
<script type="text/javascript" src="/js/SmoothScroll.js"></script>
<script type="text/javascript" src="/js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="/js/jquery.localScroll.min.js"></script>
<script type="text/javascript" src="/js/jquery.viewport.mini.js"></script>
<script type="text/javascript" src="/js/jquery.countTo.js"></script>
<script type="text/javascript" src="/js/jquery.appear.js"></script>
<script type="text/javascript" src="/js/jquery.sticky.js"></script>
<script type="text/javascript" src="/js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="/js/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="/js/gmap3.min.js"></script>
<script type="text/javascript" src="/js/wow.min.js"></script>
<script type="text/javascript" src="/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="/js/jquery.simple-text-rotator.min.js"></script>
<script type="text/javascript" src="/js/all.js"></script>
<script type="text/javascript" src="/js/contact-form.js"></script>
<script type="text/javascript" src="/js/jquery.ajaxchimp.min.js"></script>        
<!--[if lt IE 10]><script type="text/javascript" src="js/placeholder.js"></script><![endif]-->
<script type="text/javascript" src="/js/ddloc.js"></script>

<?php 
if($showbig){
?>
<script type="text/javascript">
$(function(){
	$(window).scroll(function(){
		if ($(window).scrollTop() > 10) {
		    $(".js-transparent").removeClass("transparent");
		    $(".main-nav, .nav-logo-wrap .logo, .mobile-nav").addClass("small-height");
		}
		else {
		    $(".js-transparent").addClass("transparent");
		    $(".main-nav, .nav-logo-wrap .logo, .mobile-nav").removeClass("small-height");
		}
	});
});
</script>
<?php
}else{
?>
<script type="text/javascript">
$(function(){
	$(".js-transparent").removeClass("transparent");
	$(".main-nav, .nav-logo-wrap .logo, .mobile-nav").addClass("small-height");
});
</script>
<?php
}
?>


