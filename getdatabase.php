<?php
header('Content-type: text/json');

// Connection to the database
$serv     = "localhost";
$base     = "BASE";
$login    = "LOGIN";
$pwd      = "PASSWORD";
$db = mysql_connect($serv, $login, $pwd);
$db_selected = mysql_select_db($base, $db);

// Regex for security to check if the country code is exactly two letters
if ($_GET['database'] != "" && preg_match("#[a-zA-Z]{2}#", $_GET['database']))
    Fetchdatabase();

function Fetchdatabase() {
    // For security too, escapes special characters
    $code = mysql_real_escape_string($_GET['database']);

    // In case you have a table in your database named Countries with 5 fields, the first being the country code
    $sql = "SELECT field1, field2, field3, field4, field5 FROM Countries WHERE field1='".$code."'";
    $result = mysql_query($sql);

    $results = array();
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        // Get the database information in an array
        $results[] = array (
            'field1' => utf8_encode($row['field1']),
            'field2' => utf8_encode($row['field2']),
            'field3' => utf8_encode($row['field3']),
            'field4' => utf8_encode($row['field4']),
            'field5' => utf8_encode($row['field5']),
        );
    }

    // Counts the number of countries in the database
    $sql1 = "SELECT count(field1) AS getnumber FROM Countries WHERE field1='".$code."'";
    $result1 = mysql_query($sql1);

    $data = mysql_fetch_array($result1);
    $total = intval($data["getnumber"]);
    $results = array_merge(array($total), $results);

    // Printing Json data to get it when clicking on the world map
    echo json_encode($results, JSON_FORCE_OBJECT);
}

mysql_close($db);

?>
