<?php
    include "../src/crutchphp/config.php";

    if(!isset($_COOKIE['verified'])){ header("Location: ".$admin_base."login.php"); }



    $link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");

?>
<html>

<head>
    
    <title>MySQL Table Viewer</title>
</head>

<body>
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

</html>