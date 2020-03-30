<section id="main-content">



          <section class="wrapper">

          	<div class="container-fluid">

          			<h2>Create a New Post</h2><br>

					<div class="row">

						<div class="col-md-12">

							<form method="post" role="form" enctype="multipart/form-data">

								<div class="form-group">

									<input type="text" class="form-control" name="title" placeholder="Blog Title" required />

								</div>

								<div class="form-group">

									<div class="input-group">

										<span class="input-group-btn">

											<span class="btn btn-primary btn-file">

												Browse <input type="file" name="bimgs[]" multiple>

											</span>

										</span>

										<input type="text" class="form-control" readonly>

									</div>

								</div>

								<div class="form-group">

									<input type="text" class="form-control" name="tags" placeholder="Blog Tags (sperate with a comma)" required />

								</div>

								<div class="form-group">

									<input type="text" class="form-control" name="yturl" placeholder="Youtube Video ID" />

								</div>

								<div class="form-group">

									<textarea class="form-control bcontent" name="content"></textarea>

								</div>

								<div class="form-group">

									<label for="featured">Featured?</label>

									<select name="featured" class="form-control" required>

										<option value="False" selected>False</option>

										<option value="True">True</option>

									</select>

								</div>

								<div class="form-group">

									<label for="landing">Landing Page?</label>

									<select name="landing" class="form-control" required>

										<option value="False" selected>False</option>

										<option value="True">True</option>

									</select>

								</div>

								<div class="form-group">
									<input type="text" class="form-control" name="headline" placeholder="Landing Page Headliine .." <?php if( isset($id) ){ ?> value="<?php echo $headline; ?>" <?php } ?>/>
								</div>

								<div class="form-group">

									<textarea class="form-control" placeholder="Landing Page Excerpt .." name="excerpt"></textarea>

								</div>

								<div class="form-group coupons">

									<label for="coupon">Attach a Coupon?</label>
									<?php 

							            $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

							            
							            $query = "SELECT * FROM coupons ORDER BY id DESC";

							            
							            $result = mysqli_query($link,$query);
							            $num_rows = mysqli_num_rows($result);

							            $blog_html = "";

							            $blog_row_count = 0;
							            ?>



							        <div class="clearfix"></div>


							        <select class="form-control" name="coupon_id">
							        	<option value="0" <?php if($row['status']=="pending"){ echo ' selected'; } ?>>Select a Coupon</option>
							        <?php
							            while($row=mysqli_fetch_array($result)){
							                $img_loc = null;
							                $query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
							                $result2 = mysqli_query($link,$query2);

							                while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

							                
							                     ?> 
							                     <option value="<?php echo $row["id"]; ?>" <?php if($row["coupon_id"]==$row["id"]){ echo ' selected'; } ?>>- <?php echo $row["offer"]; ?> - <?php echo $row["title"]; ?></option>
							                    
							                    <?php

							            }

							            

							            mysqli_close($link);
							        ?>
							        </select>
								</div>

								<div class="form-group">

									<input type="submit" name="Submit" value="Save" class="btn btn-primary form-control" />

								</div>

							</form>
			<p>image size should be 945px by 616px 300dpi</p>
						</div>

					</div>

	</div>
</section>
</section>