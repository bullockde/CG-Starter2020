<?php
$relative = "../";
include $relative . "../src/crutchphp/config.php";
  //include("database.class.php");  
  //include("mysql.sessions.php");  
  //$session = new Session();



if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }

    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

  //$dbconn = mysql_connect('localhost','thephill_admin','Delta#123!') or die ("Cannot connect to db!");
  //mysql_select_db('thephill_db',$dbconn) or die("Could not select database!");

/*
    if(!($_SESSION['login'] === true)) {
        
    //echo session_save_path();
        
        //header('Location: /admin.php');
        exit;
        
    echo '<div class="container">
            <div class="row justify-content-md-center" style="margin-top: 200px;">
              <div class="col-md-4">';
          echo "<form class='form-signin' action='?' method='post'>";
          echo "Username: <input class='form-control' type='text' name='loginu'><br />";
          echo "Password: <input class='form-control' type='password' name='loginp'><br />";
          echo "<input class='btn btn-primary' type='submit'></form></div></div></div>";
    die();
    }*/
?>

<!DOCTYPE html>
<html lang="en">
<!--
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reputation Management Powered By Computer Guy</title>

    <!- Bootstrap core CSS->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!- Custom fonts for this template->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!- Page level plugin CSS->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!- Custom styles for this template->
    <link href="css/sb-admin.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  </head>-->
   <?php include "../head.php"; ?>

  <body id="page-top">
      
     <!-- BEGIN Top Menu -->
      
      <?php include "../header.php"; ?>
      
      <!-- END Top Menu -->
    
     <div id="wrapper">

      <!-- BEGIN Sidebar -->
      
      <?php //include "sidebar-menu.php"; ?>
      
      <!-- END Sidebar -->
      
      <div id="content-wrapper">

        <div class="container-fluid">

         

    <?php 

     include "email_template.php";
    
        if(!empty($_GET['logout'])) {
          //session_unset();
          //session_destroy();
          //echo "You've been logged out! <a href='?'>Restart</a>";
        }
        
        //print_r($_SESSION);

    
    // Database - Add Template
    
            $templatename = $_POST['add_template'];
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
    
        if($_POST){
            
            
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


        
    
    // Form - Edit Template
    
    
                $query="SELECT * FROM Templates WHERE ID = '$_GET[TemplateID]'";
                $result=mysqli_query( $link, $query);
                
                while($row=@mysqli_fetch_array($result)) {
                            
                 
                  
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
                
              }
                
         if ( !empty( $_GET ) ) {       
         ?>
               <div style="max-width:100%;" class="col-md-6 m-2 well">
                <h2>Edit Template</h2>
                <br><br>
                <form action="?TemplateID=<?php echo $_GET['TemplateID']; ?>" method="post">
                    
                    
                    <?php
                    if( $_SESSION[admin] ) {
                          $query="SELECT * FROM customers WHERE id = ".$_SESSION[client_ID].";";
                      
                      }else{
                          
                          $query="SELECT * FROM customers";
                      }
                      
                      $result= mysqli_query( $link, $query);
                     
                      echo "Client Name: <select name='client_ID' class='form-control'>";
                        echo "<option value='0'>Select a Client</option>";
                      while ($row=mysqli_fetch_array($result)) {
                        echo "<option value='".$row[id]."'>".$row[name]."</option>";
                      }
                      echo "</select><br>";
                    ?>
                    <p>Template Name:</p>
                    <input type="text" name="add_template" class="form-control" value="<?php echo $templatename; ?>">
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
            <?php
              }
            ?>

        </div>
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    
   

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <!--<script src="js/demo/chart-area-demo.js"></script>-->
    

  </body>

</html>
