<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<?php
	$page_title = "Beck Family Roofing | Service Areas | (215) 331-ROOF";
    $metadesc="Beck Family Roofing Rubber Roofs";

	include "includes/head.php";
?>

<body>
	
    
    
    
    <?php  include_once "header.php"; ?>
<section class="ls ms section_padding_top_100 section_padding_bottom_75 columns_padding_25">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="text-center">
								<h1>Beck Roofing Service Areas</h1>
								<div class="fw-heading">
									<h5>Beck Family Roofing Services The Entire Philadelphia Area</h5>
								</div>
							</div>
							<div class="row">

								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
										
										<h3 class="m-uppercase">Flat Roof Experts Northeast Philadelphia</h3>
										<p></p>
									</div>
								</div>

								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
										
										<h3 class="m-uppercase">Roof Repairs And Replacements In South Philadelphia</h3>
										<p></p>
									</div>
								</div>

								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
									
										<h3 class="m-uppercase">Historic Roof Specialists In Center City Philadelphia</h3>
										<p></p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
									
										<h3 class="m-uppercase">Historic And Slate Roofs In Old City Philadelphia</h3>
										<p></p>
									</div>
								</div>

								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
										
										<h3 class="m-uppercase">Roofing In West Philadelphia</h3>
										<p></p>
									</div>
								</div>

								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
									
										<h3 class="m-uppercase">Beck Roofing Is Local To Port Richman</h3>
										<p></p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
									
										<h3 class="m-uppercase">New<br>Construction Roofing In Northern Liberties</h3>
										<p></p>
									</div>
								</div>

								<div class="col-md-3 col-sm-6">
									<div class="teaser text-center with_background">
										
										<h3 class="m-uppercase">Roofing Repairs And Replacements In Kensington</h3>
										<p></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<!--	<section id="map"></section>-->

			
			<section class="ls ms section_padding_top_75 section_padding_bottom_100">
				<div class="container">


					<div class="row">
						<div class="col-sm-12 to_animate">
							<form class="contact-form columns_padding_5" method="post" action="/">


								<div>
									<p class="contact-form-name">
										<input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name">
									</p>
									<p class="contact-form-email">
										<input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Email">
									</p>
									<p class="contact-form-subject">
										<input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject">
									</p>
								</div>
								<div>

									<p class="contact-form-message">
										<textarea aria-required="true" rows="6" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
									</p>
								</div>

								<div class="row">
									<div class="col-sm-12">

										<p class="contact-form-submit text-center topmargin_30">
											<button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button round-icon-big round-icon colormain and-white">Send Message
												<i class="rt-icon2-tick-outline"></i>
											</button>
										</p>
									</div>

								</div>
							</form>
						</div>
					</div>


				</div>
			</section>


		<?php include_once "footer.php"; ?>

	<script src="js/compressed.js"></script>
	<script src="js/main.js"></script>



	<!-- Map Scripts -->

	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
		var lat;
		var lng;
		var map;
		var styles = [
		{
			"featureType": "administrative",
			"elementType": "labels.text.fill",
			"stylers": [
			{
				"color": "#444444"
			}]
		},
		{
			"featureType": "landscape",
			"elementType": "all",
			"stylers": [
			{
				"color": "#f2f2f2"
			}]
		},
		{
			"featureType": "poi",
			"elementType": "all",
			"stylers": [
			{
				"visibility": "off"
			}]
		},
		{
			"featureType": "road",
			"elementType": "all",
			"stylers": [
			{
				"saturation": -100
			},
			{
				"lightness": 45
			}]
		},
		{
			"featureType": "road.highway",
			"elementType": "all",
			"stylers": [
			{
				"visibility": "simplified"
			}]
		},
		{
			"featureType": "road.arterial",
			"elementType": "labels.icon",
			"stylers": [
			{
				"visibility": "off"
			}]
		},
		{
			"featureType": "transit",
			"elementType": "all",
			"stylers": [
			{
				"visibility": "off"
			}]
		},
		{
			"featureType": "water",
			"elementType": "all",
			"stylers": [
			{
				"color": "#46bcec"
			},
			{
				"visibility": "on"
			}]
		}];

		//type your address after "address="
		jQuery.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address=london, baker street, 221b&sensor=false', function(data)
		{
			lat = data.results[0].geometry.location.lat;
			lng = data.results[0].geometry.location.lng;
		}).complete(function()
		{
			dxmapLoadMap();
		});

		function attachSecretMessage(marker, message)
		{
			var infowindow = new google.maps.InfoWindow(
			{
				content: message
			});
			google.maps.event.addListener(marker, 'click', function()
			{
				infowindow.open(map, marker);
			});
		}

		window.dxmapLoadMap = function()
		{
			var center = new google.maps.LatLng(lat, lng);
			var settings = {
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				zoom: 16,
				draggable: false,
				scrollwheel: false,
				center: center,
				styles: styles
			};
			map = new google.maps.Map(document.getElementById('map'), settings);

			var marker = new google.maps.Marker(
			{
				position: center,
				title: 'Map title',
				map: map
			});
			marker.setTitle('Map title'.toString());
			//type your map title and description here
			attachSecretMessage(marker, '<h3>Map title</h3><p>Map HTML description</p>');
		}
	</script>

</body>

</html>