<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">

<?php

    $head_title = "Commercial Plumbing Services | Daniels Plumbing Contractors In Philadelphia | (267) 650-3418";
    $metadesc="Schedule A Free Estimate From Daniels Plumbing In Philadelphia | Get a Plumbing Service Quote!";

    include "src/crutchphp/config.php";
    include "includes/head.php";




    $type = $_GET['type'];
    $id = $_GET['id'];

    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ". mysqli_error($link));

    $query = "SELECT * FROM $type WHERE id = $id";

    $result = mysqli_query($link,$query);

    $row = mysqli_fetch_array($result);

    //vardump( $row );

    //echo "Hello";

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

    <!-- breadcrumb -->
    <div class="breadcrumb-main ">
        <div class="container hidden">
            <ul class="breadcrumb">
                <li><a href="/index.php"><i class="fa fa-home"></i></a></li>
                <li class="active">Quote</li>
            </ul>
        </div>
    </div><!-- End breadcrumb -->
            
    <!--* Contact*-->
    <section id="mainwrapper" class="">

        <div class="container">
           
            

            <div class="contact-inner">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="text-center">
                            <h1 class="title">New Work Request!</h1>
                            <br>
                            <h3><?php echo $row[title]; ?></h3>

                                <br>
                                    <h3>Details:</h3>
                                <br>
                            
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
    </section>
    <!--* End Contact*-->

    <div id="bottomwrapper"></div>
    <br>

    <!--*Footer*-->
    <?php
        include "includes/footer.php";
    ?>
    <!--* End Footer*-->

    <!-- back to top -->
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="" data-placement="left">
        <span class="fa fa-arrow-up"></span>
    </a>

    <?php
        include "includes/scripts.php";
    ?>
    <!-- google map Jquery -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOQOjdzFiOZfDKD0V5WWY5xIHjBBy3fOo&amp;callback=initMap" async defer></script>

</body>

</html>