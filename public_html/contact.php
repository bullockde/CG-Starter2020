<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">

<?php

	
    $head_title = "Contact Daniels Plumbing | Daniels Plumbing Contractors In Philadelphia | (267) 650-3418";
    $metadesc="Contact Daniels Plumbing Of Philadelphia; Your Trusted Local Plumber";

    $page_title = "Contact";
	
    include "src/crutchphp/config.php";
    include "includes/head.php";
?>

<body class="page">
    <!--PRELOADER-->
    <div class="preloader"><div class="spinner"></div></div>

    <!--*Header*-->
    <div class="worker">
        <?php
            include "includes/header.php";
        ?>
    </div>
    <!--* End Header*-->

    <!-- pagebanner 
    <section id="pagebanner">
        <div class="page-title">
            <h2 class="white text-center">CONTACT DANIELS PLUMBING</h2>
        </div>
    </section>-->
    <!-- End Pagebanner -->

    <!-- breadcrumb 
    <div class="breadcrumb-main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i></a></li>
                <li class="active">Contact Daniels Plumbing</li>
            </ul>
        </div>
    </div>--><!-- End breadcrumb -->
            
            <!--* Contact*-->
    <section id="mainwrapper" class="">

        <div class="container">

            <h1>
                <?php echo $page_title; ?>
            </h1>


            <!-- Contact Us Map -->   
            <div class="map mar-bottom-30">
                <!--<div id="map" style="height: 300px; width: 100%;"></div>-->

                <img src="<?php echo $site_base; ?>images/reilly-map.PNG" class="img-responsive">
                <br>
            </div>
            
            <div class="contact-inner1">
                <div class="row1">
                    <div class="col-md-8">
                        <br>
                        <?php include "includes/contact_form.php"; ?>

                    </div>
                    <div class="col-md-4">
                        <div class="contact-info">
                            <h3>Company Contact Information</h3>
                            <p class="mar-bottom-20">Company responds promptly and can be out as soon as the next day to examine your plumbing needs and provide an estimate.</p>
                            <ul>
                                <li><i class="fa fa-map-marker"></i> 123 Somewhere Dr.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Philadelphia, PA 19135</li>
                                <li><i class="fa fa-phone"></i> (267) 555-5555</li>
                                <li><i class="fa fa-envelope"></i> info@somwhere.com</li>
                                <li><i class="fa fa-globe"></i> www.something.com</li>
                            </ul>
                        </div>
                    </div>
                </div>    
            </div>    
    </section>
    <!--* End Contact*-->

    <div id="bottomwrapper"></div>


    <!--*Footer*-->
    <?php
        include "includes/footer.php";
    ?>
    <!--* End Footer*-->

    <!-- back to top 
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="" data-placement="left">
        <span class="fa fa-arrow-up"></span>
    </a>
-->
    <?php
        include "includes/scripts.php";
    ?>
    <!-- google map Jquery -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOQOjdzFiOZfDKD0V5WWY5xIHjBBy3fOo&amp;callback=initMap" async defer></script>

    <!-- Invisible Recaptcha
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    -->
</body>

</html>