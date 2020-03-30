<?php
	include "../src/crutchphp/config.php";
	if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" dir="ltr" lang="en-US">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html dir="ltr" lang="en-US">
<!--<![endif]-->

<?php 
	$page_title = "Home";
	include "head.php"; 
	//include '../admin-panel/includes/head.php';
?>

<body>
	
	<?php include 'header.php'; ?>
	<?php // include '../admin-panel/includes/header.php'; 
	?>
	
	<div class="container-fluid">

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
					$query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 9";
				}else{
					$plim = (intval($_GET["page"])-1) * 9;
					$query = "SELECT * FROM blogs ORDER BY created DESC LIMIT ".$plim." , 9";
				}
			}else{
				$query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 9";
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
				    <div class='col-lg-4 well'>
				        
				        <?php echo $row["title"]; ?><br><br>
				        <div class='col-sm-6 text-center'>
				        <?php 
				            
				            echo "<center><img src=\"" . $site_base . $img_loc . "\" class='img-responsive'  \></center>"; ?>
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
				         <?php 
				            if ($row["featured"] == true)
    						{
    						    echo "<b>Featured</b>  >> ";
    						}
    					
    						if ($row["landing"] == true)
    						{
    						    echo "<b>Landing Page</b> ";
    						}
				        ?> >> <?php echo $row["tags"]; ?><br><br>
				        <?php echo "<p>Created: <b>" . date("m-d-Y", strtotime($row["created"])) . "</b><br />Modified: <b>" . date("m-d-Y", strtotime($row["modified"])) . "</b></p><br />"; ?>
				        <?php echo "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit.php?id=" . $row["id"] . "\" class=\"btn btn-default\">Edit</a></li>"; ?>
				        <?php echo "<li><a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-danger\">Delete</a></li>"; ?>
				       
				       
				        <li class='pull-right'><a target='_blank' href='<?php echo $site_base . "blog/?id=" . $row["id"]; ?>' class='btn btn-success '>View Post >></a></li>

				        <?php
				       	if ($row["landing"] == true)
    						{

    							if ($row["landing"] == true) {
    							?>

    						  
    						   <li class="pull-right"><a target="_blank" href="/services/?id=<?php echo $row[id]; ?>" class="btn btn-default ">Landing Page</a></li>
    						    <?php
    						    }
    						}
				       ?>
        				</ul>				    
				    </div>
				    
				    <?php

					if ($blog_row_count % 3 === 0 && $blog_row_count !== 0)
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
                    
					$blog_html.= "<h1>" . $row["title"] . "</h1><p>Created: <b>" . $row["created"] . "</b><br />Modified: <b>" . $row["modified"] . "</b></p><br />";
					$blog_html.= "<ul class=\"list-inline\"><li><a href=\"" . $site_base . "admin/edit.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Edit</a></li>";
					$blog_html.= "<li><a href=\"" . $site_base . "admin/delete.php?id=" . $row["id"] . "\" class=\"btn btn-primary\">Delete</a></li>";
					if ($row["featured"] == true)
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

					if ($blog_row_count % 3 === 0) { echo "<div class='clearfix'></div>"; }

				
			}

			mysqli_close( $link );

			
		?>

		<div class="clearfix"></div>
		<div class="col-sm-12">
			<ul class="pagination">
				<?php 
					$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ".mysql_error());

					mysqli_select_db ( $link , $DB_MYSQL["database"] ) or die("Database Error: Database not found ".mysql_error());
					
					$query = "SELECT * FROM blogs ORDER BY modified DESC";

					if( isset($_GET["page"]) )
					{
						$pg = $_GET["page"];
					}else{
						$pg = 1;
					}

					$result = mysqli_query( $link, $query);
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

	<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<?php include '../admin-panel/includes/scripts.php'; ?>
</body>

