<?php

/* Config for CruchPHP Minimal CMS 
*  Creator - Oscruo Designs/CGPC Solutions
*  oscurodesign.com / geekgroup.com
*  See LICENSE.MD for software license information
*  Copyrite Oscuro Designs/CGPC Solutions 2016
*/


if (isset($_GET["logout"])) {

    
    unset($_COOKIE['verified']);
    setcookie('verified', '', time() - 3600, '/'); // empty value and old timestamp
    
}


$DB_MYSQL = array(
    "host" => "localhost",
    "database" => "cgmedia_blog",
    "user" => "cgmedia_admin",
    "pass" => "Delta#123!"
);

$root = "/";
$site_base = "http://www.fairmount-design.com/";
$admin_base = "http://www.fairmount-design.com/admin/";
$localpath = "/home/fairmountdesign/public_html/";

$images = "/home/fairmountdesign/public_html/images/";

$admin_name = "Fairmount Design Control Administration";
$admin_ver = "1.1";


$filename = $localpath . "src/crutchphp/blog.sql";



// Connect to MySQL server
$con = @new mysqli($DB_MYSQL["host"],$DB_MYSQL["user"],$DB_MYSQL["pass"],$DB_MYSQL["database"]);

// Check connection
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_errno;
    echo "<br/>Error: " . $con->connect_error;
}

// Temporary variable, used to store current query
$templine = '';


// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current segment
    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}
if( $con->affected_rows > 0 ) { echo "Tables imported successfully"; }



// Temporary variable, used to store current query
$templine = '';

$filename = $localpath . "src/crutchphp/blog_images.sql";

// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current segment
    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}
if( $con->affected_rows > 0 ) { echo "Tables imported successfully"; }



// Temporary variable, used to store current query
$templine = '';

$filename = $localpath . "src/crutchphp/videos.sql";

// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current segment
    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}
if( $con->affected_rows > 0 ) { echo "Tables imported successfully"; }



// Temporary variable, used to store current query
$templine = '';

$filename = $localpath . "src/crutchphp/boards.sql";

// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current segment
    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}
if( $con->affected_rows > 0 ) { echo "Tables imported successfully"; }




// Temporary variable, used to store current query
$templine = '';

$filename = $localpath . "src/crutchphp/users.sql";

// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current segment
    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}
if( $con->affected_rows > 0 ) { echo "Tables imported successfully"; }




$con->close($con);

?>