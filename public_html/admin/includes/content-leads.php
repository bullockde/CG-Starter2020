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

    
              <h2>
                Leads
                <a href="<?php echo $site_base; ?>admin/archives.php" class="pull-right btn btn-default" >Go to Archives >></a>
              </h2><br>
              <?php 
                

                // page check
                $pguery = "SELECT * FROM leads WHERE deleted = 0 ORDER BY id DESC";
                $pgr = mysqli_query($link,$pguery);
                $pgnr = mysqli_num_rows($pgr);
                $pcount = (int)ceil($pgnr/8);

                if( isset($_GET["page"]) )
                { 
                  if($_GET["page"] > $pcount)
                  {
                    $query = "SELECT * FROM leads WHERE deleted = 0 ORDER BY id DESC LIMIT 0 , 8";
                  }else{
                    $plim = (intval($_GET["page"])-1) * 8;
                    $query = "SELECT * FROM leads WHERE deleted = 0 ORDER BY id DESC LIMIT ".$plim." , 8";
                  }
                }else{
                  $query = "SELECT * FROM leads WHERE deleted = 0 ORDER BY id DESC LIMIT 0 , 8";
                }

                $result = mysqli_query($link,$query);
                $num_rows = mysqli_num_rows($result);

                $blog_html = "";

                $blog_row_count = 0;
                ?>
                <div class="card">
                <div class="col-lg-12 hidden-xs hidden-sm hidden-md card-body">
                  <div class="row">
                  <div class="col-lg-1">
                        <b>Name:</b>
                      </div>
                      <div class="col-lg-1">
                        <b>Phone:</b>
                        
                      </div>
                      <div class="col-lg-2">
                        <b>Email:</b>
                        
                      </div>
                      
                      <div class="col-lg-3">
                        <b>Address:</b>
                        
                      </div>
                      <div class="col-lg-3">
                        <b>Message:</b>
                        
                      </div>
                      <div class="col-lg-1">
                        <b>Status:</b>
                        
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                  </div>


                    <form method="post" enctype='multipart/form-data'>
                    <div class="card">

                    <div class='col-lg-12 card-body'>
                      <div class="row">
                        <div class="col-lg-1 col-xs-6">
                          <input type='text' name='name' placeholder="Name" style="width: 100%;" />
                        </div>
                        <div class="col-lg-1 col-xs-6">
                          <input type='text' name='phone' placeholder="Phone" style="width: 100%;" />
                        </div>
                        <div class="col-lg-2">
                          <input type='text' name='email' placeholder="Email" style="width: 100%;" />
                        </div>
                        <div class="col-lg-3">
                          <input type='text' name='address' placeholder="Address"  />
                          <input type='text' name='city' placeholder="City"  />
                          <input type='text' name='state' placeholder="State"  />
                          <input type='text' name='zip' placeholder="Zip"  />
                        </div>
                        <div class="col-lg-3">
                          <textarea name='message' placeholder="Message" style="width: 100%;"></textarea>
                        </div>
                        <div class="col-lg-2">
                      <textarea name="notes" placeholder="Enter Notes .." style="width: 100%;"></textarea><br>
                      <input type='submit' value='Add Lead' name='new_lead' class='btn btn-block btn-success' >
                        </div>

                        <div class="clearfix"></div><hr>


                        <div class="row d-none">
                                              
                                  <div class="col-2">
                                      
                                      <select name="window_count" class="form-control">
                                          <option># of Windows</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10+</option>
                                      </select>
                                  </div>

                                  <div class="col-2">
                                    <select name="window_type" class="form-control">
                                        <option>Type / Style</option>
                                        <option>Double Hung</option>
                                        <option>2 Section Slider</option>
                                        <option>3 Section Slider</option>
                                        <option>Casement</option>
                                        <option>2 Section Casement</option>
                                        <option>3 Section Casement</option>
                                        <option>Picture Window</option>
                                        <option>Awning</option>
                                        <option>Hopper</option>
                                        <option>Bay</option>
                                        <option>Bow</option>
                                        <option>Garden Window</option>
                                        <option>Other</option>
                                    </select>


                                  </div>
                                  <div class="col-2">   

                                    <select name="window_material" class="form-control">
                                        <option>Window Material</option>
                               
                                        <option>Ideal Vinyl Windows</option>
                                        <option>Pella Impervia Fiberglass Windows</option>
                                        <option>Pella Architect Wood Windows Clad with Aluminum</option>
                                        <option>Trimline Wood Windows Clad with Aluminum</option>
                                        <option>Provia Storm Windows</option>
                                        <option>Not Sure</option>
                                  

                                    </select>


                                  </div>

                                  <div class="col-2">

                                    <select name="window_interior" class="form-control">
                                        <option>Interior Color</option>
                                        
                                      
                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Brown (Impervia Only)</option>
                                        <option>Bronze (Impervia Only)</option>
                                        <option>Gray (Impervia Only)</option>
                                        <option>Black (Impervia Only)</option>
                                        <option>Wood</option>
                                        <option>Storm Window Color</option>
                                    

                                    </select>

                                  </div>

                                  <div class="col-2">   

                                    <select name="window_exterior" class="form-control">
                                        <option>Exterior Color</option>

                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Clay</option>
                                        <option>Brown</option>
                                        <option>Bronze</option>
                                        <option>Gray (Fiberglass or Wood)</option>
                                        <option>Black (Fiberglass or Wood)</option>
                                        <option>Storm Window Color</option>
                                        <option>Other</option>
                              
                                    </select>

                                </div>
                               
                              </div>
                              <hr>
                              <div class="row d-none">
                      
                                  <div class="col-2">
                                      
                                      <select name="door_count" class="form-control">
                                          <option># of Doors</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10+</option>
                                      </select>
                                      
                                  </div>




                                  <div class="col-2">
                                     <select name="doors_type" class="form-control">
                                        <option>Type / Style</option>
                                        <option>Entry Door</option>
                                        <option>Entry Door with 1 Sidelite</option>
                                        <option>Entry Door with 2 Sidelites</option>
                                        <option>Entry Door with Transom</option>
                                        <option>Entry Door with 1 Sidelite and Transom</option>
                                        <option>Entry Door with 2 Sidelites and Transom</option>
                                        <option>French Door</option>
                                        <option>French Door with Transom</option>
                                        <option>Atrium Door</option>
                                        <option>Atrium Door with Transom</option>
                                    </select>

                                  </div>    
                                  <div class="col-2">
                                    <select name="door_material" class="form-control">
                                        <option>Door Material</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10+</option>
                                    </select>


                                  </div> 
                                  <div class="col-2">
                                    <select name="door_interior" class="form-control">
                                        <option>Interior Color</option>
                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Brown</option>
                                        <option>Bronze</option>
                                        <option>Gray</option>
                                        <option>Black</option>
                                        <option>Wood</option>
                                      
                                    </select>

                                  </div>    

                                  <div class="col-2">
                                    <select name="door_exterior" class="form-control">
                                        <option>Exterior Color</option>
                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Clay</option>
                                        <option>Brown</option>
                                        <option>Bronze</option>
                                        <option>Gray (Fiberglass or Wood)</option>
                                        <option>Black (Fiberglass or Wood)</option>
                                        <option>Other</option>
                                    </select>
                                </div>


                              </div>


                    </div>
                    </div>
                    </div>

                </form>
              <div class="clearfix"></div>

              <?php
                while($row=mysqli_fetch_array($result)){
                  $img_loc = null;
                  $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
                  $result2 = mysqli_query($link,$query2);



                  

                  while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

                  
                     ?> 

                     <div class="card">
                       

                     
                      <div class='col-lg-12 card-body'>
                        <div class="row">

                          <div class="col-lg-1 col-xs-6">
                            <!-- -->
                              <b><?php echo $row["id"]; ?></b> - <?php echo $row["name"]; ?>
                              <br>
                              <br class="hidden-lg">
                          </div>
                          <div class="col-lg-1 col-xs-6">
                            <?php echo $row["phone"]; ?>
                            <br>
                            <br class="hidden-lg">
                          </div>
                          <div class="col-lg-2">
                            <?php echo $row["email"]; ?>
                            <br>
                            <br class="hidden-lg">
                          </div>
                          
                          <div class="col-lg-3">
                            <?php echo $row["address"]; ?>
                            , <?php echo $row["city"]; ?>, <?php echo $row["state"]; ?> <?php echo $row["zip"]; ?>
                            <br>
                            <br class="hidden-lg">
                          </div>
                          <div class="col-lg-3">
                            <!--<b>Appointment:</b> <?php echo $row["appt_date"]; ?> - <?php echo $row["appt_time"]; ?>
                            <br>-->
                            <b>From:</b> <?php echo $row["form"]; ?><br>
                            <b><?php echo date("m/d/y g:ia", strtotime($row["created"])); ?></b> - <?php echo $row["message"]; ?>
                            <br>
                            <br class="hidden-lg">

                          </div>
                          <div id="notes<?php echo $row["id"]; ?>" class="col-lg-2">
                            


                        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

                        <script type="text/javascript">





                          //$('#editNotes > textarea').html($('').html().replace(/\n/g, "<br />"));
                          var $jid = "<?php $id = $row['id']; echo $id; ?>";


                          function dump(obj) {
                              var out = '';
                              for (var i in obj) {
                                  out += i + ": " + obj[i] + "\n";
                              }

                              alert(out);

                              // or, if you wanted to avoid alerts...

                              var pre = document.createElement('pre');
                              pre.innerHTML = out;
                              document.body.appendChild(pre)
                          }

                      
                          function myFunction( $id ) {
                            
                            var str1 = 'myDIV';
                            var str2 = $id;
                            
                            var editID = str1.concat(str2);


                            var str3 = 'myNOTES';
                            var str4 = $id;
                            
                            var notesID = str3.concat(str4);

                            
                              var x = document.getElementById(editID);

                              var y = document.getElementById(notesID);



                              if (x.style.display === "none") {
                                x.style.display = "block";
                                y.style.display = "none";
                              } else {
                                x.style.display = "none";
                                y.style.display = "block";
                              }
                            }



                        </script>
                            <!--<button class="btn btn-sm btn-default pull-right" onclick="showhide( $jid )">Click Me</button>-->
                            <button class="btn btn-sm btn-default pull-right" onclick="myFunction( <?php echo $row["id"]; ?> )">Edit Notes</button>
                            <b>Updated: </b><?php echo date("m/d/y g:ia", strtotime($row["modified"])); ?>
                            <form method="post">

                              <?php $oldNotes = $row["notes"]; ?>

                              <div id="myNOTES<?php echo $id; ?>" style="display:block;">
                                <?php echo nl2br($oldNotes); ?><br>
                              </div>
                              <!--<div id="editNotes" style="display:block;">
                                <textarea name="oldnotes" placeholder="Enter Notes .."><?php echo $oldNotes; ?></textarea><br>
                              </div>-->

                              <div id="myDIV<?php echo $id; ?>" style="display:none;">
                              <textarea id="NotesArea<?php echo $id; ?>" name="old_notes" placeholder="Enter Notes .." style="width: 100%;height: 150px;"><?php echo $oldNotes; ?></textarea><br>

                                CID: <input type="text" name="customer_id" value="<?php echo $row['customer_id']; ?>"><br>
                          </div>

                          <!--
                          <div id="editNotes<?php echo $id; ?>" style="display:none;" >
                              <textarea name="old_notes" placeholder="Enter Notes .." style="width: 100%;"><?php echo $oldNotes; ?></textarea><br>
                          </div>

                              -->
                              <textarea name="notes" placeholder="Enter Notes .." onload="textAreaAdjust(this)"></textarea><br>
                              <select name="status">
                                <option value="0" <?php if($row['status']=="0"){ echo ' selected'; } ?>>New Lead</option>
                                <option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>------</option>

                                <option value="Pending" <?php if($row['status']=="Pending"){ echo ' selected'; } ?>>Pending</option>
                                <option value="Contacted" <?php if($row['status']=="Contacted"){ echo ' selected'; } ?>>Contacted</option>
                                <option value="Follow Up" <?php if($row['status']=="Follow Up"){ echo ' selected'; } ?>>Follow Up</option>

                                <option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>------</option>
                                <option value="Scheduled" <?php if($row['status']=="Scheduled"){ echo ' selected'; } ?>>Scheduled</option>

                                <option value="Not Interested" <?php if($row['status']=="Not Interested"){ echo ' selected'; } ?>>Not Interested</option>
                                <!--<option value="In Progess" <?php if($row['status']=="In Progess"){ echo ' selected'; } ?>>In Progess</option>
                                <option value="Completed!" <?php if($row['status']=="Completed!"){ echo ' selected'; } ?>>Completed!</option>-->
                                <option value="none" <?php if($row['status']=="none"){ echo ' selected'; } ?>>------</option>
                                <option value="Clear Notes" <?php if($row['status']=="Clear Notes"){ echo ' selected'; } ?>>Clear Notes</option>
                              </select>
                              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                              <input type="submit" name="Update" value="Update">
                            </form>

                            <br>

                            
                          </div>




                          <div class="clearfix"></div><hr>


                        <div class="row d-none">
                                              
                                  <div class="col-2">
                                      
                                      <select name="window_count" class="form-control">
                                          <option># of Windows</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10+</option>
                                      </select>
                                  </div>

                                  <div class="col-2">
                                    <select name="window_type" class="form-control">
                                        <option>Type / Style</option>
                                        <option>Double Hung</option>
                                        <option>2 Section Slider</option>
                                        <option>3 Section Slider</option>
                                        <option>Casement</option>
                                        <option>2 Section Casement</option>
                                        <option>3 Section Casement</option>
                                        <option>Picture Window</option>
                                        <option>Awning</option>
                                        <option>Hopper</option>
                                        <option>Bay</option>
                                        <option>Bow</option>
                                        <option>Garden Window</option>
                                        <option>Other</option>
                                    </select>


                                  </div>
                                  <div class="col-2">   

                                    <select name="window_material" class="form-control">
                                        <option>Window Material</option>
                               
                                        <option>Ideal Vinyl Windows</option>
                                        <option>Pella Impervia Fiberglass Windows</option>
                                        <option>Pella Architect Wood Windows Clad with Aluminum</option>
                                        <option>Trimline Wood Windows Clad with Aluminum</option>
                                        <option>Provia Storm Windows</option>
                                        <option>Not Sure</option>
                                  

                                    </select>


                                  </div>

                                  <div class="col-2">

                                    <select name="window_interior" class="form-control">
                                        <option>Interior Color</option>
                                        
                                      
                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Brown (Impervia Only)</option>
                                        <option>Bronze (Impervia Only)</option>
                                        <option>Gray (Impervia Only)</option>
                                        <option>Black (Impervia Only)</option>
                                        <option>Wood</option>
                                        <option>Storm Window Color</option>
                                    

                                    </select>

                                  </div>

                                  <div class="col-2">   

                                    <select name="window_exterior" class="form-control">
                                        <option>Exterior Color</option>

                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Clay</option>
                                        <option>Brown</option>
                                        <option>Bronze</option>
                                        <option>Gray (Fiberglass or Wood)</option>
                                        <option>Black (Fiberglass or Wood)</option>
                                        <option>Storm Window Color</option>
                                        <option>Other</option>
                              
                                    </select>

                                </div>
                               
                              </div>
                              <hr>
                              <div class="row d-none">
                      
                                  <div class="col-2">
                                      
                                      <select name="door_count" class="form-control">
                                          <option># of Doors</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10+</option>
                                      </select>
                                      
                                  </div>




                                  <div class="col-2">
                                     <select name="doors_type" class="form-control">
                                        <option>Type / Style</option>
                                        <option>Entry Door</option>
                                        <option>Entry Door with 1 Sidelite</option>
                                        <option>Entry Door with 2 Sidelites</option>
                                        <option>Entry Door with Transom</option>
                                        <option>Entry Door with 1 Sidelite and Transom</option>
                                        <option>Entry Door with 2 Sidelites and Transom</option>
                                        <option>French Door</option>
                                        <option>French Door with Transom</option>
                                        <option>Atrium Door</option>
                                        <option>Atrium Door with Transom</option>
                                    </select>

                                  </div>    
                                  <div class="col-2">
                                    <select name="door_material" class="form-control">
                                        <option>Door Material</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10+</option>
                                    </select>


                                  </div> 
                                  <div class="col-2">
                                    <select name="door_interior" class="form-control">
                                        <option>Interior Color</option>
                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Brown</option>
                                        <option>Bronze</option>
                                        <option>Gray</option>
                                        <option>Black</option>
                                        <option>Wood</option>
                                      
                                    </select>

                                  </div>    

                                  <div class="col-2">
                                    <select name="door_exterior" class="form-control">
                                        <option>Exterior Color</option>
                                        <option>White</option>
                                        <option>Almond/Beige</option>
                                        <option>Clay</option>
                                        <option>Brown</option>
                                        <option>Bronze</option>
                                        <option>Gray (Fiberglass or Wood)</option>
                                        <option>Black (Fiberglass or Wood)</option>
                                        <option>Other</option>
                                    </select>
                                </div>


                              </div>
                              <div class="clearfix"></div><hr>

                          
                          <div class="col-lg-2 hidden1">
                            <!--
                            <?php echo "<p>Created: <b><br>" . date("m-d-Y", strtotime($row["created"])) . "</b><br />Modified: <b><br>" . date("m-d-Y", strtotime($row["modified"])) . "</b></p><br />"; ?>
                          -->
                            <!--<a href="<?php echo $site_base . "admin/edit.php?id=" . $row["id"]; ?>" class="btn btn-default btn-block">Edit</a>-->
                            

                            <a href="<?php echo $site_base . "admin/archive.php?type=leads&id=" . $row["id"]; ?>" class="btn btn-default btn-block">Archive</a>

                          </div>

                          
                          <div class="col-lg-10 col-xs-6">
                            
                              <?php
                              if ($row['customer_id'] != 0) {
                                ?>
                                
                                <a href="/admin/customers.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-warning pull-right">View Customer >></a>
                                <?php
                              }
                             ?>

                          
                          
                          </div>
                        
                          <div class="clearfix"></div>
                          
                         
                          <?php
                              if (!empty($row["youtube_url"]))
                          {
                              echo '<div class="col-sm-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
                          }
                      ?>

                      <div class="clearfix"></div>      
                
                      </div>

                      </div></div>
                      
                      <?php

                    if ($blog_row_count % 10 === 0 && $blog_row_count !== 0)
                      {
                      $blog_html.= "</div><div class=\"row\">";
                      }
                      else
                    if ($blog_row_count == 0)
                      {
                      $blog_html.= "<div class=\"row\">";
                      }

                    $blog_html.= "<div class=\"col-md-4\"><div class=\"row\">";
                    if (!empty($row["youtube_url"]) || isset($img_loc))
                      {
                      $blog_html.= "<div class=\"col-md-6\">";
                      }
                      else
                      {
                      $blog_html.= "<div class=\"col-md-12\">";
                      }


                    $title = isset($row["title"]) ? $row["title"] : "";
                              
                    $blog_html.= "<h1>" . $title . "</h1><p>Created: <b>" . $row["created"] . "</b><br />Modified: <b>" . $row["modified"] . "</b></p><br />";
                    $blog_html.= "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";
                    $blog_html.= "<li><a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Delete</a></li>";

                    $featured = isset($row["featured"]) ? $row["featured"] : "";

                    if ($featured == true)
                      {
                      $blog_html.= "<li><b>Featured</b></li></ul></div>";
                      }
                      else
                      {
                      $blog_html.= "</ul></div>";
                      }

                    if (!empty($row["youtube_url"]))
                      {
                      $blog_html.= '<div class="col-md-6"><iframe src="https://www.youtube.com/embed/' . $row["youtube_url"] . '?rel=0&amp;controls=0" style="width: 100%;" frameborder="0" allowfullscreen></iframe></div>';
                      }
                      else
                    if (isset($img_loc))
                      {
                      $blog_html.= "<div class=\"col-md-6\"><img src=\"" . $site_base . $img_loc . "\" style=\"width: 100%; height: 100%;\" \></div>";
                      }

                    $blog_html.= "</div></div>";
                    $blog_row_count++;

                    if ($blog_row_count % 10 === 0) { echo "<div class='clearfix'></div>"; }

                
                }

                

                mysqli_close($link);
              ?>

              <div class="clearfix"></div>
              <div class="col-sm-12">
                <ul class="pagination">
                  <?php 
                    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error());

                    mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error());
                    
                    $query = "SELECT * FROM leads WHERE deleted = 0 ORDER BY id DESC";

                    if( isset($_GET["page"]) )
                    {
                      $pg = $_GET["page"];
                    }else{
                      $pg = 1;
                    }

                    $result = mysqli_query($link,$query);
                    $num_rows = mysqli_num_rows($result);

                    $plinks = "";

                    if($num_rows > 0)
                    {
                      $pcount = (int)ceil($num_rows/8);
                      
                      if($pg > $pcount){ $pg = 1; }

                      for($i = 1; $i <= $pcount; $i++)
                      {
                        if($i == $pg){
                          $plinks .= "<li class=\"active\"><a href=\"?page=".$i."\">".$i."</a></li>";
                        }else{
                          $plinks .= "<li><a href=\"?page=".$i."\">".$i."</a></li>";
                        }
                      }
                    }

                    echo $plinks;

                  ?>
                </ul>
              </div>
            </div>


          </section>
      </section>