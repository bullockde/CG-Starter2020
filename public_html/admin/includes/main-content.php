<section id="main-content">



          <section class="wrapper">
            <div class="container-fluid">

              
              <!--state overview start-->
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol terques">
                              <a target="_blank" href="/admin-panel/leads.php"><i class="fa fa-user"></i></a>
                          </div>
                          <div class="value">
                            <a target="_blank" href="/admin-panel/leads.php">
                              <h1 class="count">
                                  0
                              </h1>
                            </a>
                              <p><a target="_blank" href="/admin-panel/leads.php">New Leads</a></p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol red">
                              <a target="_blank" href="/admin-panel/customers.php"><i class="fa fa-bar-chart-o"></i></a>
                          </div>
                          <div class="value">
                              <a target="_blank" href="/admin-panel/customers.php">
                                <h1 class=" count2">
                                  0
                                </h1>
                              </a>
                              <p><a target="_blank" href="/admin-panel/customers.php">New Customers</a></p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol yellow">
                              <i class="fa fa-bar-chart-o"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count3">
                                  0
                              </h1>
                              <p>Feedback Requests</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol blue">
                              <a target="_blank" href="/admin/reviews.php"><i class="fa fa-bar-chart-o"></i></a>
                          </div>
                          <div class="value">
                          <a target="_blank" href="/admin/reviews.php">    
                            <h1 class=" count4">
                                  0
                              </h1>
                          </a>
                              <p><a target="_blank" href="/admin/reviews.php">Reviews</a></p>
                          </div>
                      </section>
                  </div>
              </div>
              <!--state overview end-->
  

              <div class="clearfix"></div>




              <div class="row">






                 <div class="row">
                <div class="col-sm-12">
              <section class="card">
              <header class="card-header">
                  Recent Posts
             <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
              </header>
                  <div class="card-body ">
                      <div class="adv-table">
                          <table class="display table table-bordered  " id="hidden-table-info">


                              <thead>
                              <tr>
                                  <th>Post Title</th>
                                  <th>Post Date</th>
                                  <th class="hidden-phone">Images</th>
                                  <th class="hidden-phone">Coupon</th>
                                  <th class="hidden-phone">Options</th>
                              </tr>
                              </thead>


                              <tbody>
                    






                            <?php 
                              $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

                              mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error());

                              // page check
                              $pguery = "SELECT * FROM blogs ORDER BY created DESC";
                              $pgr = mysqli_query( $link, $pguery);
                              $pgnr = mysqli_num_rows($pgr);
                              $pcount = (int)ceil($pgnr/9);

                              //var_dump($pgr);

                              if( isset($_GET["page"]) )
                              { 
                                if($_GET["page"] > $pcount)
                                {
                                  $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 6";
                                }else{
                                  $plim = (intval($_GET["page"])-1) * 6;
                                  $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT ".$plim." , 6";
                                }
                              }else{
                                $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 6";
                              }

                              $result = mysqli_query( $link, $query);
                              $num_rows = mysqli_num_rows($result);

                              $blog_html = "";

                              $blog_row_count = 0;
                              while($row=mysqli_fetch_array($result)){
                                $img_loc = null;
                                $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
                                $result2 = mysqli_query( $link, $query2);

                                while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

                                
                                   ?> 

                                    <tr class="gradeC">
                                        <td><?php echo $row["title"]; ?></td>
                                        <td><?php echo date("F d, Y", strtotime($row["created"])); ?></td>
                                        <td class="hidden-phone"> 6 Images </td>
                                        <td class="center hidden-phone"> 10% OFF </td>
                                        <td class="center hidden-phone"> 
                                          <div class="list-inline">
                                                    
                                         <?php echo "<a href=\"" . $site_base . "admin/edit.php?id=" . $row["id"] . "\" class=\"btn btn-default btn-sm\">Edit</a>"; ?>
                                       <?php echo "<a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-danger btn-sm\">Delete</a>"; ?>
                                          </div>

                                          </td>
                                    </tr>  


                                    <div class='col-lg-12 card d-none'>
                                        
                                        <?php echo $row["title"]; ?><br><br>
                                        <div class='col-sm-6 text-center'>
                                        <?php 
                                            
                                            echo "<center><img src=\"" . $site_base . $img_loc . "\" class='img-fluid'  \></center>"; ?>
                                                    <?php
                                    
                                                $id = $row["id"];
                                              //$tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";

                                              $tquery = "SELECT * FROM blog_images WHERE blog_id='$id'";
                                          $tres = mysqli_query( $link, $tquery) or die("blog_images error: ".mysql_error());
                                          $tnr = mysqli_num_rows($tres);

                                                        //$tres = mysqli_query($conn, $tquery);
                                                    
                                                        $img_urls = array();
                                                    
                                                        $img_ids = array();
                                                    
                                                    
                                                    
                                                        while($row2=mysqli_fetch_array($tres)){
                                                    
                                                          $img_urls[] = $row2["location"];
                                                    
                                                          $img_ids[] = $row2["id"];
                                                    
                                                        }
                                                        
                                                $icnt = count($img_urls);

                                                if($icnt > 1){
                                                    
                                
                                                  for($i=1;$i<$icnt;$i++)
                                
                                                  {
                                                                        ?>
                                                                        <div class='pull-left '>
                                                                            
                                                        <img src='<?php echo $site_base.$img_urls[$i]; ?>' width='50' height='50' style='margin: 4px;' />
                                                      
                                                                            
                                                                            
                                                                        </div>
                                                  
                                                                        <?php
                                                  }
                                
                                                }else{
                                                    ?>
                                                    <br>
                                                    <a href='<?php echo $site_base . "admin/edit.php?id=" . $row["id"]; ?>' class='btn btn-default'>Add Images</a>
                                                    <br><br class='visible-xs'>
                                                   <?php
                                                }
                                            ?>
                                       
                                        </div>
                                        <?php
                                            if (!empty($row["youtube_url"]))
                                        {
                                            echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
                                        }
                                    ?>

                                    <div class="clearfix"></div><br>        
                                        
                                    </div>
                                    
                                    <?php  }  ?>



                              </tbody>
                          </table>

                      </div>
                  </div>
              </section>



              </div>
              </div>


















              </div>
            </div>
     
  
          <div class="clearfix"></div>




<div class="clearfix"></div>




      


              <div class="row">
                  <div class="col-lg-8">
                      <!--custom chart start-->
                      <div class="border-head">
                          <h3>Google Analytics</h3>
                      </div>
                      <div class="custom-bar-chart">
                          <ul class="y-axis">
                              <li><span>100</span></li>
                              <li><span>80</span></li>
                              <li><span>60</span></li>
                              <li><span>40</span></li>
                              <li><span>20</span></li>
                              <li><span>0</span></li>
                          </ul>
                          <div class="bar">
                              <div class="title">JAN</div>
                              <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top">80%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">FEB</div>
                              <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">MAR</div>
                              <div class="value tooltips" data-original-title="40%" data-toggle="tooltip" data-placement="top">40%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">APR</div>
                              <div class="value tooltips" data-original-title="55%" data-toggle="tooltip" data-placement="top">55%</div>
                          </div>
                          <div class="bar">
                              <div class="title">MAY</div>
                              <div class="value tooltips" data-original-title="20%" data-toggle="tooltip" data-placement="top">20%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">JUN</div>
                              <div class="value tooltips" data-original-title="39%" data-toggle="tooltip" data-placement="top">39%</div>
                          </div>
                          <div class="bar">
                              <div class="title">JUL</div>
                              <div class="value tooltips" data-original-title="75%" data-toggle="tooltip" data-placement="top">75%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">AUG</div>
                              <div class="value tooltips" data-original-title="45%" data-toggle="tooltip" data-placement="top">45%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">SEP</div>
                              <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">OCT</div>
                              <div class="value tooltips" data-original-title="42%" data-toggle="tooltip" data-placement="top">42%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">NOV</div>
                              <div class="value tooltips" data-original-title="60%" data-toggle="tooltip" data-placement="top">60%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">DEC</div>
                              <div class="value tooltips" data-original-title="90%" data-toggle="tooltip" data-placement="top">90%</div>
                          </div>
                      </div>
                      <!--custom chart end-->
                  </div>
                  <div class="col-lg-4">
                      <!--new earning start-->
                      <div class="card terques-chart">
                          <div class="card-body chart-texture">
                              <div class="chart">
                                  <div class="heading">
                                      <span>Friday</span>
                                      <strong>$ 57,00 | 15%</strong>
                                  </div>
                                  <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                              </div>
                          </div>
                          <div class="chart-tittle">
                              <span class="title">Google Ads</span>
                              <span class="value">
                                  <a href="#" class="active">Market</a>
                                  |
                                  <a href="#">Referal</a>
                                  |
                                  <a href="#">Online</a>
                              </span>
                          </div>
                      </div>
                      <!--new earning end-->

                      <!--total earning start-->
                      <div class="card green-chart">
                          <div class="card-body">
                              <div class="chart">
                                  <div class="heading">
                                      <span>June</span>
                                      <strong>23 Days | 65%</strong>
                                  </div>
                                  <div id="barchart"></div>
                              </div>
                          </div>
                          <div class="chart-tittle">
                              <span class="title">Google My Business</span>
                              <span class="value">$, 76,54,678</span>
                          </div>
                      </div>
                      <!--total earning end-->
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="card">
                          <div class="card-body">
                              <a href="#" class="task-thumb">
                                  <img src="img/widget-bg.jpg" alt="">
                              </a>
                              <div class="task-thumb-details">
                                  <h1><a href="#">Quick Actions</a></h1>
                                  <p>Daily Check</p>
                              </div>
                          </div>
                          <table class="table table-hover personal-task">
                              <tbody>
                                <tr>
                                    <td>
                                        <a target="_blank" href="/admin/plans.php"><i class=" fa fa-tasks"></i></a>
                                    </td>
                                    <td><a target="_blank" href="/admin/plans.php">New Task Issued</a></td>
                                    <td> <a target="_blank" href="/admin/plans.php">02</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a target="_blank" href="/admin/plans.php"><i class="fa fa-exclamation-triangle"></i></a>
                                    </td>
                                    <td><a target="_blank" href="/admin/plans.php">Task Pending</a></td>
                                    <td> <a target="_blank" href="/admin/plans.php">14</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a target="_blank" href="/admin/leads.php"><i class="fa fa-envelope"></i></a>
                                    </td>
                                    <td><a target="_blank" href="/admin/leads.php">New Leads</a></td>
                                    <td> <a target="_blank" href="/admin/leads.php">45</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a target="_blank" href="/admin/reviews.php"><i class=" fa fa-bell-o"></i></a>
                                    </td>
                                    <td><a target="_blank" href="/admin/reviews.php">New Feedback</a></td>
                                    <td> <a target="_blank" href="/admin/reviews.php">09</a></td>
                                </tr>
                              </tbody>
                          </table>
                      </section>
                      <!--user info table end-->
                  </div>
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="card">
                          <div class="card-body progress-card">
                              <div class="task-progress">
                                  <h1>Customer And Lead Remarketing</h1>
                                  <p>Growth Opportunity</p>
                              </div>
                              <div class="task-option">
                                  <select class="styled">
                                      <option>Customer Offers</option>
                                      <option>Customer Feedback</option>
                                      <option>Lead Offers</option>
                                  </select>
                              </div>
                          </div>
                          <table class="table table-hover personal-task">
                              <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>
                                      Customer Offer 1
                                  </td>
                                  <td>
                                      <span class="badge badge-pill badge-danger">75%</span>
                                  </td>
                                  <td>
                                    <div id="work-progress1"></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>
                                      Lead Remarketing Offer 1
                                  </td>
                                  <td>
                                      <span class="badge badge-pill badge-success">43%</span>
                                  </td>
                                  <td>
                                      <div id="work-progress2"></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>
                                      Feedback Request 1
                                  </td>
                                  <td>
                                      <span class="badge badge-pill badge-info">67%</span>
                                  </td>
                                  <td>
                                      <div id="work-progress3"></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>4</td>
                                  <td>
                                      Job Post 1
                                  </td>
                                  <td>
                                      <span class="badge badge-pill badge-warning">30%</span>
                                  </td>
                                  <td>
                                      <div id="work-progress4"></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>5</td>
                                  <td>
                                      Landing Page 1
                                  </td>
                                  <td>
                                      <span class="badge badge-pill badge-primary">15%</span>
                                  </td>
                                  <td>
                                      <div id="work-progress5"></div>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                      </section>
                      <!--work progress end-->
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-8">
                      <!--timeline start-->
                     
                      <!--timeline end-->
                  </div>
                  <div class="col-lg-4">
                  
             
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-8">
                      <!--latest product info start-->
                      <section class="card post-wrap pro-box">
                          <aside>
                              <div class="post-info">
                                  <span class="arrow-pro right"></span>
                                  <div class="card-body">
                                      <h1 class="mb-3"><strong>MailChimp</strong> <br>  Visit Your Account</h1>
                                      <div class="desk yellow">
                                          <h3>Mailchimp And Social MediaCampaigns</h3>
                                         
                                      </div>
                        <footer class="social-footer">
                                          <ul>
                                              <li>
                                                  <a href="#">
                                                    <i class="fa fa-facebook"></i>
                                                  </a>
                                              </li>
                                              <li class="active">
                                                  <a href="#">
                                                      <i class="fa fa-twitter"></i>
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="#">
                                                      <i class="fa fa-youtube"></i>
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="#">
                                                      <i class="fa fa-instagram"></i>
                                                  </a>
                                              </li>
                                          </ul>
                                      </footer>
                                  
                                  </div>
                              </div>
                          </aside>
                 
                      </section>
                      <!--latest product info end-->
                      <!--twitter feedback start-->
             
                      <!--twitter feedback end-->
                  </div>
          
              </div>

          </section>
      </section>