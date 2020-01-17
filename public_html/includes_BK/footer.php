<?php

  include "src/crutchphp/config.php";

?>
<!--Main Footer-->
<footer class="mainfooter">

    <div class="container">
        
        <div class="row">
            
            <div class="col-md-6 col-lg-3">
                
                <div class="footercol">

                    <h4>L&A CONTRACTORS INC.</h4>
                    <div class="widget_footer widget_text">
                        <br>
                        <p>
                            We provide mass excavation service, building excavation, and demolition services through the Delaware Valley. We also rent equipment with certified operators.
                        </p>
                    
                    </div>

                </div>

            </div>

            <div class="col-md-6 col-lg-3">
                
                <div class="footercol">
                    <div class="widget_footer widget_recent_entries">
                        <h4>News</h4>
                        <div class="widget_recent_post">
                            <ul>

                                 <?php 
                                      $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

                                      mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());


                                      // page check
                                      $pguery = "SELECT * FROM blogs ORDER BY created DESC";
                                      $pgr = mysqli_query( $link, $pguery);
                                      $pgnr = mysqli_num_rows($pgr);
                                      $pcount = (int)ceil($pgnr/3);

                                      //var_dump($pgr);

                                      if($_GET["page"])
                                      { 
                                        if($_GET["page"] > $pcount)
                                        {
                                          $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 3";
                                        }else{
                                          $plim = (intval($_GET["page"])-1) * 3;
                                          $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT ".$plim." , 3";
                                        }
                                      }else{
                                        $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 3";
                                      }

                                      $result = mysqli_query( $link, $query);
                                      $num_rows = mysqli_num_rows($result);

                                      $blog_html = "";

                                      $blog_row_count = 0;
                                      while($row=mysqli_fetch_array($result)){


                                        $img_loc = null;
                                          $query2 = "SELECT * FROM blog_images WHERE blog_id='" . $row["id"] . "' LIMIT 1";
                                          $result2 = mysqli_query($link,$query2);
                                          while ($row2 = mysqli_fetch_array($result2))
                                        {
                                          $img_loc = $row2['location'];
                                        }


                                        if(strlen($row["content"]) > 3750){

                                          $pos=strpos($row["content"], ' ', 375);

                                          $bcontent = substr($row["content"],0,$pos).'...'; 

                                        }else{

                                          $bcontent = $row["content"];

                                        }


                                        
                                        ?>

                                        <li>
                                            <div class="post_data_recent">
                                                <div class="post_data"><?php echo date("F d, Y", strtotime($row["created"])); ?></div>
                                            </div>
                                            <h5 class="post_name"><a href="post-single.html"><?php echo $row["title"]; ?></a></h5>
                                        </li>




                                        <?php
                                      }
                                    ?>



                            </ul>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-6 col-lg-3">
                
                <div class="footercol widget_nav_menu">
                    <h4>Navigation</h4>
                    <ul>
						   <li class="menu-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="about.php">About</a>
                        </li>
                        <li class="menu-item">
                            <a href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>  

            </div>

            <div class="col-md-6 col-lg-3">
                
                <div class="footercol widget_text">
                    <h4>Contact Us</h4>
                    <ul class="contactlist">
                        <li class="addresscont"> 430 Fairmount Ave, Philadelphia, PA 19123</li><br class="hidden-md hidden-lg">
                        <li class="phoncont"> (215) 244-3990 </li><br class="hidden-md hidden-lg">
                        <li class="emailcont"> maryb@lacontractorsinc.com </li>
                        
                        
                    </ul>
                </div>

            </div>

        </div>


        <div class="copy_socials clearfix">
            
            <div class="stycopy">
                Copyrights 2019 - L&A CONTRACTORS INC.
            </div>

 

        </div>

    </div>

</footer><!--END Main Footer-->