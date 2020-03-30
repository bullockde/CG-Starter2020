<section id="main-content">



          <section class="wrapper">

	<div class="container-fluid">


		<h2>Edit Post</h2><br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<input type="text" class="form-control" name="title" placeholder="Blog Title" <?php if($id){ ?> value="<?php echo $title; ?>" <?php } ?>/>
					</div>
					
					<div class="form-group">
						<div class="clearfix">
							<b>Currently Used Image</b><br />
							<?php
								$icnt = count($img_urls);
								if($icnt > 1){
									for($i=0;$i<$icnt;$i++)
									{
										echo "<div class='well col-md-4 text-center'><img src=\"".$site_base.$img_urls[$i]."\" width=\"200\" />";
										echo "<br><a href=\"".$site_base."admin/rmv_image.php?bid=".$id."&imid=".$img_ids[$i]."\" class=\"btn btn-danger\">Remove</a></div>";
									}
								}else{
									for($i=0;$i<$icnt;$i++)
									{
										echo "<img src=\"".$site_base.$img_urls[$i]."\" width=\"200\" />";
									}
								}
								
							?>
						</div><br />
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
						<input type="text" class="form-control" name="tags" placeholder="Blog Tags (sperate with a comma)" <?php if($id){ ?> value="<?php echo $tags; ?>" <?php } ?>/>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="yturl" placeholder="Youtube Video ID" <?php if($id){ ?> value="<?php echo $yturl; ?>" <?php } ?>/>
					</div>
					
					<div class="form-group">
						<textarea class="form-control bcontent" name="content"><?php if($id){ echo $bcontent; } ?></textarea>
					</div>

					<div class="form-group">
						<label for="featured">Featured?</label>
						<select name="featured" class="form-control">
							<?php if($id && $featured == false){ ?>
							<option value="False">False</option>
							<option value="True">True</option>
							<?php }else if($id && $featured == true){ ?>
							<option value="True">True</option>
							<option value="False">False</option>
							<?php }else{ ?>
							<option value="False">False</option>
							<option value="True" selected="selected">True</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="featured">Landing Page?</label>
						<select name="landing" class="form-control">
							<?php if($id && $landing == false){ ?>
							<option value="False">False</option>
							<option value="True">True</option>
							<?php }else if($id && $landing == true){ ?>
							<option value="True">True</option>
							<option value="False">False</option>
							<?php }else{ ?>
							<option value="False">False</option>
							<option value="True" selected="selected">True</option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="headline" placeholder="Landing Page Headliine .." <?php if($id){ ?> value="<?php echo $headline; ?>" <?php } ?>/>
					</div>

					<div class="form-group">

						<textarea class="form-control" placeholder="Landing Page Excerpt .." name="excerpt"><?php echo $excerpt; ?></textarea>

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
				                     <option value="<?php echo $row["id"]; ?>" <?php if($coupon_id==$row["id"]){ echo ' selected'; } ?>>- <?php echo $row["offer"]; ?> - <?php echo $row["title"]; ?></option>
				                    
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
			</div>
		</div>
	</div>
</section>
</section>