<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">

<?php

	
    $head_title = "Contact Daniels Plumbing | Daniels Plumbing Contractors In Philadelphia | (267) 650-3418";
    $metadesc="Contact Daniels Plumbing Of Philadelphia; Your Trusted Local Plumber";

    $page_title = "Coupons";

    $relative = "";
	
    include  $relative . "src/crutchphp/config.php";
    include "includes/head.php";
?>
<style type="text/css">
    
    
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

    <div class="container ">

        <h1 class="text-center">
            <br>
            <?php echo $page_title; ?> 
            <br><br>
        </h1>


        <div class="row">
        <?php 

            $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

            if( isset($_GET['edit']) ){

                $id = $_GET['id'];
                $pguery = "SELECT * FROM coupons WHERE id = $id";

            }else{
                // page check
                $pguery = "SELECT * FROM coupons ORDER BY id DESC";
            }
            
            $pgr = mysqli_query($link,$pguery);
            $pgnr = mysqli_num_rows($pgr);
            $pcount = (int)ceil($pgnr/8);
            
            if( isset($_GET["page"]) )
            {   
                if($_GET["page"] > $pcount)
                {
                    $query = "SELECT * FROM coupons ORDER BY id DESC";
                }else{
                    $plim = (intval($_GET["page"])-1) * 8;
                    $query = "SELECT * FROM coupons ORDER BY id DESC";
                }
            }else{
                if( isset($_GET['edit']) ){

                    $id = $_GET['id'];
                    $query = "SELECT * FROM coupons WHERE id = $id";

                }else{
                    // page check
                    $query = "SELECT * FROM coupons ORDER BY id DESC ";
                }

            }
            
            $result = mysqli_query($link,$query);
            $num_rows = mysqli_num_rows($result);

            $blog_html = "";

            $blog_row_count = 0;
            ?>



        <div class="clearfix"></div>


        <?php
            while($row=mysqli_fetch_array($result)){
                $img_loc = null;
                $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
                $result2 = mysqli_query($link,$query2);

                while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

                
                     ?> 
                    <div class='col-md-4 well1'>
                        

                        <div class="clearfix"></div>       

                        <div id="coupon-<?php echo $row["id"]; ?>" class="single-sidebar">
                            <div class="single-pricing-box text-center">
                                <div class="inner">
                                    <h2><?php echo $row["title"]; ?></h2> 
                                    <h1><?php echo $row["offer"]; ?></h1>
                                    <p><?php echo $row["details"]; ?></p>
                                    <a href="#" id="print" class="hidden-print" onclick="printContent('coupon-<?php echo $row["id"]; ?>');">Click to Print</a>
                                </div>  
                            </div>    
                        </div> 
                                
                    </div>
                    
                    <?php

                    $blog_row_count++;
                    
                    if ($blog_row_count % 3 === 0) { echo "<div class='clearfix'></div>"; }

            
            }

            

            mysqli_close($link);
        ?>
        </div>
        <div class="clearfix"></div>
       
    </div>
            <div class="clearfix"></div><br><br>


    <!--*Footer*-->
    <?php
        include "includes/footer-seal.php";
    ?>
    <!--* End Footer*-->

    <?php
        include "includes/scripts-seal.php";
    ?>

</body>

</html>