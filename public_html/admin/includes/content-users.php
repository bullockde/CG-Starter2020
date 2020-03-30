<section id="main-content">



          <section class="wrapper">
          	<div class="container-fluid">

		<h1>Add Users:</h1>



		<div class="col-md-4 offset-md-4">
			<div class="card">
				<div class="card-body">
	    	<div class="text-center">


	    		<?php 

	    		if( isset( $logo_url ) ){
	    			?>
	    			<img src="<?php echo $site_base . $logo_url; ?>"><br><br>
	    			<?php
	    		}else{
	    			?>
	    			<img src="uploads/logo.png"><br><br>
	    			<?php
	    		}
	    		?>
	    			
	    	</div>
	      <form method="post" role="form">
	        <div class="form-group">
	        	<label>Username:</label>
	          <input type="text" class="form-control" name="access_login" placeholder="Enter a Username"/>
	        </div>
	        <div class="form-group">
	        	<label>Password:</label>
	          <input type="password" name="access_password" class="form-control" placeholder="Enter a Password"/>
	        </div>
	        <div class="form-group">
	           <input type="submit" name="new_user" value="Add User" class="btn btn-primary form-control" />
	        </div>
	        <div class="form-group">
	        	<h3><?php echo $emsg; ?></h3>
	        </div>
	      </form>
	    </div>

		</div>
	</div>

	    <div class="clearfix"></div>

	    <div class="row ">
	   
		<?php

			// page check
			$pguery = "SELECT * FROM users ORDER BY modified ASC";
			$pgr = mysqli_query($link,$pguery);
			$pgnr = mysqli_num_rows($pgr);
			$pcount = (int)ceil($pgnr/9);

			if($_GET["page"])
			{	
				if($_GET["page"] > $pcount)
				{
					$query = "SELECT * FROM users ORDER BY modified ASC LIMIT 0 , 9";
				}else{
					$plim = (intval($_GET["page"])-1) * 9;
					$query = "SELECT * FROM users ORDER BY modified ASC LIMIT ".$plim." , 9";
				}
			}else{
				if( isset( $_GET["board_id"] ) ){

					$query = "SELECT * FROM users WHERE board_id = '" .$_GET['board_id']. "' ORDER BY modified ASC LIMIT 0 , 9";
				}else{
					$query = "SELECT * FROM users ORDER BY modified ASC LIMIT 0 , 9";
				}
			}

			$result = mysqli_query($link,$query);
			$num_rows = mysqli_num_rows($result);

			$blog_html = "";

			$blog_row_count = 0;
			while($row=mysqli_fetch_array($result)){
				$img_loc = null;
				$query2 = "SELECT * FROM blog_images WHERE blog_id='".$row["id"]."' LIMIT 1";
				$result2 = mysqli_query($link,$query2);

				while($row2=mysqli_fetch_array($result2)){ $img_loc = $row2['location']; }

				
					 ?> 
				    <div class='col-md-12 well slide card'>
				        <div class="card-body">
				        <?php echo $row["name"]; ?><br><br>
				        
				       
						<div class="clearfix"></div><br>	

    

    			        <?php echo "<p>Created: <b>" . date("m-d-Y", strtotime($row["created"])) . "</b><br />Modified: <b>" . date("m-d-Y", strtotime($row["modified"])) . "</b></p><br />"; ?>
			
				        <div class="clearfix"></div><br>
				        <?php echo "<div class='buttons'><ul class=\"list-inline buttons d-flex align-items-baseline\"><li><a href=\"" . $site_base . "admin/edit_users.php?id=" . $row["id"] . "\" class=\"btn btn-default\">Edit</a></li>"; ?>
				        <?php echo "<li><a href=\"" . $site_base . "admin/delete_any.php?type=users&id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>

				        
        				</ul>
        				</div>	
        				</div>			    
				    </div>
				    
				    <?php

					
					$blog_row_count++;

					if ($blog_row_count % 3 === 0) { echo "</div><div class='row'>"; }

			
			}

			

			//mysql_close();
			
		?>

		</div>

		<div class="clearfix"></div>
		<div class="col-sm-12">
			<ul class="pagination">
				<?php 

					$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysqli_error($link));

					mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysqli_error($link));

		
					
					$query = "SELECT * FROM users ORDER BY modified DESC";

					if($_GET["page"])
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
						$pcount = (int)ceil($num_rows/9);
						
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