<div class="text-center promo">
    <?php

            $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error());
            
            $coupon_id = $row["coupon_id"];

            $coupon_query = "SELECT * FROM coupons WHERE id='$coupon_id' LIMIT 1";

            $coupons = mysqli_query( $link, $coupon_query );

            $single_coupon = mysqli_fetch_array($coupons);

            if ( mysqli_num_rows($coupons) > 0 ) {
           
    ?>
        <div id="offer" class="single-sidebar hidden1 col-print-6">
            <div class="single-pricing-box text-center">
                <div class="inner">
                    
                    <h1><?php echo $single_coupon["offer"]; ?></h1>
                    <h2><?php echo $single_coupon["title"]; ?></h2>
                    
                    
                    <p class="d-none d-print-block"><?php echo $single_coupon["details"]; ?></p>
                

                    <small><u id="print" class="d-print-none" onclick="printContent('offer');">Print Coupon</u></small>

                    <!--<a href="#" id="print" class="d-print-none" onclick="printContent('offer');">Click to Print</a>-->
                </div>
            </div>
        </div>

    <?php } else {
        ?>
          <p class="lead"><?php echo $row["excerpt"]; ?></p>
        <?php

    } ?>
</div>