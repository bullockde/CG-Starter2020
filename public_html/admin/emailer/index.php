<?php
$relative = "../";

include $relative . "../src/crutchphp/config.php";

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

//echo "<br>Start Page!";



		$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

		$users = "CREATE TABLE IF NOT EXISTS `users` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `name` text COLLATE utf8_unicode_ci NOT NULL,
			 `pass` text COLLATE utf8_unicode_ci NOT NULL,
			 `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			 `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			 PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

			mysqli_query($link,$users);




			$Emails =	"CREATE TABLE IF NOT EXISTS `Emails` (
				 `ID` int(11) NOT NULL AUTO_INCREMENT,
				 `clientID` int(11) NOT NULL,
				 `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
				 `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
				 `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
				 `formType` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
				 `formID` int(11) NOT NULL DEFAULT '0',
				 `Happy` int(11) NOT NULL DEFAULT '0',
				 `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
				 PRIMARY KEY (`ID`)
				) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

				mysqli_query($link,$Emails);

			$Forms =	"CREATE TABLE IF NOT EXISTS `Forms` (
				 `ID` int(11) NOT NULL AUTO_INCREMENT,
				 `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
				 `Questions` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
				 `Question1` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Question2` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Question3` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 PRIMARY KEY (`ID`)
				) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

				mysqli_query($link,$Forms);

			$Questions	 =	"CREATE TABLE IF NOT EXISTS `Questions` (
				 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
				 `question` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
				 `type` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

				mysqli_query($link,$Questions);

			$Logins =	"CREATE TABLE IF NOT EXISTS `Logins` (
				 `CompanyID` int(11) NOT NULL,
				 `Username` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
				 `Password` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
				 PRIMARY KEY (`CompanyID`),
				 UNIQUE KEY `CompanyID` (`CompanyID`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

				mysqli_query($link,$Logins);

			$sessions =	"CREATE TABLE IF NOT EXISTS `sessions` (
				 `id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
				 `access` int(10) unsigned DEFAULT NULL,
				 `data` text COLLATE utf8_unicode_ci,
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

				mysqli_query($link,$sessions);


			$Templates =	"CREATE TABLE IF NOT EXISTS `Templates` (
				 `ID` int(11) NOT NULL AUTO_INCREMENT,
				 `TemplateName` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
				 `Color1` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Color2` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Color3` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Header` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Subheader` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Body` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Question` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `YesButton` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `NoButton` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `Tagline` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
				 `CompanyID` int(11) NOT NULL DEFAULT '0',
				 `FormID` int(11) NOT NULL DEFAULT '0',
				 PRIMARY KEY (`ID`),
				 UNIQUE KEY `TemplateName` (`TemplateName`)
				) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


				INSERT INTO `Templates` (`ID`, `TemplateName`, `Color1`, `Color2`, `Color3`, `Header`, `Subheader`, `Body`, `Question`, `YesButton`, `NoButton`, `Tagline`, `CompanyID`, `FormID`) VALUES ('0', 'English', '#eae4d6', '#373e15', '#202020', 'Thank for visiting the<br>Law Office of Elaine Cheung', 'We hope to see you again soon.', 'Thank you for visiting us! We want to provide you with the best representation so it would be helpful to know how well we handled your case.', 'Are you happy with your experience with us? ', 'Yes, I Was', 'No, I Was Not', 'THANK YOU FOR YOUR FEEDBACK', '0', '7');
				";

				mysqli_query($link,$Templates);

				$Logins = "CREATE TABLE IF NOT EXISTS `Logins` (
				 `CompanyID` int(11) NOT NULL,
				 `Username` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
				 `Password` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
				 PRIMARY KEY (`CompanyID`),
				 UNIQUE KEY `CompanyID` (`CompanyID`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

				mysqli_query($link,$Logins);



				 // Database - Add Template
			    
			            $templatename = $_POST['templatename'];
			            $color1 = $_POST['add_color1'];
			            $color2 = $_POST['add_color2'];
			            $color3 = $_POST['add_color3'];
			            $headertext = $_POST['add_header'];
			            $subheadertext = $_POST['add_subheader'];
			            $bodytext = $_POST['add_body'];
			            $question = $_POST['add_question'];
			            $yesbutton = $_POST['add_yes'];
			            $nobutton = $_POST['add_no'];
			            $tagline = $_POST['add_tagline'];
			            $companyID = $_POST['add_companyID'];
			    
			        if( isset($_POST['add_template']) ){
			            
			            $query="INSERT INTO Templates (TemplateName, Color1, Color2, Color3, Header, Subheader, Body, Question, YesButton, NoButton, Tagline, CompanyID)
		                 VALUES ('".$templatename."',
		                '".$color1."',
		                '".$color2."',
		                '".$color3."',
		                '".$headertext."',
		                '".$subheadertext."',
		                '".$bodytext."',
		                '".$question."',
		                '".$yesbutton."',
		                '".$nobutton."',
		                '".$tagline."',
		                '".$companyID."'
		                )";
		                mysqli_query( $link,$query); 

			               
			              			            
			        }elseif( isset($_GET['TemplateID']) ){

			        	$query="UPDATE Templates 
			                SET TemplateName='".$templatename."',
			                Color1='".$color1."',
			                Color2='".$color2."',
			                Color3='".$color3."',
			                Header='".$headertext."',
			                Subheader='".$subheadertext."',
			                Body='".$bodytext."',
			                Question='".$question."',
			                YesButton='".$yesbutton."',
			                NoButton='".$nobutton."',
			                Tagline='".$tagline."',
			                CompanyID='".$companyID."'
			                WHERE ID='".$_GET['TemplateID']."';";
			                mysqli_query( $link, $query) or die("Invalid Input");  
			        }

	
	



		if(isset($_POST['new_user'])){

          	$name = $_POST['access_login'];
          	$pass = $_POST['access_password'];
     
             $query = "INSERT INTO users(name,pass) VALUES('".$name."',PASSWORD('".$pass."'))";
             $tres = mysqli_query( $link, $query);

	     }


		$tquery = "SELECT * FROM blog_images WHERE  name='logo'";

		$tres = mysqli_query( $link, $tquery);

		$tnr = mysqli_num_rows($tres);

		$row  = mysqli_fetch_array($tres);

		$logo_url = $row['location'];

	?>

<?php 
	$page_title = "Email Settings";
	include $relative . "includes/head.php"; 
?>
<body>
	
	<?php include $relative . 'includes/header.php'; ?>

	<?php include $relative . 'includes/sidebar.php'; ?>

	<section id="main-content">



          <section class="wrapper">
	
	<div class="container-fluid">

		<h1><?php echo $page_title; ?></h1>


		<div class="clearfix"></div> <br>

		<div class="col-md-12">

			
			<a class="btn btn-primary btn-lg" href="<?php echo $admin_base; ?>emailer/edit_email.php">Email Editor &raquo;</a>
			<br><br>


		</div>

		<div class="clearfix"></div><hr>







		 <div style="max-width:100%;" class="col-md-6 m-2 well">
            <h2>Template Settings:</h2>
            <br>
            <form action="?" method="post">
                
                
                <?php

                	$result = "";

                if( isset($_SESSION[add_template]) ) {
                      $query="SELECT * FROM Templates WHERE ID = ".$_SESSION[TemplateID].";";
                         
                  
                  }else{
                      
                      $query="SELECT * FROM Templates";
                     
                  }
                  
                    $row=mysqli_fetch_array($result);

                      $templatename = $row['TemplateName'];
	        	        $color1 = $row['Color1'];
	        	        $color2 = $row['Color2'];
	        	        $color3 = $row['Color3'];
	        	        $headertext = $row['Header'];
	        	        $subheadertext = $row['Subheader'];
	        	        $bodytext = $row['Body'];
	        	        $question = $row['Question'];
	        	        $yesbutton = $row['YesButton'];
	        	        $nobutton = $row['NoButton'];
	        	        $tagline = $row['Tagline'];

                  echo "Edit an Existing Template: <select name='TemplateID' class='form-control'>";
                    echo "<option value='add_template'>Select a Template</option>";
                  while ($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row[ID]."'>".$row[TemplateName]."</option>";
                  }
                  echo "</select><br>";
                ?>

				

                <p>Template Name:</p>
                <input type="text" name="templatename" class="form-control" value="<?php echo $templatename; ?>">
                <br>
                <p>Primary Color:</p>
                <input style="height:50px;width:50%;" type="color" name="add_color1" value="<?php echo $color1; ?>">
                <br><br>
                <p>Secondary Color:</p>
                <input style="height:50px;width:50%;" type="color" name="add_color2" value="<?php echo $color2; ?>">
                <br><br>
                <p>Font Color:</p>
                <input style="height:50px;width:50%;" type="color" name="add_color3" value="<?php echo $color3; ?>">
                <br><br>
                <p>Header:</p>
                <input type="text" name="add_header" class="form-control" value="<?php echo $headertext; ?>">
                <br>
                <p>Subheader:</p>
                <input type="text" name="add_subheader" class="form-control" value="<?php echo $subheadertext; ?>">
                <br>
                <p>Body:</p>
                <textarea style="width: 100%;" name="add_body"><?php echo $bodytext; ?></textarea>
                <br>
                <p>Question:</p>
                <input type="text" name="add_question" class="form-control" value="<?php echo $question; ?>">
                <br>
                <p>Yes Button:</p>
                <input type="text" name="add_yes" class="form-control" value="<?php echo $yesbutton; ?>">
                <br>
                <p>No Button:</p>
                <input type="text" name="add_no" class="form-control" value="<?php echo $nobutton; ?>">
                <br>
                <p>Tagline:</p>
                <input type="text" name="add_tagline" class="form-control" value="<?php echo $tagline; ?>">
                <br>
                <input class="btn btn-primary" type="submit">
                <a href="?email=1" class="btn btn-secondary">Cancel</a>
                <br><br>
            </form>              
          </div>






	    


	</div>

	</section>
		</section>

	

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	<script type="text/javascript">

	function yesnoCheck( id ) {
	    if (document.getElementById('yesCheck').checked) {
	        document.getElementById(id).style.display = 'block';
	    }
	    else document.getElementById(id).style.display = 'none';

	}

	</script>

	<script type="text/javascript">
		
		$.fn.carousel.Constructor.prototype.cycle = function (event) {
    
	    if (!event) {
	        this._isPaused = false;
	      }

	      if (this._interval) {
	        clearInterval(this._interval)
	        this._interval = null;
	      }

	      if (this._config.interval && !this._isPaused) {
	          
	        var $ele = $('.carousel-item-next');
	        var newInterval = $ele.data('interval') || this._config.interval;
	        this._interval = setInterval(
	          (document.visibilityState ? this.nextWhenVisible : this.next).bind(this),
	          newInterval
	        );
	      }
	};


	</script>

	<script>
	//var vid = document.getElementById("myVideo");


	 $(document).ready(function(){
         $("button.duration").on("click", function () {
            var v = $(this).siblings("video").attr("id");
            var vid = document.getElementById(v);
            alert("Duration: " + (vid.duration * 1000));
         });
     });
	</script> 

	<?php include $relative . "includes/scripts.php"; ?>

</body>