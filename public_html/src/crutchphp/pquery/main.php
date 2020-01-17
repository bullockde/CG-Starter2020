 <?php
 	$link = mysql_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"]) or die("Database Error: Invalid Username or Password ".mysql_error());
 	mysql_select_db($DB_MYSQL["database"]) or die("Database Error: Database not found ".mysql_error());
 	
 	if ($_GET["tag"]) {
        $pquery = "SELECT * FROM blogs WHERE tags LIKE '%" . mysql_escape_string($_GET["tag"]) . "%' ORDER BY created DESC";
    } else {
        $pquery = "SELECT * FROM blogs ORDER BY created DESC";
    }

    $presult = mysql_query($pquery);
    $pgnr = mysql_num_rows($presult);
    $pcnt = (int)ceil($pgnr / 9);

    if (isset($_GET["page"]) && isset($_GET["tag"])) {
        if ($_GET["page"] > $pcnt) {
            $query = "SELECT * FROM blogs WHERE tags LIKE '%" . mysql_escape_string($_GET["tag"]) . "%' ORDER BY created DESC LIMIT 0 , 9";

        } else {
            $plim = (intval($_GET["page"]) - 1) * 9;
            $query = "SELECT * FROM blogs WHERE tags LIKE '%" . mysql_escape_string($_GET["tag"]) . "%' ORDER BY created DESC LIMIT " . $plim . " , 9";
        }
    } else if (!isset($_GET["tag"]) && isset($_GET["page"])) {
        if ($_GET["page"] > $pcnt) {
            $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 9";

        } else {
            $plim = (intval($_GET["page"]) - 1) * 9;
            $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT " . $plim . " , 9";
        }
    } else if (!isset($_GET["page"]) && isset($_GET["tag"])) {
        $query = "SELECT * FROM blogs WHERE tags LIKE '%" . mysql_escape_string($_GET["tag"]) . "%' ORDER BY created DESC LIMIT 0 , 9";
    } else {
        $query = "SELECT * FROM blogs ORDER BY created DESC LIMIT 0 , 9";
    }

 ?>