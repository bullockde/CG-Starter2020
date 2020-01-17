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
	$page_title = "User Admin";
	include "head.php"; 
?>
<body>
	

	<?php include 'header.php'; ?>
	<style type="text/css">
		
		td, th {
		    padding: 5px;
		}

	</style>
	
	<div class="container-fluid">
<h1>Database Tables:</h1>




<?php

$dbname = $DB_MYSQL["database"];

$sql = "SHOW TABLES FROM $dbname";
$result = mysqli_query( $link, $sql );

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysqli_error($link);
    exit;
}
?>
<form method="post">
    <select name="show_table">
        <option name='show_table' value='0'> Select a Table </option>
        <?php
            while ($row = mysqli_fetch_row($result)) {
                echo "<option name='show_table' value='{$row[0]}'>{$row[0]}</option>";
                //echo "<br>Table: {$row[0]}\n";
            }
        ?>

    </select>

    <input type="submit" class="btn btn-primary">
</form>
<?php
mysqli_free_result($result);




$table = $_POST['show_table'];

// sending query
$result = mysqli_query( $link, "SELECT * FROM {$table}" );
if (!$result) {
    //die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result);

$fields =  $_POST['fields'];

if ( isset($_POST['show_table']) ) {
    echo "<h1>Table:{$table}</h1>";
    echo "<table border='1'><tr>";
}
// printing table headers


?>
<form method="post">
<?php

    if ( isset($_POST['show_table']) && !isset($_POST['fields']) ) { echo "<b>Select Columns to Display:</b><br>"; }
for($i=0; $i<$fields_num; $i++)
{
    $field = mysqli_fetch_field($result);

    if ( isset($_POST['fields']) ) {

        if ( in_array($i,$fields) ) {
            echo "<td> <input type='checkbox' id='{$field->name}' name='fields[]' value='{$i}'> {$field->name} </td>";
        }

    }else{


        echo "<td> <input type='checkbox' id='{$field->name}' name='fields[]' value='{$i}'> {$field->name} </td>";
    }
    
}

    if ( isset($_POST['show_table']) && !isset($_POST['fields']) ) {

        ?>
        <td> 
            <input type="hidden" name="show_table" value="<?php echo $_POST['show_table']; ?>"> 
            
            <input type="submit" class="btn btn-primary"> 
        </td>
        <?php

    }
?>
    
</form>
<?php

echo "</tr>\n";
// printing table rows

//var_dump($fields);

if ( isset($_POST['fields']) ) {

    
    while($row = mysqli_fetch_row($result))
    {

        $cnt = 0;

        echo "<tr>";
        
        // $row is array... foreach( .. ) puts every element
        // of $row to $cell variable
        foreach($row as $cell){


            if ( in_array($cnt++,$fields) ) {
                echo "<td>$cell</td>";
            }

           // echo "<br>ROW= " . var_dump($cell);

            

        }

        echo "</tr>\n";
    }
    
}
echo "</table>";
mysqli_free_result($result);
?>



<div class="clearfix"></div> <br><br>
    <?php if ( isset($_POST['fields']) ) { ?>
    
        <button>Export HTML table to CSV file</button>

    <?php } ?>
<div class="clearfix"></div> <br><br>
</div>


<script type="text/javascript">
    
    function download_csv(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV FILE
        csvFile = new Blob([csv], {type: "text/csv"});

        // Download link
        downloadLink = document.createElement("a");

        // File name
        downloadLink.download = filename;

        // We have to create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);

        // Make sure that the link is not displayed
        downloadLink.style.display = "none";

        // Add the link to your DOM
        document.body.appendChild(downloadLink);

        // Lanzamos
        downloadLink.click();
    }

    function export_table_to_csv(html, filename) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");
        
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");
            
            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);
            
            csv.push(row.join(","));        
        }

        // Download CSV
        download_csv(csv.join("\n"), filename);
    }

    document.querySelector("button").addEventListener("click", function () {
        var html = document.querySelector("table").outerHTML;
        export_table_to_csv(html, "table.csv");
    });
</script>

</body>